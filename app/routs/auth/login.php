<?php
	
	use Classess\Session\Session;

	$app->get('/login',$guest(),function() use($app){

		$app->render('auth/login.php');

	})->name('login');

	$app->post('/login',$guest(),function() use($app){
		
		$request = $app->request;

		 $identifier = $request->post('identifier');

		 $password = $request->post('password');


		 $v = $app->validation;

		 $v->validate([
		 	'identifier'=>[$identifier,'required'],
		 	'password'  =>[$password,'required']
		 ]);

		 if($v->passes()){
		 	$user = $app->user
		 	->where('active',true)
		 	->OrWhere('email',$identifier)
		 	->where('username',$identifier)
		 	->first();

		 	if($user && $app->hash->passwordCheck($password,$user->password)){

		 		Session::put($app->config->get('auth.session'),$user->id);
		 		$app->flash('global','You Are Loggedin ');
				$app->response->redirect($app->urlFor('home'));
				
			}else{
				$app->flash('global','could not login');
				$app->response->redirect($app->urlFor('home'));
			}
		 }

		 $app->render('auth/login.php',[
		 	'errors' => $v->errors()->all(),
		 	'request' =>$request
		 ]);

	})->name('login.post');