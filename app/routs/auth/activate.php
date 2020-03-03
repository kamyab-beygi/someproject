<?php
	
	$app->get('/active',$guest(),function() use ($app){

		$request = $app->request;

		 $identifier = $request->get('identifiler');
		 $email = $request->get('email');

		 $hashIdentifier = $app->hash->hash($identifier);

		 $user = $app->user
		 ->where('email',$email)
		 ->where('active',false)
		 ->first();

		 if(!$user && !$app->hash->hashCheck($user->active_hash , $hashIdentifier) ){
		 	$app->flash('global','there was problem to activate your account');
		 	$app->response->redirect($app->urlFor('home'));
		 }else{
		 	$user->activateAccount();

		 	$app->flash('global','Your Account is active');
		 	$app->response->redirect($app->urlFor('home'));
		 }

	})->name('active');