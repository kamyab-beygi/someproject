<?php

use Slim\Slim;

use Slim\Views\Twig;

use Slim\Views\TwigExtension;
/* ------HassanKhan Config ---------- */
use Noodlehaus\Config;

use RandomLib\Factory as randomlib;

use Mailgun\Mailgun;

use Classess\User\User;

use Classess\Mail\Mailer;

use Classess\Helpers\Hash;

use Classess\PhpVersion\CheckPhpVersion;

use Classess\Validation\Validator;

use Classess\MiddleWare\BeforeMiddleware;

use Classess\MiddleWare\CsrfMiddleware;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'on');


define('INC_ROOT', dirname(__DIR__));

define('ASSET_ROOT',
		    'http://'.$_SERVER['HTTP_HOST'].
		    str_replace(
		        $_SERVER['DOCUMENT_ROOT'],
		        '',
		        str_replace('\\', '/', INC_ROOT).'/public/'
		    )
		);	

require_once INC_ROOT. '/vendor/autoload.php';

new CheckPhpVersion;

$app = new slim([

	'mode' => file_get_contents(INC_ROOT.'/mode.php'),
	'view' => new Twig(),
	'templates.path'=> INC_ROOT . '/app/views'

]);

$app->add(new BeforeMiddleware);
$app->add(new CsrfMiddleware);
$app->configureMode($app->config('mode'),function() use ($app){
	$app->config = Config::load(INC_ROOT. "/app/config/{$app->mode}.php");
});


require_once 'database.php';
require_once 'filters.php';
require_once 'routs.php';


$app->auth = false;

$app->container->set('user', function(){
	return new User;
});

$app->container->singleton('hash',function() use ($app) {
	return new Hash($app->config);
});

$app->container->singleton('validation',function() use ($app) {
	return new Validator($app->user);
});

$app->container->singleton('mail',function() use ($app) {
	$mailer = new PHPMailer; 
	$mailer->isSMTP(); 
	$mailer->Host = $app->config->get('mail.host');
	$mailer->SMTPAuth = $app->config->get('mail.smtp_auth');
	$mailer->SMTPSecure = $app->config->get('mail.smtp_secure');                          	
	$mailer->Username = $app->config->get('mail.username');                 
	$mailer->Password = $app->config->get('mail.password');         
	$mailer->From     = $app->config->get('mail.From');
	$mailer->FromName = $app->config->get('mail.FromName');

	$mailer->isHTML($app->config->get('mail.html')); 


	return new Mailer($app->view , $mailer);

});

$app->container->singleton('randomlib', function() use($app) {

	$factory = new randomlib;

	return $factory->getMediumStrengthGenerator();

});

$view = $app->view();

$view->parserOption = [
	'debug' => $app->config->get('twig.debug')
];


$view->parserExtensions = [
	new TwigExtension,
	new Twig_Extension_Debug
];

$app->hook('slim.before', function () use ($app) {
    $app->view()->appendData(array('baseUrl' => ASSET_ROOT));
});