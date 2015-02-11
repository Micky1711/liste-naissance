@extends('layouts.admin')
@section('footer')
    <script type="text/javascript">
    $(function() {
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
    </script>
@stop

@section('content')
          

               
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Notre liste
                        <small>Liste de naissance</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
                        <li class="active">Notre liste</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Les articles de notre liste</h3>                                    
                                </div><!-- /.box-header -->
                                @include('admin.partials.messages')
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>image</th>
                                                <th>Produit</th>
                                                <th>Description</th>
                                                <th>type</th>
                                                <th>Avancement</th>
                                                <th>Détails</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>image</th>
                                                <th>Produit</th>
                                                <th>Description</th>
                                                <th>type</th>
                                                <th>Avancement</th>
                                                <th>Détails</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($products AS $p)
                                            <tr>
                                                <td>
                                                @if($p->photo != "")
                                                    {{ HTML::image('assets/uploads/'.$p->photo, 'alt', array( 'width' => 70, 'height' => 70 )) }}</td>
                                                @endif
                                                <td>
                                                    @if($p->display == 1)
                                                    <span class="btn btn-xs btn-success">En ligne</span>
                                                    @else
                                                    <span class="btn btn-xs btn-danger">Caché</span>
                                                    @endif
                                                    <b>{{ $p->name }}</b>
                                                </td>
                                                <td>{{ $p->description }}</td>
                                                    <td>
                                                    @if($p->type == 1)
                                                        <div class="btn btn-success btn-xs">Achat</div>
                                                    @elseif($p->type == 2)   
                                                        <div class="btn btn-primary btn-xs">Financement</div>
                                                     @elseif($p->type == 3)  
                                                        <div class="btn btn-info btn-xs">Mixte</div>
                                                    @endif  
                                                </td>
                                                <td>                                                    
                                                    <div>
                                                         @if($p->statut < 50)
                                                            <div class="btn btn-danger" style="padding-left:0;padding-right:0;min-width:5%;width:{{ $p->statut }}%">
                                                        @elseif($p->statut < 100)   
                                                            <div class="btn btn-warning" style="padding-left:0;padding-right:0;min-width:5%;width:{{ $p->statut }}%">
                                                        @else
                                                            <div class="btn btn-success" style="padding-left:0;padding-right:0;min-width:5%;width:{{ $p->statut }}%">
                                                        @endif            
                                                        </div>
                                                      </div>    
                                                        <div style="display:inline-block;color:#000000;float:right;font-size:10px">{{ $p->statut }}%</div> 
                                                </td>

                                                <td>
                                                    @foreach($p->gifts AS $g)
                                                    {{ $g->user->name }}<br>
                                                    @if($p->type == 1)
                                                    <div class="btn btn-success" style="padding-left:0;padding-right:0;min-width:5%;width:{{ ($g->parts/$p->parts)*100 }}%"></div>
                                                    @elseif($p->type == 2)
                                                    <div class="btn btn-primary" style="padding-left:0;padding-right:0;min-width:5%;width:{{ ($g->parts/$p->parts)*100 }}%"></div>
                                                    @endif  
                                                     <div style="display:inline-block;color:#000000;float:right;font-size:10px">{{ round(($g->parts/$p->parts)*100,0) }}%</div>
                                                     
                                                        
                                                    @endforeach

                                                </td>
                                                <td>
                                                    <a href="{{ URL::Route('admin.products.edit', ['id' => $p->id])}}" class="btn btn-warning btn-xs">Editer</a> 
                                                    <a href="{{ URL::Route('admin.products.info', ['id' => $p->id])}}" class="btn btn-info btn-xs">Infos</a>
                                                    @if($p->statut > 0)
                                                        <a href="#" class="btn btn-xs">Supprimer</a>                                                        
                                                    @else
                                                        <a href="{{ URL::Route('admin.products.delete', ['id' => $p->id])}}" class="btn btn-danger btn-xs">Supprimer</a>                                                        
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                        </div>
                    </div>

                </section><!-- /.content -->
          

@stop