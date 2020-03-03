<?php

namespace Classess\MiddleWare;

use Slim\Middleware;
use Exception;
use Classess\Session\Session;

class CsrfMiddleware extends Middleware
{
	protected $key;
	public function call()
	{	
		$this->key = $this->app->config->get('csrf.session');

		$this->app->hook('slim.before',[$this,'check']);

		$this->next->call();
	}

	public function check()
	{
		if(!Session::exists($this->key))
		{
			 Session::put($this->key,$this->app->hash->hash($this->app->randomlib->generateString(128)));
		}
		
		$token = Session::get($this->key);

		if(in_array($this->app->request()->getMethod(),['POST','PUT','DELETE'])){

			$submittedToken = $this->app->request()->post($this->key) ?: '';

			if(!$this->app->hash->hashCheck($token,$submittedToken)){
				throw new Exception ('Csrf token Mismatch');
			}
		}


		$this->app->view()->appendData([
			'csrf_key'=>$this->key,
			'csrf_token'=>$token
		]);
	}
}