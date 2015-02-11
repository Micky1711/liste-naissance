<?php

class ProductsController extends BaseController {

	public function getListe()
	{
		$data = [];
		$data['products'] = Product::where('display',1)->OrderBy('force','DESC')->get();
		return View::make('front.products.liste', $data);
	}

	public function postListe()
	{
		$input = Input::all();
		extract($input);
		$error = array();
		$success = array();
		/* 
			Pour les achats et offres, on vérifie que le lot n'a pas été confirmé par quelqu'un d'autre entre-temps 
			Si c'est le cas, on check l'erreur
		*/

		if(isset($achat) && is_array($achat) && count($achat) > 0)
		{

			foreach($achat AS $product_id => $parts)
			{
				if($parts > 0)
				{
					$product = Product::find($product_id);
					if($product->statut == 100)
					{
						$message['danger'][$product_id] = 'L\'article <b>'.$product->name.'</b>  a été réservé entre votre sélection et votre validation, il ne fait plus parti de votre sélection';
					}
					elseif($product->statut > 0)
					{
						/* Vérfier dans le cadre d'un achat mixte qu'un financement n'a pas été fait entre temps */
						$message['danger'][$product_id] = 'Une ou plusieurs parts de l\'article <b>'.$product->name.'</b>  ont été financé entre  otre sélection et votre validation, il ne peux plus être offert auremùent qu\'en financement';
					}


					if($product->statut == 0)
					{
						$gift = new Gift();
						$gift->user_id = Auth::user()->id;
						$gift->product_id = $product_id;
						$gift->type = 1;
						$gift->parts = $parts;
						$gift->save();

						$product->statut = 100;
						$product->save();

						$message['success'][$product_id] = 'Vous vous êtes engagé à offrir l\'article <b>'.$product->name.'</b>';
						$email['achat'][$product_id] = $gift;

						$comment = Auth::user()->name.' s\'engage a offrir l\'article '.$product->name;
						
						Mylog::create(['action' => 'ENGAGEMENT','comment' => $comment]);
					}
				}
			}
		}
		
		if(isset($financement) && is_array($financement) && count($financement) > 0)
		{
			foreach($financement AS $product_id => $parts)
			{
				if($parts > 0)
				{
					/*Calcul du nombre de part disponible à ce moment */
					$product = Product::find($product_id);
					$partsdispos = round($product->parts*(1-$product->statut/100)); 

					if($product->statut == 100)
					{
						$message['danger'][$product_id] = 'L\'article <b>'.$product->name.'</b>  a été financé en intégralité entre votre sélection et votre validation, il ne fait plus parti de votre sélection';
					}
					elseif($partsdispos < $parts)
					{
						$message['danger'][$product_id] = 'L\'article <b>'.$product->name.'</b>  a été financé en parti entre votre sélection et votre validation, il ne reste plus que '.$partsdispos.' parts disponibles';
					}

					if($product->statut != 100 && $partsdispos >= 1)
					{
						$gift = new Gift();
						$gift->user_id = Auth::user()->id;
						$gift->product_id = $product_id;
						$gift->type = 2;
						$gift->parts = ($partsdispos > $parts) ? $parts : $partsdispos;
						$gift->save();

						$partmarginale = round((1/$product->parts)*100);

						$product->statut = round($product->statut+$gift->parts*$partmarginale);
						$product->save();
						$partseffectives = ($partsdispos > $parts) ? $parts : $partsdispos;

						$message['success'][] = 'Vous vous êtes engagé à financer l\'article <b>'.$product->name.'</b> à hauteur de '.$partseffectives.' part(s)';
						$comment = Auth::user()->name.' s\'engage a financer l\'article '.$product->name.'( '.$gift->parts.' part(s) sur '.$partseffectives.' à '.$product->partprice.' € l\'une)';
						$email['financement'][$product_id] = $gift;

						Mylog::create(['action' => 'ENGAGEMENT','comment' => $comment]);
					}
				}
			}
		}

		/* Envoi d'un email récapitulant les réservations */
		if(isset($email) && is_array($email) && count($email) > 0)
		{
			/* Envois des mails */
			$email['user'] = User::find(Auth::user()->id);			
			$email['subject'] 	= 'Vos réservations pour la liste de naissance d\'Anne et Mickaël';
			Mail::send('emails.reservations', $email, function($message) use ($email)
			{
			  	$message->from('mickael.icart@gmail.com', 'Liste de naissance Anne et Mickaël');
			  	$message->to('mickael.icart@gmail.com',  'You');
			  	$message->subject($email['subject']);
			});		
		}

		return Redirect::route('offres')
				->with('message', $message);




	}

	public function getUserListe()
	{
		$data = [];
		$data['user'] = User::find(Auth::user()->id);
		$gift = Gift::where('user_id',Auth::user()->id)->where('type',2)->where('close','0000-00-00')->get();
		$somme = 0;
		if(count($gift) > 0)
		{
			foreach ($gift as $g) 
			{
				$somme += $g->parts*$g->product->partprice;
				$id[] = $g->id;
			}
			$id_financement = implode('|', $id);
			$data['id_financement'] = $id_financement;
		}
		$data['somme'] = $somme;

		return View::make('front.products.userliste', $data);
	}

	public function postUserRenoncement()
	{
		$input = Input::all();
		extract($input);

		if(count($input) > 0)
		{
			if($key == md5($time.$id.$product_id.'renoncement'))
			{
				echo "1";

				$gift = Gift::find($id);				

				/* Abaissement du statut du produit */
				$product = Product::find($gift->product_id);
				if($gift->type == 1)
					$product->statut = 0;
				else
					$product->statut = round($product->statut-round(($gift->parts/$product->parts)*100));
				$product->save();

				/* Trace dans un log */
				if($gift->type == 1)
					$comment = $gift->user->name.' renonce(nt) à offrir l\'article '.$product->name;
				else
					$comment = $gift->user->name.' renonce(nt) à financer '.$gift->parts.' part(s) à '.$product->partprice.' € l\'une de l\'article '.$product->name;
				Mylog::create(['action' => 'RENONCEMENT', 'comment' => $comment, 'user_id' => Auth::user()->id ]);

				/* Destruction de la demande d'offre */
				Gift::destroy($id);

				/* Envois des mails */

			}
			else
			{
				echo 'error'."\n".'La clé de sécurité ne correspond pas, l\'utilisation de ce bouton semble détournée';
			}
		}
		else
		{
			echo 'error'."\n".'Une erreur est survenu, le produit n\'a pas pu être supprimé.';
		}
	}


	public function getAdminListe()
	{
		$data['products'] = Product::all();
		return View::make('admin.products.liste', $data);
	}

	public function postAdminAdd()
	{
		$input = Input::all();

		if(isset($input['id']))
		{
			$product = Product::find($input['id']);
			if($product->validate($input))
			{
				$array = ['_token'];
				foreach($input AS $k => $v)
				{
					if(!in_array($k, $array) )
						$product->$k = $v;
				}
				$product->save();

				return Redirect::route('admin.products.edit', array('id' => $input['id']))->with('success', 'L\'article '.$input['name'].' a été modifié avec succès');
			}
			else
			{
				return Redirect::route('admin.products.edit', ['id' => $input['id']])
									->withInput()
									->with('errors_form', $product->errors()->toArray())
									->with('error', 'L\'article doit porter un nom');
			}

		}
		else
		{
			$product = new Product();
			if($product->validate($input))
			{
				Product::create($input);
				return Redirect::route('admin.products.liste')->with('success', 'L\'article '.$input['name'].' a été ajouté avec succès');

			}
			else
			{
				return Redirect::route('admin.products.add')
									->withInput()
									->with('errors_form', $product->errors()->toArray())
									->with('error', 'L\'article doit porter un nom');
			}
		}

	}

	public function getAdminAdd($id="")
	{	
		$data = array();
		if($id > 0)
		{
			$data['form'] = "edit";
			$product = Product::find($id);
			if(count($product)==1)
			{
				$data['product'] = $product;
			}
			else
			{
				return Redirect::route('admin.products.liste')->with('error', 'Ce produit n\'existe pas');
			}
		}
		else 
		{
			$data['product'] = new Product();
			$data['form'] = "add";
		}
		return View::make('admin.products.add')->with($data);
	}

	public function getAdmininfo($id)
	{	
		$data = array();
		$product = Product::find($id);
		if(count($product)==1)
		{
			$data['product'] = $product;
		}
		else
		{
			return Redirect::route('admin.products.liste')->with('error', 'Ce produit n\'existe pas');
		}
		return View::make('admin.products.info')->with($data);
	}
}