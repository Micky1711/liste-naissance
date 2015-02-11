<?php

class GiftsController extends BaseController {

	public function getPaypal()
	{
		$financements = '2|3';
		$financements_array = explode('|', $financements);
		/* Calcul du montant */		
		$amount = 0;
		foreach ($financements_array as $f) {
			$g = Gift::find($f);
			var_dump($g->parts);
			var_dump($g->parts);
		}

		$data['financements'] = '2|3';
		$data['amount'] = $amount;
		return View::make('front.gifts.postpaypal')->with($data);
	}

	public function postPaypal()
	{
		$data = [];
		$input = Input::all();
		extract($input);
		
		$financements_array = explode('|', $financements);
		/* Calcul du montant */		
		$amount = 0;
		foreach ($financements_array as $f) {
			$g = Gift::find($f);
			$amount += $g->parts*$g->product->partprice;
			
		}
		$data['key'] = md5($financements.'-PAYPAL');
		$data['financements'] = $financements;
		$data['amount'] = $amount;
		return View::make('front.gifts.postpaypal')->with($data);

	}

	public function getPaypalReturn($commande, $key) 
	{
		if(md5($commande.'-PAYPAL') != $key)
		{
			echo 'la clé ne correspond pas';
			exit();
		}
		$data = [];
		/* On recherhe le dernier paiement PAYPAL */
		$p = Financement::where('type','PAYPAL')->where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->first();
		if(count($p) == 1)
		{
			$data['p'] = $p;
			$data['result'] = 1;
		}
		else
		{
			$data['result'] = 0;
		}
		return View::make('front.paypal.return')->with($data);

	}

	public function getPaypalCancel() 
	{
		return View::make('front.paypal.cancel')->with($data);
		
	}	

	public function postPaypalNotify() 
	{
		$header = '';
	    $req = 'cmd=_notify-validate';    
	    foreach ($_POST as $key => $value) 
	    {
	        $value = urlencode(stripslashes($value));
	        $req .= "&$key=$value";
	    }

	     // renvoyer au système PayPal pour validation

	    $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	    $header .= "Host: www.sandbox.paypal.com\r\n";
	    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	    $fp = fsockopen ("ssl://www.sandbox.paypal.com", 443, $errno, $errstr, 30);   

	    $input = Input::all();
	    extract($input);

	    $item_name 			= $input['item_name'];
	    $item_number 		= $input['item_number'];
	    $payment_status 	= $input['payment_status'];
	    $payment_amount 	= $input['mc_gross'];
	    $payment_currency 	= $input['mc_currency'];
	    $txn_id 			= $input['txn_id'];
	    $receiver_email 	= $input['receiver_email'];
	    $payer_email 		= $input['payer_email'];
	    $order_id 			= $input['custom'];	
	    /*
	    $txn_id = 11111;
	    $custom = '2|3';
		*/
	    $financements_array = explode('|', $custom);
		/* Calcul du montant */		
		$amount_checked = 0;
		foreach ($financements_array as $f) {
			$g = Gift::find($f);
			$amount_checked += $g->parts*$g->product->partprice;
		}

	    
	    // vérifier que txn_id n'a pas été précédemment traité: Créez une fonction qui va interroger votre base de données
	    $nb_txn_id = Financement::where('txn_id',$txn_id)->first()->count();

	    if (!$fp) 
	    {
	        $comment = 'par '.$g->user->name.'. Montant attendu : '.number_format($amount,2) .'€ Moontant proposé '.$payment_amount.' €';
	       Mylog::create(['action' => 'PAYPAL FAIL (!FP)', 'comment' => $comment]);
	    }
	    else
	    {
	    	fputs ($fp, $header . $req);
	        while (!feof($fp)) 
	        {
	            $res = fgets ($fp, 1024);
	            if (strcmp ($res, "VERIFIED") == 0) 
	            {
	            	// transaction valide
	               	// vérifier que payment_status a la valeur Completed
	                if ( $payment_status == "Completed") 
	                {
	                	// vérifier que txn_id n'a pas été précédemment traité: Créez une fonction qui va interroger votre base de données
	                    if ($nb_txn_id == 0) 
	                    {
	                    	// vérifier que receiver_email est votre adresse email PayPal principale
	                        if ( "anne.et.mickael.icartgmail.com" == $receiver_email) 
	                        {
	                        	// vérifier que payment_amount et payment_currency sont corrects
	                        	if(number_format($amount,2) == $payment_amount)
	                        	{
	                        		foreach ($financements_array as $f) 
	                        		{
										$g = Gift::find($f);
										$amount = $g->parts*$g->product->partprice;
										$financement = new financement();
										$financement->gift_id = $g->id;
										$financement->user_id = $g->user_id;
										$financement->type_id = 2;
										$financement->type = 'PAYPAL';
										$financement->txn_id = $txn_id;
										$financement->amount = $amount;
										$financement->payment_amount = $payment_amount;
										$financement->raw = json_encode($input);
										$financement->save();
									}
	                        	}
	                        	else
	                        	{
	                        		$comment = 'par '.$g->user->name.'. Montant attendu : '.number_format($amount,2) .'€ Moontant proposé '.$payment_amount.' €';
	                        		Mylog::create(['action' => 'PAYPAL FAIL (!= MONTANT)', 'comment' => $comment]);
	                        	}
                        		$comment = 'par '.$g->user->name.'. receiver_email = '.$receiver_email;
	                        	Mylog::create(['action' => 'PAYPAL FAIL (!= email)', 'comment' => $comment]);
	                        }
                        	$comment = 'par '.$g->user->name.'. Txn_id = '.$txn_id.'. Montant attendu : '.number_format($amount,2) .'€ Moontant proposé '.$payment_amount.' €';
	                        Mylog::create(['action' => 'PAYPAL FAIL (TXN_ID > 0)', 'comment' => $comment]);
	                    } 				// nb_txn_id
	                    $comment = 'par '.$g->user->name.'. payment_status = '.$payment_status.'. Montant attendu : '.number_format($amount,2) .'€ Montant proposé '.$payment_amount.' €';
	                    Mylog::create(['action' => 'PAYPAL FAIL (STATUT)', 'comment' => $comment]);
	               	} 					// payment_status
	               	$comment = 'par '.$g->user->name.'. res = '.$res.'. Montant attendu : '.number_format($amount,2) .'€ Montant proposé '.$payment_amount.' €';
	                Mylog::create(['action' => 'PAYPAL FAIL (!= VERIFIED)', 'comment' => $comment]);
	            }						// VERIFIED
	       	}							// while						
	    }								// else

	}



	/* ADMINISTRATION */
	public function getAdminListe()
	{
		$data['gifts'] = Gift::orderBy('created_at','ASC')->get();
		return View::make('admin.gifts.liste', $data);
	}












}