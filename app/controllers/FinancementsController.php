<?php

class FinancementsController extends BaseController {

	public function getLibre() {
		return View::make('front.financements.libre');
	}

	public function postLibre() {
		$data = ['montant' => '20', 'moyen' => 'ESPECES', 'email' => 'mickael.icart@gmail.com'];
		$data['name'] = 'Mickael et Anne';
		$data['subject'] = 'Financement libre sur la liste de naissance';
		Mail::send('emails.financementlibre', $data, function($message)
		{
		    $message->from('mickael.icart@gmail.com', 'Liste de naissance');
		    $message->to('mickael.icart@gmail.com');
		    $message->subject('Financement libre sur la liste de naissance');
		});

		return View::make('front.financements.librepost')->with($data);
		exit;
		$input = Input::All();
		extract($input);
		$rules = array(
			'montant' => 'required|numeric|integer|min:1'
		);
		$g = new Gift();
		if($g->validate($input, $rules))
		{
			/* SAUVEGARDE DU SOUHAIT DE FINANCER LIBREMENT */
			$g = new Gift();
			$g->product_id = 0;
			$g->user_id = Auth::user()->id;
			$g->parts = $montant;
			$g->moyen = $moyen;
			$g->save();
			/* LE PETIT LOG QUI VA BIEN POUR PREVENIR */
			$comment = 'par '.$g->user->name.'. Montant attendu : '.number_format($montant,2) .'€ par '.$moyen;
	       	Mylog::create(['action' => 'FINANCEMENT LIBRE SOUHAITE', 'comment' => $comment]);

	       	/* ENVOI DU MAIL DE REMERCIEMENTS ET RECAPITULATIF */
	       	$data['moyen'] = $moyen;
	       	$data['montant'] = $montant;
	       	$data['name'] = Auth::user()->name;
	       	$data['email'] = Auth::user()->email;
	       	$data['key'] = md5($g->id.'-PAYPAL');
	       	$data['financements'] = $g->id;
	       	/*
	       	Mail::send('emails.financementlibre', $data, function($message)
			{
			    $message->from('mickael.icart@gmail.com', 'Laravel');
			    $message->to('mickael.icart@gmail.com');
			});
			*/

			/* AFFICHAGE DE LA VUE CORRESPOND AU CHOIX DE PAIEMENT */
			return View::make('front.financements.librepost')->with($data);
		}
		else
		{

			$gift_errors = $g->errors()->toArray();
			return Redirect::route('libre')->with('gift_errors', $gift_errors);
		}

	}


		/* ADMINISTRATION */
	public function getAdminListe()
	{
		$data['financements'] = Financement::orderBy('created_at','ASC')->get();
		return View::make('admin.financements.liste', $data);
	}

}