<?php
class Mylog extends Eloquent {
	protected $fillable = array('action', 'comment', 'user_id');

 	public function User()
	{
		return $this->belongsTo('User');
	}


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

	public function addlog($array)
	{
		if(is_array($array))
		{
			extract($array);
			if(!$user_id)
				$user_id = Auth::user()->id;
			$l = new Mylog();
			$l->user_id	= $user_id;
			$l->action = $action;
			$l->comment = $comment;
			$l->save();
		}
	}


}