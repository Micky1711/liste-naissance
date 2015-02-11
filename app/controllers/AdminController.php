<?php

class AdminController extends BaseController {
	protected $layout = "layouts.admin";


	public function getIndex()
	{
		$data = [];
		$data['products'] = Product::count();
		$data['products2'] = Product::where('statut',100)->count();
		$financement = Financement::All();
		$financements = 0;
		foreach($financement AS $f)
		{
			$financements += $f->payment_amount;
		}
		$data['financements'] = $financements;
		$data['users'] = User::count();

		$data['logs'] = Mylog::orderBy('created_at','DESC')->limit(25)->get();

		return View::make('admin.index')->with($data);
	}

}