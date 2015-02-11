<?php

class UserController extends BaseController {

	/*
	 * getLogin()
	 * postLogin()
	 * Fonctions servant à l'identification du membre
	 */
	public function getLogin()
	{
		$data['page'] = 'login';
		return View::make('front.users.login', $data);
	}

	public function postLogin()
	{
		$input = Input::all();
		extract($input);

        if (Auth::attempt(array('email' => $email,'password' => $password), true))
        {
            return Redirect::route('liste');
        }
        else
        {
            return Redirect::route('login')->withInput(Input::except('password'))->with('flash_error', 'Mauvaise identification');
        }
	}

	/*
	 * getLogout()
	 * Fonctions servant à la déconnexion
	 */

	public function getLogout()
	{
		if(Auth::check())
		{
			Auth::logout();
		}
		return Redirect::route('login');
	}

	/*
	 * getRegister()
	 * postRegister()
	 * Fonctions servant à l'enregistrement
	 */

	public function postRegister()
	{
		$input = Input::all();
		$user 		= new User();
		$userValidation 	= $user->validate($input);

		if($user->validate($input))
		{
			// Save in user
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->name = $input['name'];
			$user->save();	

			// Save in group 
			$user->roles()->attach(3);

			/* ENVOI DU MAIL */			
			$input['subject'] = 'Bienvenue sur liste de naissance';
			Mail::send('emails.welcome', $input, function($message) use ($input)
			{
			  	$message->from('mickael@anne-et-mickael.com', 'Liste de naissance ICART');
			  	$message->to($input['email'],  $input['name']);
			  	$message->subject($input['subject']);
			});

			/* Create sessions */
			if (Auth::attempt(array('email' => $input['email'], 'password' => $input['password'])))
			{
				return Redirect::route('liste')->with('success', 'Votre inscription a bien été prise en compte.<br>Un email vous a été envoyé sur votre adresse ('.$input['email'].' avec vos identifiants)');
			}			
		}
		else
		{
			$user_error_array = $user->validate($input) ? array() : $user->errors()->toArray();	
			return Redirect::route('login')
						->withInput(Input::except('password'))
						->with('errors_form_register', $user_error_array);
		}
	}

	/*
	 * postRegisterExpress()
	 * Fonctions servant à l'enregistrement lors d'une commande
	 */
	public function postRegisterExpress()
	{
		$input = Input::all();
		$user 		= new User();
		$contact 	= new Contact();

		$input = Input::all();
		$input['group_id'] = 1;
		$contactValidation 	= $contact->validate($input);
		$userValidation 	= $user->validate($input);

		if($contact->validate($input) && $user->validate($input))
		{
			// Save in user
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->save();	
			// Save in group 
			$user->roles()->attach($input['group_id']);

			// Save in contact
			$contact->user_id = $user->id;
			$contact->firstname = $input['firstname'];
			$contact->lastname = $input['lastname'];
			$contact->telephone = $input['telephone'];
			$contact->block 	= Input::has('block') ? $input['block'] : 0;
			$contact->user_id = $user->id;
			$contact->save();

			/* ENVOI DU MAIL */

			// the data that will be passed into the mail view blade template
			$data = array();
			$input['subject'] = 'Bienvenue sur le site';
			Mail::send('emails.welcome', $input, function($message) use ($input)
			{
			  	$message->from('mickael_ic@hotmail.com', 'Auberge du Bambois');
			  	$message->to($input['email'],  $input['lastname'].' '.$input['lastname']);
			  	$message->subject('Bienvenue sur le site');
			});

			$input = array('email' => Input::get('email'), 'password' => Input::get('password'));
	        if (Auth::attempt($input)) 
	        {
	            echo 'success';
	        }
	        else
	        {
	        	echo 'error'."\n";
	        	echo 'Mauvaise identification';
	        }
		}
		else
		{
			$user_error_array = $user->validate($input) ? array() : $user->errors()->toArray();
			$contact_error_array = $contact->validate($input) ? array() : $contact->errors()->toArray();	
			$tab = array_merge_recursive($user_error_array, $contact_error_array);	
			echo json_encode($tab);	
		}
	}

	public function postLoginExpress()
	{
		 $input = array('email' => Input::get('email'), 'password' => Input::get('password'));
        if (Auth::attempt($input)) 
        {
            echo 'success';
        }
        else
        {
        	echo 'error'."\n";
        	echo 'Mauvaise identification';
        }
	}

	public function getConfirmation($id, $email, $key)
	{
		$user = User::find($id);
		if(count($user))
		{
			if($user->email == $email)
			{
				if(Hash::check($email,$key))
				{
					// Activation script

					// REDIRECTION AVEC MESSAGE FLASH
					return Redirect::route('login')
						->with('flash_success', "Inscription confirmée");
				}
				else 
				{
					$message = "La clé de correspond pas à votre email";
				}		
			}
			else
			{
				$message = "Le mail ne correspond pas à celui de l'inscription";
			}
		}
		else
		{
			$message = "Ce compte n'existe pas ou n\'existe plus";
		}

		if(isset($message) && $message != "")
		{
			return Redirect::route('registrer_confirmation_result')->with('flash_error', $message);
		}
	}


	/*
	 * getLostpassword()
	 * postLostpassword()
	 * getConfirmpassword()
	 * Fonctions servant à récupérer un mot de passe
	 */

	public function getLostpassword()
	{
		return View::make('front.users.lostpasword');
	}
	public function postLostpassword()
	{
		 $input = array('email' => trim(Input::get('email')));
		 $count = User::where('email', $input['email'])->count();

		if($input['email'] == "" || \MyHelper::check_email($input['email']) == false)
		{
            return Redirect::route('lostpassword')->with('error', 'Le compte doit être un email valide');
		}
        elseif ($count == 0) 
        {
            return Redirect::route('lostpassword')->with('error', 'Le compte '.$input['email'].' n\'existe pas'.$count);
        }
        else
        {
        	// Email contenant le lien de confirmation
			$data = array();
			$data['email'] 	= $input['email'];
			$data['user'] 	= User::where('email', $input['email'])->first();
			$data['key']   	= md5($input['email'].'-lostpassword');
			$data['subject'] = 'Mot de passe perdu';

			Mail::send('emails.lostpassword', $data, function($message) use ($data)
			{
			  	$message->from('mickael_ic@hotmail.com', 'Liste de naissance');
			  	$message->to($data['email']);
			  	$message->subject($data['subject']);
			});
          	return Redirect::route('lostpassword')->with('success', 'Un email a été envoyé à l\'adresse email suivante : '.$data['email']);
        }

	}

	public function getConfirmpassword($email, $key)
	{
		$email = urldecode($email);
		$key = urldecode($key); 
		$count = User::where('email', $email)->count();
		if($count == 0)
		{
			Session::flash('error', 'Le compte n\'existe pas ou n\'existe plus'); 
			return View::make('front.users.confirmpassword');
		}
		elseif(md5($email.'-lostpassword') != $key)
		{
			$password   = \MyHelper::generate_password(10);
			Session::flash('error', 'La clé ne correspond pas');
			return View::make('front.users.confirmpassword');
		}
		else
		{
		
			$user 		= User::where('email', $email)->first();
			$password   = \MyHelper::generate_password(10);

			// Email contenant le lien de confirmation
			$data 				= array();
			$data['user'] 		= $user;
			$data['password']   = $password;
			$data['subject'] 	= 'Votre nouveau mot de passe';
			Mail::send('emails.confirmpassword', $data, function($message) use ($data)
			{
			  	$message->from('mickael@anne-et-mickael.com', 'Liste de naissance');
			  	$message->to($data['user']->email);
			  	$message->subject($data['subject']);
			});
         

			// Inscription du nouveau mot de passe dans la base
			$user->email = $email;
			$user->password = Hash::make($password);
			$user->save();	

			Session::flash('success', 'Un mot de passe a été envoyé à l\'adresse email suivante : '.$email);
			return View::make('front.users.confirmpassword');
		}
	}


	/*
	 * PROFIL
	 * getProfil()
	 * postProfil()
	 */

	public function getProfil()
	{
		return View::make('front.users.profil');
	}

	public function postProfil()
	{
		$input = Input::all();
		$user 		= User::find(Auth::user()->id);
		$changepassword = 1;
		if($input['password'] == "")
		{
			$input['password'] 				= Auth::user()->password;
			$input['password_confirmation'] = Auth::user()->password;
			$changepassword = 0;
		}
	
		$rules = array('email' => 'required|email|unique:users,email,'.Auth::user()->id,
						'name' => 'required|between:3,100');

		if($user->validate($input, $rules))
		{
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->save();

			$success_sentence = ($changepassword == 1) ? 'Vos informations et votre mot de passe ont été mis à jour ' : 'Vos informations ont été mises à jour';
			return Redirect::route('profil')
						->withInput(Input::except('password'))
						->with('success', $success_sentence);

		}
		else
		{
			$user_error_array = $user->validate($input, $rules) ? array() : $user->errors()->toArray();	
			return Redirect::route('profil')
						->withInput(Input::except('password'))
						->with('errors_form', $user_error_array);
			
		}
	}


	public function getConfirmationError() {

	}
	public function getCreate()
	{
		$user = new User;
		$user->email = "mickael.icart2@gmail.com";
		$user->password = Hash::make('iedoezw3');
		$user->save();
		$user->roles()->attach(1);
	}

	public function getTestmail()
	{
			$data = array("title" => "titre de la page");
			Mail::send('emails.welcome', $data, function($message)
			{
			  	$message->from('mickael_ic@hotmail.com', 'Auberge du Bambois');
			  	$message->to("mickael@anne-et-mickael.com",  "Mickael ICART");
			  	$message->subject('Bienvenue sur le site');
			});
	}





	public function getAdminListe()
	{
		$data['users'] = User::orderBy('created_at','ASC')->get();
		return View::make('admin.users.liste', $data);
	}

	public function postAdminDelete()
	{
		$id = Input::get('id');
		$user = User::find($id);
		echo $user->email;
		$user->delete();
	}

	public function getAdminEdit($id)
	{
		$user = User::find($id);		

		foreach($user->roles AS $k => $v)
		{
			$data['userroles'][$k] = $v['id'];
		}

		$data['user'] = $user;
		$data['roles'] = Role::All();;
		return View::make('admin.users.fiche')->with($data);
	}

	public function postAdminEdit()
	{
		$input = Input::all();
		extract($input);
		$id = $user_id;
		$user 		= User::find($id);

		$changepassword = 1;
		if(trim($input['password']) == "")
		{
			$input['password'] 				= $user->password;
			$input['password_confirmation'] = $user->password;
			$changepassword = 0;
		}
		
		/* règle supplémentaire pour la modification */
		$rules = array('email' => 'required|email|unique:users,email,'.$user->id);
		if($user->validate($input, $rules))
		{
			$user->name = $name;
			$user->email = $email;
			if($changepassword == 1)
				$user->password = Hash::make($input['password']);
			$user->save();
			
			$user->roles()->sync(Input::get('role_id', array()));

			return Redirect::route('admin.users.fiche', ['id' => $id])
						->withInput(Input::except('password'))
						->with('success', 'Les informations du profil ont bien été mises à jour.');
		}
		else
		{
			$errors_form = $user->errors()->toArray();
			return Redirect::route('admin.users.fiche', ['id' => $id])
						->withInput(Input::except('password'))
						->with('errors_form', $errors_form);
			
		}
	}

	public function getAdminClient($id)
	{
		$user = User::find($id);		
		$data['user'] = $user;
		$data['titre'] = 'Historique client de '.$user->contact->firstname.' '.$user->contact->lastname;
		return View::make('admin.users.client')->with($data);
	}


	public function getAdminCreate()
	{
		$data['titre'] = 'Ajout d\'un utilisateur';
		return View::make('admin.users.create')->with($data);
	}

	public function postAdminCreate()
	{
		$contact 	= new Contact();
		$user 		= new user();
		$input 		= Input::all();
		if($contact->validate($input) && $user->validate($input))
		{
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->save();

			$user->roles()->attach($input['group_id']);

			$contact->user_id 	= $user->id; 	
			$contact->lastname 	= $input['lastname']; 	
			$contact->firstname = $input['firstname']; 
			$contact->telephone = $input['telephone']; 
			$contact->block 	= Input::has('block') ? $input['block'] : 0;
			$contact->save();

			return Redirect::route('admin.users.liste')
						->with('success', 'L\'utilisateur a été créé avec succès');

		}
		else
		{
			$user_error_array = $user->validate($input) ? array() : $user->errors()->toArray();
			$contact_error_array = $contact->validate($input) ? array() : $contact->errors()->toArray();
			return Redirect::route('admin.users.create')
				->withInput(Input::except('password'))
				->with('errors_form', array_merge_recursive($user_error_array, $contact_error_array));	
		}	
	}

}