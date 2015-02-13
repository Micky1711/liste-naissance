<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use SoftDeletingTrait;

	protected $table = 'users';
	public $softDelete = true;
	protected $hidden = ['password', 'remember_token'];

	private $rules = array(
        'password' => 'required|min:8|confirmed', // password_confirmation
        'email' => 'required|email|unique:users|between:3,100',
        'name' => 'required|between:3,100'
	);

	public function validate($data, $rules = array())
	{
		$rules = array_merge($this->rules, $rules);
		$v = Validator::make($data, $rules);
		if ($v->fails())
		{
			$this->errors = $v->messages();
			return false;
		}
		return $v->passes();
	}

	public function errors()
	{
		return $this->errors;
	}


	/* Relations avec les autres modèles */
	public function Roles()
	{
		return $this->belongsToMany('Role');
	}

	public function Gifts()
	{
		return $this->hasMany('Gift');
	}

	public function Financements()
	{
		return $this->hasMany('Financement');
	}

	public function Mylogs()
	{
		return $this->hasMany('Mylog');
	}

	public function hasRole($key)
    {
        foreach ($this->roles as $role) {            
            if ($role->name === $key) {
                return true;
            }
        }        
        return false;
    }

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

}