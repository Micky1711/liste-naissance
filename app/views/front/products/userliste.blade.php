@extends('layouts.front')

@section('content')
<section id="mainsection">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2>Mes offres / Mes engagements</h2>
				 @include('front.partials.messages')
			</div>
        </div>
        @if(Session::has('message'))
        <div class="row">
            <div class="col-xs-12">
                @if(isset(Session::get('message')['danger']))
                   @foreach(Session::get('message')['danger'] AS $k => $v)
                    <div class="alert alert-danger">
                        {{ $v }}
                    </div>
                   @endforeach
                @endif
                @if(isset(Session::get('message')['danger']))
                   @foreach(Session::get('message')['success'] AS $k => $v)
                    <div class="alert alert-success">
                        {{ $v }}
                    </div>
                   @endforeach
                @endif
            </div>
        </div>  
        @endif
        @if($somme > 0)
        <div class="row">
            <div class="col-xs-12">
               {{ $somme }} € restant à financer d'après vos engagement {{ Form::button('Solder le financement maintenant', array('type' => 'button', 'class' => 'btn btn-xs btn-success btn-financement', 'id'=>'solderlefinancement', 'data-id' => $id_financement)) }}
            </div>
        </div>    
        <br><br>    
        @endif
        <div class="row">
			<div class="col-xs-12">

                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>image</th>
                                <th>Produit</th>
                                <th>Description</th>
                                <th>type</th>
                                <th>Hauteur du financement</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>image</th>
                                <th>Produit</th>
                                <th>Description</th>
                                <th>type</th>
                                <th>Hauteur du financement</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach($user->gifts AS $p)
                        <tr id="tr_{{ $p->id }}">
                            <td>
                            @if($p->product->photo != "")
                                {{ HTML::image('assets/uploads/'.$p->product->photo, 'alt', array( 'width' => 70, 'height' => 70 )) }}
                            @endif
                            </td>
                            <td>
                                <b>{{ $p->product->name }}</b>
                            </td>
                            <td>{{ $p->product->description }}</td>
                                <td>
                                @if($p->type == 1)
                                    <div class="btn btn-success btn-xs">Achat</div>
                                @elseif($p->type == 2)   
                                    <div class="btn btn-primary btn-xs">Financement</div>
                                @endif  
                            </td>
                           	<td>
								@if($p->type == 1)
                                    &nbsp;
                                @elseif($p->type == 2)   
                                	<strong>{{ $p->product->partprice* $p->parts }} €</strong><br>
                                    @if($p->product->id > 0)
                                        {{ $p->parts }} part(s) / {{ $p->product->parts }}
                                    @endif 
                                @endif  
                           	</td>
                           	<td>
								{{ MyHelper::datefr($p->created_at, 0) }}
                           	</td>
                            <td>
                                @if($p->close == 0000-00-00)
                                    <a href="#" class="renoncement btn btn-xs  btn-danger" data-time="{{ time() }}" data-id="{{ $p->id }}" data-product="{{ $p->product_id }}" data-key="{{ md5(time().$p->id.$p->product_id.'renoncement') }}">Je renonce</a>
                                    @if($p->type == 2)  
                                        <br><br>
                                        <a href="#" class="financementunique btn-md btn btn-success btn-financement" data-id="{{ $p->id }}">Je finance</a>
                                    @endif 
                                @else
                                    @if($p->type == 1)
                                        {{ Form::button('Article offert', array('type' => 'button', 'class' => 'btn btn-xs btn-success btn-block')) }}
                                    @elseif($p->type == 2)   
                                        {{ Form::button('Article financé', array('type' => 'button', 'class' => 'btn btn-xs btn-success btn-block')) }}
                                    @endif  
                                @endif
                           </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->

			</div>
		</div>
        @if(count($user->financements) > 0)
        <div class="row">
            <div class="col-xs-12">
                <h2>Détail de mes financements</h2>
            </div>
            <div class="col-xs-12">
                <div class="box-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>image</th>
                                <th>Produit</th>
                                <th>Moyen</th>
                                <th>Montant</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>image</th>
                                <th>Produit</th>
                                <th>Moyen</th>
                                <th>Montant</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach($user->financements AS $f)
                        <tr id="tr_{{ $f->id }}">
                            <td>
                            @if($f->gift_id > 0)
                                @if($f->gift->product->photo != "")
                                    {{ HTML::image('assets/uploads/'.$f->gift->product->photo, 'alt', array( 'width' => 70, 'height' => 70 )) }}
                                @endif
                            @endif
                            </td>
                            <td>
                                <b>{{ $f->gift->product->name }}</b>
                            </td>                            
                            <td>
                                {{ $f->type }}
                            </td>   
                            <td>
                                {{ $f->amount }} €
                            </td>   
                            <td>
                                {{ MyHelper::datefr($f->created_at,0) }}
                            </td>                       
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
        @endif
	</div>
</section>

@stop