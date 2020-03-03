<?php 

namespace Classess\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
	protected $table = 'users';

	protected $fillable = [
		'id',
		'email',
		'username',
		'password',
		'active',
		'active_hash',
		'remember_identifier',
		'remember_token'
	];

	public function getFullName()
	{
		if(!$this->first_name || !$this->last_name){
			return null;
		}

		return "{$this->first_name}  {$this->last_name}"; 
	}

	public function getfullnameOrUsername()
	{
		return $this->getFullName() ?: $this->username;

	}

	public function activateAccount()
	{

		$this->update([
			'active'=>1,
			'active_hash'=>null
		]);
	}





}

