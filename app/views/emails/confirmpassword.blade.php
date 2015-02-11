@extends('layouts.email');


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
                                                ous avez perdu votre mot de passe sur le site de notre liste de naissance.<br>
                                                <span style="font-weight:bold">Vous trouverez votre nouveau mot de passe ci-dessous.</span><br>
                                                Vous pouvez dès que vous serez connecté, vous rendre sur votre profil pour personnaliser votre mot de passe avec celui de votre choix.<br>
                                                <span style="font-weight:bold">Votre nouveau mot de passe est :</span><br>
                                            </td>
                                          </tr>
                                          <tr>
                                             <td width="100%" height="15"></td>
                                          </tr>
                                          <tr>
                                           		<td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;background-color:#ddd;padding:10px;color:#e03454;font-weight:bold;text-align:center">
                                           			{{ $password }}
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