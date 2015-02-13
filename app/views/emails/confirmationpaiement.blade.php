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
                                             <td height="5"></td>
                                          </tr>
                                          <!-- End of spacing -->
                                          <!-- content -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                <p>
                                                Votre paiement PAYPAL de {{$amount }} € a été accepté et à été pris en compte sur le site.<br>
                                                Nous vous en remercions vivement.
                                                </p>
                                            </td>
                                          </tr>
                                          <tr>
                                             <td width="100%" height="15"></td>
                                          </tr>
                                           <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;">
                                                <p><span style="font-weight:bold">Votre paiement concerne les articles suivants :</span></p>
                                                @if(isset($financements) && count($financements) > 0)
                                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="1" class="devicewidthinner">
                                                    @foreach($financements AS $f)
                                                    <tr>    
                                                        <td>
                                                            @if($f->gift->product->photo != "")
                                                                {{ HTML::image('assets/uploads/'.$f->gift->product->photo, 'alt', array( 'width' => 70, 'height' => 70 )) }}
                                                            @else
                                                                &nbsp;
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span style="font-weight:bold">&nbsp;&nbsp;{{ $f->gift->product->name }}</span>
                                                            <br>
                                                            <span style="font-style:italic">&nbsp;&nbsp;{{ $f->gift->product->description }}</span>
                                                        </td>
                                                       <td>
                                                            <span style="font-weight:bold">&nbsp;{{ $f->gift->parts }} à {{ $f->gift->product->partprice }} €</span>
                                                        </td>
                                                        <td>
                                                            <span style="font-weight:bold">&nbsp;soit {{ $f->gift->product->partprice*$f->gift->parts }} €</span>
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