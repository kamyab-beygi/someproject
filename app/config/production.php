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
			'smtp_host'   =>'smtp.gmail.com',
			'username'    =>'kami.0071374@gmail.com',
			'password'    =>'Kami_007',
			'port'        => 587,
			'html'        =>true

		],

		'twig'=>[
			'debug'=>true

		],

		'csrf'=>[
			'session'=>'csrf_token'
		]

	];