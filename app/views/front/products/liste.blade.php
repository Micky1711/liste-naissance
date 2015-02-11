@extends('layouts.front')

@section('content')
<section>
    {{ Form::open(array('route' => array('reservation'), 'class' => 'form-signin', 'role' => 'form', 'onsubmit' => 'return confirm("Etes vous sur ?")' )) }}
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2>La liste de naissance</h2>
				 @include('front.partials.messages')
			</div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                Filtres : {{ Form::button('Afficher les réservés', 
                                        array(
                                            'type' => 'button', 
                                            'class' => 'btn btn-xs btn-success filter',
                                            'data-target' => '.statut_100', 
                                            'data-statut' => '0',
                                            'data-text' => 'Afficher les réservés'
                                        )) 
                            }}
                            {{ Form::button('Afficher les achats', 
                                        array(
                                            'type' => 'button', 
                                            'class' => 'btn btn-xs btn-success filter',
                                            'data-target' => '.type_1', 
                                            'data-statut' => '0',
                                            'data-text' => 'Afficher les achats'
                                        )) 
                            }}
                            {{ Form::button('Afficher les financements', 
                                        array(
                                            'type' => 'button', 
                                            'class' => 'btn btn-xs btn-success filter',
                                            'data-target' => '.type_2', 
                                            'data-statut' => '0',
                                            'data-text' => 'Afficher les financements'
                                        )) 
                            }}
                            {{ Form::button('Afficher les offres mixtes', 
                                        array(
                                            'type' => 'button', 
                                            'class' => 'btn btn-xs btn-success filter',
                                            'data-target' => '.type_2', 
                                            'data-statut' => '0',
                                            'data-text' => 'Afficher les offres mixtes' 
                                        )) 
                            }}
            </div>
        </div>
        <br>
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
                                <th>Sélection</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>image</th>
                                <th>Produit</th>
                                <th>Description</th>
                                <th>type</th>
                                <th>Hauteur du financement</th>
                                <th>Sélection</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach($products AS $p)
                        @if($p->statut == 100)
                            <tr id="tr_{{ $p->id }}" class="alert alert-danger ligne type_{{ $p->type }} statut_{{ $p->statut }}">
                        @else
                            @if($p->type == 1)
                                <tr id="tr_{{ $p->id }}" class="alert alert-success ligne type_{{ $p->type }} statut_{{ $p->statut }}">
                            @elseif($p->type == 2)
                                <tr id="tr_{{ $p->id }}" class="alert alert-warning ligne type_{{ $p->type }} statut_{{ $p->statut }}">
                            @else
                                @if($p->statut != '0')
                                <tr id="tr_{{ $p->id }}" class="alert alert-warning ligne type_{{ $p->type }} statut_{{ $p->statut }}">
                                @else
                                <tr id="tr_{{ $p->id }}" class="alert alert-primary ligne type_{{ $p->type }} statut_{{ $p->statut }}">
                                @endif
                            @endif  
                        @endif  
                            <td>
                            @if($p->photo != "")
                                {{ HTML::image('assets/uploads/'.$p->photo, 'alt', array( 'width' => 70, 'height' => 70 )) }}</td>
                            @endif
                            <td>
                                <b>{{ $p->name }}</b>
                            </td>
                            <td>{{ $p->description }}</td>
                                <td>
                                @if($p->statut == '100')
                                    <div class="btn btn-danger btn-xs">Réservé</div>
                                @else
                                    @if($p->type == 1)
                                        <div class="btn btn-success btn-xs">Achat</div>
                                    @elseif($p->type == 2)   
                                        <div class="btn btn-warning btn-xs">Financement</div>
                                    @else
                                        @if($p->statut != '0')
                                        <div class="btn btn-warning btn-xs">Financement</div>
                                        @else
                                        <div class="btn btn-info btn-xs">Achat ou financement</div>
                                        @endif
                                    @endif  
                                @endif  
                            </td>
                           	<td>
								@if($p->type == '1')
                                    &nbsp;
                                @else
                                    {{ $p->parts }} parts à {{ $p->partprice }} €<br>
                                    <span style="font-style:italic">{{ round($p->parts*(1-$p->statut/100)) }} restante(s)</span>
                                @endif
                           	</td>
                           	<td>    
                            @if(Auth::check())
                                @if($p->statut == 100)
                                    &nbsp;
                                @else
    	                            @if($p->type == '1' || ($p->type == '3' && $p->statut == '0'))
                                    <div id="input_{{ $p->id }}">
                                         <a class="btn btn-danger joffreoupas" data-id="achat_{{ $p->id }}" data-select="select_{{ $p->id }}" data-checked="0"><span class="glyphicon glyphicon-unchecked"></span> J'offre</a>
                                        {{ Form::hidden("achat[$p->id]",0, ['class' => "offreinput",'id' => "achat_$p->id"] ); }}
                                    </div>
                                    @endif
                                    @if($p->type == '2' || ($p->type == '3'))
                                        <div id="select_{{ $p->id }}">
                                            Je Finance 
                                            {{ Form::selectRange("financement[$p->id]", 0, round($p->parts*(1-$p->statut/100)),'', ['class' => 'form-control btn-danger jefinanceoupas', 'data-input' => "input_$p->id", "data-value" => "$p->partprice" ]) }}                               
                                        </div>
                                    @endif
                                @endif
                            @else
                                {{ HTML::linkroute('login','Identifiez-vous', '',['class' => 'btn btn-warning']) }}
                            @endif
                           	</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
			</div>
		</div>
        @if(Auth::check())
        <div class="row">
            <div class="col-xs-12 text-center"> 
            {{ Form::button('Je réserve', array('type' => 'submit', 'class' => 'btn btn-lg btn-info btn-block','id' => 'btn-reservation')) }}
            </div>
        </div>
        @endif
	</div>
    {{ Form::close() }}
</section>
@stop