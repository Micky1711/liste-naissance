@extends('layouts.admin')

@section('content')
          

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Détails du produit "{{ $product->name }}"
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Produits</a></li>
            <li class="active">
                Détails
            </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">
                            {{ $product->name }}
                        </h3>
                    </div>
                    @include('admin.partials.messages')
                    <div class="row">
                        <div class="col-xs-12 col-sm-9">
                            <div class="box-body">
                                <h4>Description</h4>
                                <div>{{ $product->description }}</div>         
                            </div><!-- /.box-body -->
                            <div class="box-body">
                                <h4>Utilisation</h4>
                                <div>{{ $product->use }}</div>              
                            </div><!-- /.box-body -->
                        </div>
                        <div class="col-xs-12 col-sm-3 ">
                        @if($product->photo != "")
                            <div class="box-body">
                                {{ HTML::image('assets/uploads/'.$product->photo, $product->name, ['class' => 'img-responsive'] ) }}
                            </div>
                        @endif
                            <div class="box-body">
                                <h4>Option</h4>
                                <div>
                                    @if($product->type == 1)
                                        Achat
                                    @elseif($product->type == 2)
                                        Financement
                                    @else
                                        Au choix
                                    @endif
                                </div>         
                            </div><!-- /.box-body -->    
                            @if($product->type != 1)
                            <div class="box-body">
                                <h4>Financement</h4>
                                <div>
                                    parts : {{ $product->parts }}<br>
                                    à {{$product->partprice }} € l'une
                                </div>         
                            </div><!-- /.box-body -->  
                            @endif  
                            <div class="box-body">
                                <h4>Avancement</h4>
                                <div>
                                @if($product->statut < 50)
                                    <div class="btn btn-danger" style="padding-left:0;padding-right:0;min-width:5%;width:{{ $product->statut }}%">
                                @elseif($product->statut < 100)   
                                    <div class="btn btn-warning" style="padding-left:0;padding-right:0;min-width:5%;width:{{ $product->statut }}%">
                                @else
                                    <div class="btn btn-success" style="padding-left:0;padding-right:0;min-width:5%;width:{{ $product->statut }}%">
                                @endif            
                                </div>
                              </div>    
                                <div style="display:inline-block;color:#000000;float:right;font-size:10px">{{ $product->statut }}%</div> 
                                </div>         
                            </div><!-- /.box-body -->  

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 ">
                            <div class="box-body">
                                <h4>Avancement</h4>
                                <div>Qui a offert quoi pour cet article ?</div>         
                            </div><!-- /.box-body -->
                            <div class="box-body">
                                @foreach($product->gifts AS $g)
                                    <b>{{ $g->user->name }}</b><br>
                                    <div class="row">
                                        <div class="col-xs-8">
                                        @if($product->type == 1)
                                            <div class="btn btn-success" style="padding-left:0;padding-right:0;min-width:5%;width:{{ ($g->parts/$product->parts)*100 }}%"></div>
                                        @elseif($product->type == 2)
                                            <div class="btn btn-primary" style="padding-left:0;padding-right:0;min-width:5%;width:{{ ($g->parts/$product->parts)*100 }}%"></div>
                                        @endif  
                                            <div style="display:inline-block;color:#000000;float:right;font-size:10px">{{ round(($g->parts/$product->parts)*100,0) }}%</div>
                                        </div>
                                        <div class="col-xs-4">
                                        @if($product->type == 2)
                                            Valeur : {{ ($g->parts*$product->partprice) }}€
                                        @endif
                                        </div>
                                    </div>                                               
                                    <hr>
                                @endforeach
                            </div><!-- /.box-body -->
                        </div>                                   
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col (left) -->
        </div><!-- /.row -->                    
    </section><!-- /.content -->
@stop