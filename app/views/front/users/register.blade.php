@extends('layouts.main');


@section('content')
<div class="page">
	{{ Form::open(array('route' => array('register'), 'class' => 'form-signin', 'role' => 'form')) }}
		<h2>Je m'inscris</h2>
        <div class="required-field-block">
	        {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Quelle est votre adresse email ?', 'autofocus' => 'autofocus')) }}
	        <div class="required-icon">
	            <div class="text">*</div>
	        </div>
	        @if (isset(Session::get('errors_form')['email'][0])) <div class="alert alert-danger">{{ Session::get('errors_form')['email'][0]}}</div> @endif
        </div>

        <div class="required-field-block">
		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Choisissez un mot de passe (8 caractères minimum)')) }}
	    	<div class="required-icon">
	            <div class="text">*</div>
	        </div>
	        @if (isset(Session::get('errors_form')['password'][0])) <div class="alert alert-danger">{{ Session::get('errors_form')['password'][0]}}</div> @endif
        </div>

        <div class="required-field-block">
		{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirmez votre mot de passe')) }}
	    	<div class="required-icon">
	            <div class="text">*</div>
	        </div>
	        @if (isset(Session::get('errors_form')['password_confirmation'][0])) <div class="alert alert-danger">{{ Session::get('errors_form')['password_confirmation'][0]}}</div> @endif
        </div>

		<hr>	

        <div class="required-field-block">
		{{ Form::text('firstname', '', array('class' => 'form-control', 'placeholder' => 'Quel est votre prénom')) }}
	    	<div class="required-icon">
	            <div class="text">*</div>
	        </div>
	        @if (isset(Session::get('errors_form')['firstname'][0])) <div class="alert alert-danger">{{ Session::get('errors_form')['firstname'][0]}}</div> @endif
        </div>
        <div class="required-field-block">
		{{ Form::text('lastname', '', array('class' => 'form-control', 'placeholder' => 'Quel est votre nom de famille')) }}
	    	<div class="required-icon">
	            <div class="text">*</div>
	        </div>
	        @if (isset(Session::get('errors_form')['lastname'][0])) <div class="alert alert-danger">{{ Session::get('errors_form')['lastname'][0]}}</div> @endif
        </div>
        <div class="required-field-block">
		{{ Form::text('telephone', '', array('class' => 'form-control', 'placeholder' => 'Quel est votre numéro de téléphone (facultatif)')) }}
	        @if (isset(Session::get('errors_form')['telephone'][0])) <div class="alert alert-danger">{{ Session::get('errors_form')['telephone'][0]}}</div> @endif
        </div>

		<div>{{ Form::checkbox('block', '1'); }} Je ne souhaite pas recevoir de mail</div>
		<br>
		{{ Form::button('Envoyer', array('type' => 'submit', 'class' => 'btn btn-lg btn-bambois btn-block')) }}
	{{ Form::close() }}
</div>
@stop
