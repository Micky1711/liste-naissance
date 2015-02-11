<?php

class MylogController extends BaseController {

	/*
	 * getLogin()
	 * postLogin()
	 * Fonctions servant à l'identification du membre
	 */
	public function getAdminListe()
	{
		$data['logs'] = Mylog::orderBy('created_at','ASC')->get();
		return View::make('admin.mylogs.liste', $data);
	}


	public function postAdminRead($name)
	{
		if($name == "header")
		{
			$logs = Mylog::All();
			foreach($logs AS $l)
			{
				$l->read = 1;
				$l->save();
			}
		}
	}

}