<?php

	return [

		'app'=>[
			'url'=>'http://localhost',
			'hash'=>[
				'algo'=>PASSWORD_BCRYPT,
				'cost'=>10
			]
		],

		'db'=>[
			'driver'    => 'mysql',
		    'host'      => 'localhost',
		    'database'  => 'site',
		    'username'  => 'root',
		    'password'  => '',
		    'charset'   => 'utf8',
		    'collation' => 'utf8_unicode_ci',
		    'prefix'    => '',

		],
		'auth'=>[
			'session'=>'user_id',
			'remember'=>'user_r'

		],

		'mail'=>[
			'smtp_auth'	  =>true,
			'smtp_secure' =>'tls',
			'host'        =>'smtp.mailgun.org',
			'username'    =>'postmaster@sandbox4ed59f32726d4410b1674327ad162d5e.mailgun.org',
			'password'    =>'72f3913e39e7ea7a2d9ed26be650880c',
			'html'        =>true,
			'FromName'    =>'Kamyab',
			'From'		  =>'site.email@site.com'
		],

		'twig'=>[
			'debug'=>true

		],

		'csrf'=>[
			'session'=>'csrf_token'
		]

	];