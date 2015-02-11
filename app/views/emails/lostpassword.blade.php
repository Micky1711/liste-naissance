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
                                                Vous avez perdu votre mot de passe sur le site de notre liste de naissance ?<br>
                                                <span style="font-weight:bold">Si c'est le cas, cliquez sur le lien ci-dessous (ou faites un copier/coller dans votre barre d'adresse.</span> Sinon ignorez ce mail.
                                            </td>
                                          </tr>
                                          <tr>
                                             <td width="100%" height="15"></td>
                                          </tr>
                                          <tr>
                                           		<td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #333333; text-align:left;line-height: 24px;background-color:#ddd;padding:10px;color:#000;font-weight:bold;text-align:center">
                                           			<a style="color:#0000ff" href="{{ URL::to('/nos-proches/confirm_password/'.urlencode($user->email).'/'.urlencode($key)) }}">{{ URL::to('/nos-proches/confirm_password/'.urlencode($user->email).'/'.urlencode($key)) }}</a>
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