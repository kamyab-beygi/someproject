<?php


namespace Classess\MiddleWare;

use Slim\Middleware;

use Classess\Session\Session;

class BeforeMiddleware extends Middleware
{
	public function call()
	{
		$this->app->hook('slim.before',[$this,'run']);

		$this->next->call();
	}


	public function run()
	{
		 $sessionName = $this->app->config->get('auth.session');
		
		if(Session::exists($sessionName)){
			$sessionValue = Session::get($sessionName);
			$this->app->auth = $this->app->user->where('id',$sessionValue)->first();
		
		}

		$this->app->view()->appendData([
			'auth' => $this->app->auth
		]);

	}
}