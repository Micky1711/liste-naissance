@extends('layouts.front')

@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Financement libre</h2>
				<p>Si vous ne souhaiter par directement financer un article de la liste de naissance, ou si vous souhaitez nous offrir un montant particuliers, vous pouvez vous faire un versement libre en euros.</p>
				<p>La somme indiquée pourra être remise en mains propres en liquide, par chèque. Ou par un virement ou directement en ligne par Paypal.</p>
			</div>
			<div class="col-md-6">
				<h2>Mon financement</h2>
				{{ Form::open(array('route' => array('libre'), 'class' => 'form-signin', 'role' => 'form')) }}
					
					<div>Je souhaite financer pour <br>
					{{ Form::text('montant', '', array('class' => 'form-control inline', 'placeholder' => 'Montant en euros')) }}
					 @if (isset(Session::get('gift_errors')['montant'][0])) <div class="alert alert-danger">{{ Session::get('gift_errors')['montant'][0]}}</div> @endif

					</div>
					<div>Par<br>
						{{ Form::radio('moyen', 'ESPECES') }} Espèce<br>
						{{ Form::radio('moyen', 'CHEQUE') }} Chèque<br>
						{{ Form::radio('moyen', 'VIREMENT') }} Virement<br>
						{{ Form::radio('moyen', 'PAYPAL', true) }} Paypal
					</div>
					<br>
					{{ Form::button('Envoyer', array('type' => 'submit', 'class' => 'btn btn-lg btn-info btn-block i')) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</section>
@stop