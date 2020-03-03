<?php
	
	use Classess\Session\Session;

	$app->get('/logout',function() use($app){

		Session::delete($app->config->get('auth.session'));

		$app->flash('global','You have been logged out');

		$app->response->redirect($app->urlFor('home'));
	})->name('logout');

