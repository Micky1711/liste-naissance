<?php
class Product extends Eloquent {
	public $softDelete = true;
	protected $guarded = array();
	private $rules = array(
		'name' 	=> 'required|min:5|max:100'
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
	public function Gifts()
	{
		return $this->hasMany('Gift');
	}
	
}