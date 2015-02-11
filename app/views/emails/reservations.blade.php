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
                                                Bonjour {{ $user->name }}
                                             </td>
                                          </tr>
                                          <!-- End of Title -->
                                          <!-- spacing -->
                                          <tr>
                                             <td height="5"></td>
                                          </tr>
                                          <!-- End of spacing -->
                                          <!-- content -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                <p>Vous avez réserver un ou plusieurs articles sur le site de notre liste de naissance.<br>Nous vous en remercions vivement.</p>
                                                <p><span style="font-weight:bold">Si vous avez choisi des produits à offrir</span>, vous pouvez nous les remettre en main propres ou par un tiers.<br>
                                                Vous pouvez également les faire parevenir par voie postale à l'adresse suivante :
                                                <br>
                                                Anne et Mickaël ICART<br>82 Grande Rue<br>88490 Provenchères-sur-Fave.</p>
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
                                                Vous pouvez revenir sur votre déicision et renoncer à offrir certains articles, mais dans ce cas faites le savoir dans le lien "mes offres" sur le site afin que d'autres personnes puissent le réserver à leur tour.
                                                </td>
                                          </tr>
                                           <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                <p><span style="font-weight:bold">Votre liste</span></p>
                                                @if(isset($achat) && count($achat) > 0)
                                                    <p>Vos articles à offrir</p>
                                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="1" class="devicewidthinner">
                                   
                                                    @foreach($achat AS $g)
                                                    <tr>    
                                                        <td>
                                                            @if($g->product->photo != "")
                                                                {{ HTML::image('assets/uploads/'.$g->product->photo, 'alt', array( 'width' => 70, 'height' => 70 )) }}
                                                            @else
                                                                &nbsp;
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span style="font-weight:bold">&nbsp;&nbsp;{{ $g->product->name }}</span>
                                                            <br>
                                                            <span style="font-style:italic">&nbsp;&nbsp;{{ $g->product->description }}</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </table>
                                                @endif
                                                
                                                @if(isset($financement) && count($financement) > 0)
                                                    <p>Vos articles à financer</p>
                                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="1" class="devicewidthinner">
                                                    @foreach($financement AS $g)
                                                    <tr>    
                                                        <td>
                                                            @if($g->product->photo != "")
                                                                {{ HTML::image('assets/uploads/'.$g->product->photo, 'alt', array( 'width' => 70, 'height' => 70 )) }}
                                                            @else
                                                                &nbsp;
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span style="font-weight:bold">&nbsp;{{ $g->product->name }}</span>
                                                            <br>
                                                            <span style="font-style:italic">&nbsp;{{ $g->product->description }}</span>
                                                        </td>
                                                        <td>
                                                            <span style="font-weight:bold">&nbsp;{{ $g->part }} à {{ $g->product->partprice }} €</span>
                                                        </td>
                                                        <td>
                                                            <span style="font-weight:bold">&nbsp;soit {{ $g->product->partprice*$g->part }} €</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </table>
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