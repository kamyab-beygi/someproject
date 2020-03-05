<?php

$app->get('/', function() use ($app) {


	$app->render('home.php');
})->name('home');

$app->get('/flash',function() use($app){

	$app->flash('global',"yes FUck aLL");

	$app->response->redirect($app->urlFor('home'));
});




$app->get('/flash2',function() use($app){

	$app->flash('global',"yes FUck aLL");

	$app->response->redirect($app->urlFor('home'));
});

?>
