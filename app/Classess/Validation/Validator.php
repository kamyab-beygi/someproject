<?php 
	
	namespace Classess\Validation;

	use Violin\Violin;

	use Classess\User\User;

	class Validator extends Violin
	{
		protected $user;

		public function __construct(User $user)
		{
			$this->user = $user;

			$this->addFieldMessages([
				'email'=>[
					'uniqueEmail' => 'That email already in use.'
				],
				'username'=>[
					'alnumDash'=>'شما نمیتوانید نقطه در نام کاربری استفاده کنید !',
					'uniqueUsername'=>'that Username has already in use'
				]

			]);
		}

		public function validate_uniqueEmail($value , $input , $args)
		{

		 $user = $this->user->where('email',$value);

		 return ! (bool)  $user->count();

		}

		public function validate_uniqueUsername($value , $input , $args)
		{
			return ! (bool) $this->user->where('username',$value)->count();

		}

	}


?>