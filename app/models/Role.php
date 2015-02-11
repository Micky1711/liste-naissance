<?php
class Role extends Eloquent {
	protected $guarded = array();
	public $timestamps = false;
	private $rules = array(
		'name' => 'required|unique:roles',
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
	public function Users()
	{
		return $this->belongsToMany('User');
	}
	
}