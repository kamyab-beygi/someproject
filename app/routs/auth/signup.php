<?php 
	
	$app->get('/signup',$guest(),function() use($app){

		$app->render('auth/register.php');

	})->name('register');



?>


