@extends('layouts.email')

@section('content')


<table width="100%" bgcolor="#e8eaed" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td width="100%" height="20"></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                       <tbody>
                                          <!-- Title -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight:bold; color: #333333; text-align:left;line-height: 24px;">
                                                Bonjour {{ $name }}
                                             </td>
                                          </tr>
                                          <!-- End of Title -->
                                          <!-- spacing -->
                                          <tr>
                                             <td height="5">&nbsp;</td>
                                          </tr>
                                          <!-- End of spacing -->
                                          <!-- content -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                <p>Vous souhaitez nous faire parvenir librement la somme de {{ $montant }} euros par {{ $moyen }}. Nous vous en remercions vivement.</p>
                                                <p><span style="font-weight:bold">Si vous avez choisi des produits à financer</span>, vous pouvez nous faire parvenir un chèque (à l'ordre d'Anne et Mickaël ICART)<br>
                                                ou un virement ou bien payer en ligne via Paypal dans le lien "mes offres" sur le site
                                                </p>

                                            </td>
                                          </tr>
                                          <tr>
                                             <td width="100%" height="15"></td>
                                          </tr>
                                          <tr>
                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                Vous pouvez revenir sur votre décision et renoncer à offrir certains articles, mais dans ce cas faites le savoir dans le lien "mes offres" sur le site afin que d'autres personnes puissent le réserver à leur tour.
                                                </td>
                                          </tr>
                                          @if($moyen == 'PAYPAL')
                                          <tr>
                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                  Puisque vous avez choisi de payer par Paypal, la redirection automatique vous a normalement déjà mené sur le site Paypal où vous avez pu faire le versement.<br>    *
                                                  Si vous souhaitez envoyer vos fonds plus tard, vous pourrez le faire depuis "Mon compte" > "{{ HTML::linkRoute('offres', 'Mes offres') }}"
                                                </td>
                                          </tr>
                                          @elseif($moyen == 'VIREMENT')
                                          <tr>
                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                  Puisque vous avez choisi de payer par virement bancaire, vous trouverez en pièce jointe à ce mail notre RIB.
                                                </td>
                                          </tr>
                                           @elseif($moyen == 'CHEQUE')
                                          <tr>
                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                  Puisque vous avez choisi de payer par chèque, celui-ci doit être adressé à Mickaël et Anne ICART et envoyé à :<br>
                                                  Mickaël et Anne ICART<br>
                                                  82 Grande-Rue<br>
                                                  88490 Provenchères sur Fave
                                                </td>
                                          </tr>
                                          @elseif($moyen == 'ESPECES')
                                          <tr>
                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                  Puisque vous avez choisi de payer par liquide, il vaut mieux qu'on se voit :)
                                                </td>
                                          </tr>
                                          @endif
                                          <tr>
                                             <td width="100%" height="5">&nbsp;</td>
                                          </tr>
                                           <tr>
                                                <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                  <b>Si vous souhaitez finalement financer par un autre moyen :</b><br>
                                                  @if($moyen != 'PAYPAL')
                                                    Vous pourrez le faire par Paypal depuis "Mon compte" > "{{ HTML::linkRoute('offres', 'Mes offres') }}"<br>
                                                  @endif
                                                  @if($moyen != 'VIREMENT')
                                                    Vous souhaitez finalement faire un virement, vous trouverez en pièce jointe à ce mail notre RIB<br>
                                                  @endif
                                                  @if($moyen != 'CHEQUE')
                                                    Vous souhaitez signez un chèque, celui-ci doit être adressé à Mickaël et Anne ICART et envoyé à :<br>
                                                    Mickaël et Anne ICART<br>
                                                    82 Grande-Rue<br>
                                                    88490 Provenchères sur Fave<br>
                                                  @endif
                                                  @if($moyen != 'ESPECES')
                                                    Si vous opter au final pour la remise d'argent liquide, il vaut mieux qu'on se voit :)
                                                  @endif
                                                </td>
                                          </tr>
                                          <!-- End of content -->
                                          <!-- Spacing -->
                                          <tr>
                                             <td width="100%" height="5"></td>
                                          </tr>
                                          <!-- Spacing -->
                                          <!-- button -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight:bold; color: #333333; text-align:left;line-height: 24px;">
                                                <a href="{{ URL::to('/') }}" style="color:#9ec459;text-decoration:none;font-weight:bold;">Se rendre sur le site</a>
                                             </td>
                                          </tr>
                                          <!-- /button -->
                                          <!-- Spacing -->
                                          <tr>
                                             <td width="100%" height="20"></td>
                                          </tr>
                                          <!-- Spacing -->
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>



@stop