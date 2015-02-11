<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h2>Financement par PAYPAL des articles sélectionnés</h2>
			<div class="row">
				<div class="col-xs-12 text-center">
					<img src="/assets/images/loading.gif" alt="">
				</div>
			</div>
			 <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="form_paypal" class="hide">
				<input name="amount" type="hidden" value="{{ $amount }}"/>
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

		</div>
    </div>

