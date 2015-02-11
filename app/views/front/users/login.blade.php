@extends('layouts.front')

@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
			{{ Form::open(array('route' => array('register'), 'class' => 'form-signin', 'role' => 'form')) }}
				<h2>Je m'inscris</h2>

		        <div class="required-field-block">
				{{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Qui êtes-vous ?')) }}
			        @if (isset(Session::get('errors_form_register')['name'][0])) <div class="alert alert-danger">{{ Session::get('errors_form_register')['name'][0]}}</div> @endif
		        </div>
		        <br />
		        <div class="required-field-block">
			        {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Quelle est votre adresse email ?', 'autofocus' => 'autofocus')) }}
			        @if (isset(Session::get('errors_form_register')['email'][0])) <div class="alert alert-danger">{{ Session::get('errors_form_register')['email'][0]}}</div> @endif
		        </div>
		         <br />
		        <div class="required-field-block">
				{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Choisissez un mot de passe (8 caractères minimum)')) }}
			        @if (isset(Session::get('errors_form_register')['password'][0])) <div class="alert alert-danger">{{ Session::get('errors_form_register')['password'][0]}}</div> @endif
		        </div>
		         <br />
		        <div class="required-field-block">
				{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirmez votre mot de passe')) }}
			        @if (isset(Session::get('errors_form_register')['password_confirmation'][0])) <div class="alert alert-danger">{{ Session::get('errors_form_register')['password_confirmation'][0]}}</div> @endif
		        </div>
		         <br />
				{{ Form::button('Envoyer', array('type' => 'submit', 'class' => 'btn btn-lg btn-info btn-block')) }}
			{{ Form::close() }}
			</div>
			<div class="col-md-6">
				{{ Form::open(array('route' => array('login'), 'class' => 'form-signin', 'role' => 'form')) }}
					<h2>Je m'identifie</h2>
					@if (Session::has('flash_error'))
						<div class="alert alert-danger">
							<h4>Une erreur a été constatée :</h4>
							<div>{{ Session::get('flash_error') }}</div>
						</div>
					@endif
					@include('front.partials.messages')
			 		<div class="required-field-block">
				        {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Quelle est votre adresse email ?', 'autofocus' => 'autofocus')) }}
			        </div>
			         <br />
			        <div class="required-field-block">
						{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Quel est votre mot de passe ?')) }}
			        </div>
		         	<br />
					{{ Form::button('Submit', array('type' => 'submit', 'class' => 'btn btn-lg btn-info btn-block')) }}
					{{ HTML::linkRoute('lostpassword', 'Mot de passe perdu ?') }}
				{{ Form::close() }}

			</div>
		</div>
	</div>
</section>
@stop
