@extends('layouts.front')

@section('content')
<section>
{{ Form::open(array('route' => array('profil'), 'class' => 'form-signin', 'role' => 'form')) }}
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Mon profil</h2>
				 @include('front.partials.messages')
				{{ Form::label('email', 'Email', array('class' => 'col-sm-2')) }}
			    <div class="col-sm-10">
			     	{{ Form::text('email', Auth::user()->email, array('class' => 'form-control', 'autofocus' => 'autofocus')) }}
			     	@if(isset(Session::get('errors_form')['email'][0]))
			     		<div class="alert alert-danger">{{ Session::get('errors_form')['email'][0]}}</div>
					@endif
			    </div>
			    <br><br>
			    {{ Form::label('name', 'Nom', array('class' => 'col-sm-2')) }}
				<div class="col-sm-10">
					{{ Form::text('name', Auth::user()->name, array('class' => 'form-control')) }}
					@if(isset(Session::get('errors_form')['name'][0]))
			     		<div class="alert alert-danger">{{ Session::get('errors_form')['name'][0]}}</div>
					@endif
				</div>				
			</div>
			<div class="col-md-6">				
				<h2>Changer mon mot de passe</h2>
				<div class="alert alert-info">Si vous ne souhaitez pas modifier votre mot de passe, laissez les champs ci-dessous vides.</div>
				
				<div class="col-sm-10">
					{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Votre nouveau mot de passe')) }}
					@if(isset(Session::get('errors_form')['password'][0]))
			     		<div class="alert alert-danger">{{ Session::get('errors_form')['password'][0]}}</div>
					@endif
				</div>
				<br><br>
				<div class="col-sm-10">
					{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirmez votre nouveau mot de passe')) }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-center">
				<br><br>{{ Form::button('Modifier mon profil', array('type' => 'submit', 'class' => 'btn btn-md btn-info')) }}
			</div>
		</div>
	</div>
{{ Form::close() }}
</section>
@stop