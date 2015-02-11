@extends('layouts.front')

@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Financement libre</h2>
				<p>
					Vous avez émis le souhait de nous faire un financement libre de {{ $montant }} par {{ $moyen }}. Nous vous en remercions.<br>
					Vous trouverez à titre indicatif ci-dessous les informations nécessaires popur vous faire parvenir cette forme.<br>
					Ces informations vous sont aussi envoyé sur votre email ({{ $email}}).
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@if($moyen == 'PAYPAL')
				<h3>Vous avez choisi PAYPAL</h3>
				<p>
				Vous allez être ridigé d'ici quielques secondes sur le site de Paypal.<br>
				Si vous souhaitez envoyer vos fonds plus tard, vous pourrez le faire depuis "Mon compte > {{ HTML::linkRoute('offres', 'Mes offres') }}"
				</p>
				<div class="row">
					<div class="col-xs-12 text-center">
						<img src="/assets/images/loading.gif" alt="">
					</div>
				</div>
				 <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="form_paypal" class="hide">
					<input name="amount" type="hidden" value="{{ $montant }}"/>
					<input name="currency_code" type="hidden" value="EUR" />
					<input name="shipping" type="hidden" value="0.00" />
					<input name="tax" type="hidden" value="0.00" />
					<input name="return" type="hidden" value="{{ URL::route('paypal.return',['commande' => $financements, 'key' => $key ]) }}" />
					<input name="cancel_return" type="hidden" value="{{ URL::route('paypal.cancel') }}" />
					<input name="notify_url" type="hidden" value="{{ URL::route('paypal.notify') }}" />
					<input name="cmd" type="hidden" value="_xclick" />
					<input name="business" type="hidden" value="anne.et.mickael.icart-facilitator@gmail.com" />
					<input name="item_name" type="hidden" value="Financement(s) liste de naissance Anne et Mickaël" />
					<input name="no_note" type="hidden" value="1" />
					<input name="lc" type="hidden" value="FR" />
					<input name="bn" type="hidden" value="PP-BuyNowBF" />
					<input name="custom" type="hidden" value="{{ $financements }}" />
					<input alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et sécurisée" name="submit" src="https://www.paypal.com/fr_FR/FR/i/btn/btn_buynow_LG.gif" type="image" /><img src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" border="0" alt="" width="1" height="1" />
				</form>
				@elseif($moyen == 'VIREMENT')
				<h3>Vous avez choisi le virement</h3>
				<p>
					Notre RIB vous a été envoyé dans votre boite mail.
				</p>
				@elseif($moyen == 'CHEQUE')
				<h3>Vous avez choisi le chèque</h3>
				<p>
					Le chèque doit être adressé à Mickaël et Anne ICART et envoyé à :<br>
					Mickaël et Anne ICART<br>
					82 Grande-Rue<br>
					88490 Provenchères sur Fave
				</p>
				@elseif($moyen == 'ESPECES')
				<h3>Vous avez choisi de nous donner des espèces</h3>
				<p>
					Dans ce cas, il vaut mieux qu'on se voit :)
				</p>
				@endif				
			</div>
		</div>
	</div>
</section>
@stop

@section('footer')
<script>
$(function() {
	$("form#form_paypal").submit();
});
</script>
@stop