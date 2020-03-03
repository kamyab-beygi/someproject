<?php 
	
	$app->get('/register',$guest(),function() use($app){

		$app->render('auth/register.php');

	})->name('register');


	$app->post('/register',$guest(),function() use ($app) {

		$request = $app->request;

		$email = $request->post('email');
		
		$username = $request->post('username');

		$password = $request->post('password');

		$password_confirm = $request->post('password_confirm');

		$v = $app->validation;


		$v->validate([
		    'email'     => [$email,'required|email|uniqueEmail'],
		    'username'  => [$username, 'required|alnumDash|min(3)|max(20)|uniqueUsername'],
		    'password'  => [$password, 'required'],
		    'password_confirm' => [$password_confirm, 'required|matches(password)']
		]);

		if ($v->passes()) {
			$identifier = $app->randomlib->generateString(128);

			$user = $app->user->create([
				'username' => $username,
				'email'  => $email,
				'password' =>$app->hash->password($password),
				'active_hash' => $identifier
			]);

			 $app->mail->send('email/auth/register.php',['user'=> $user,'identifier'=>$identifier] , function($message) use ($user) {
			 	$message->to($user->email);
			 	$message->subject('Thanks for registering !');
			 });



			$app->flash('global','You have been registered');
			$app->response->redirect($app->urlFor('home')); 

		} else {
			$app->render('auth/register.php',[
					'errors' => $v->errors()->all(),
					'request' => $request
			]);

			
		}

	})->name('register.post');

?>