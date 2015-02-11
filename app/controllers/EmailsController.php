<?php

class EmailsController extends BaseController {

	public function getTest()
	{	

		$data['texte'] = 'hello';
		Mail::send('emails.welcome', $data, function($message)
		{
		    $message->from('mickael.icart@gmail.com', 'Laravel');
		    $message->to('mickael.icart@gmail.com');
		});
		echo "email envoyé";
	}

	public function getReservations()
	{
		$email['user'] = User::find(Auth::user()->id);
		$email['achat'][] = Gift::find(1);
		$email['subject'] 	= 'Vos réservations pour la liste de naissance d\'Anne et Mickaël';
		return View::make('emails.reservations', $email);
	}

}
