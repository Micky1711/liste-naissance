@extends('layouts.front')


@section('content')
<section>
	<div class="container">
		<div class="row">
	   
			{{ Form::open(array('route' => array('lostpassword'), 'class' => 'form-signin', 'role' => 'form')) }}
				<h2>Mot de passe perdu</h2>
				@include('front.partials.messages')  
		 		<div class="required-field-block">
			        {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Quelle est votre adresse email ?', 'autofocus' => 'autofocus')) }}
		        </div>
		        <br>
				{{ Form::button('Valider', array('type' => 'submit', 'class' => 'btn btn-lg btn-info')) }}
				{{ HTML::linkRoute('login', 'S\'identifier') }}
			{{ Form::close() }}
		</div>
	</div>
</section>
@stop
