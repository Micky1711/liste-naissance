@extends('layouts.admin')

@section('content')
          

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        @if($form=="add")
                            Ajouter un produit
                        @else
                            Modication du produit "{{ $product->name }}"
                        @endif
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Produits</a></li>
                        <li class="active">
                            @if($form=="add")
                                Ajouter
                            @else
                                Modication
                            @endif
                        </li>
                    </ol>
                </section>
            {{ Form::open() }}
                @if($form=="edit")
                    {{ Form::hidden('id',$product->id) }}
                @endif
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        @if($form=="add")
                                            Nouveau produit
                                        @else
                                            {{ $product->name }}
                                        @endif
                                    </h3>
                                </div>
                                @include('admin.partials.messages')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-9 ">
                                        <div class="box-body">
                                            <!-- Date dd/mm/yyyy -->
                                            <div class="form-group">
                                                {{ Form::label('name', 'Nom du produit', array('class' => 'control_label')) }}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    {{ Form::text('name', $product->name , array('class' => 'form-control', 'placeholder' => 'mon produit')) }}
                                                </div><!-- /.input group -->
                                                @if(isset(Session::get('errors_form')['name'][0]))
                                                    <div class="alert alert-danger">{{ Session::get('errors_form')['name'][0]}}</div>
                                                @endif
                                            </div><!-- /.form group -->
                                            <div class="form-group">                                               
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    {{ Form::textarea('description', $product->description, array('class' => 'form-control', 'placeholder' => 'Courte description du produit')) }}
                                                </div><!-- /.input group -->
                                            </div><!-- /.form group -->
                                            <div class="form-group">
                                                {{ Form::label('use', 'Usage du produit', array('class' => 'control_label')) }}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    {{ Form::textarea('use', $product->use, array('class' => 'form-control', 'placeholder' => 'A quoi ou comment ce produit servira t\'il ?')) }}
                                                </div><!-- /.input group -->
                                            </div><!-- /.form group -->                   
                                        </div><!-- /.box-body -->
                                    </div>
                                    <div class="col-xs-12 col-sm-3 ">
                                        <div class="form-group">
                                            <div class="input-group">   
                                                <button class="btn btn-success">
                                                    @if($form=="add")
                                                        Ajouter
                                                    @else
                                                        Modifier
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('display', 'Publier', ['class' => 'control_label']) }}
                                            <div class="input-group">   
                                                <label>
                                                <div aria-disabled="false" aria-checked="false" style="position: relative;" class="iradio_flat-red">
                                                    {{ Form::radio('display',1,$product->display==1 ? true : false,["style"=>"position: absolute; opacity: 0", "class" => "flat-red" ]) }}
                                                    <ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;" class="iCheck-helper"></ins> 
                                                    Oui
                                                </div>
                                                </label><br>   
                                                 <label> 
                                                <div aria-disabled="false" aria-checked="false" style="position: relative;" class="iradio_flat-red">
                                                    {{ Form::radio('display',0,$product->display==0 ? true : false,["style"=>"position: absolute; opacity: 0", "class" => "flat-red" ]) }}
                                                    <ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;" class="iCheck-helper"></ins> 
                                                    Non
                                                </div>
                                                </label>                                      
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->   
                                        <div class="form-group">
                                            {{ Form::label('type', 'Option', ['class' => 'control_label']) }}
                                            <div class="input-group">   
                                                <label>
                                                <div aria-disabled="false" aria-checked="false" style="position: relative;" class="iradio_flat-red">
                                                    {{ Form::radio('type',1,$product->type<2 ? true : false,["style"=>"position: absolute; opacity: 0", "class" => "flat-red" ]) }}
                                                    <ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;" class="iCheck-helper"></ins> 
                                                    Achat
                                                </div>
                                                </label><br>   
                                                 <label> 
                                                <div aria-disabled="false" aria-checked="false" style="position: relative;" class="iradio_flat-red">
                                                    {{ Form::radio('type',2,$product->type==2 ? true : false,["style"=>"position: absolute; opacity: 0", "class" => "flat-red" ]) }}
                                                    <ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;" class="iCheck-helper"></ins> 
                                                    Financement
                                                </div>
                                                </label><br>  
                                                 <label> 
                                                <div aria-disabled="false" aria-checked="false" style="position: relative;" class="iradio_flat-red">
                                                    {{ Form::radio('type',3,$product->type==3 ? true : false,["style"=>"position: absolute; opacity: 0", "class" => "flat-red" ]) }}
                                                    <ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;" class="iCheck-helper"></ins> 
                                                    Au choix
                                                </div>
                                                </label>   
                                      
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->   
                                        <div class="form-group">
                                            {{ Form::label('force', 'Priorité de l\'article (100 est le plus fort)', array('class' => 'control_label')) }}
                                            <div class="input-group">
                                                {{ Form::selectRange('force', 1, 100, $product->force, ["class" => "form-control"]) }}                       
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->    

                                        <div class="form-group">
                                            {{ Form::label('parts', 'Nombre de parts de financement', array('class' => 'control_label')) }}
                                            <div class="input-group">
                                                {{ Form::selectRange('parts', 1, 20, $product->parts, ["class" => "form-control"]) }}                       
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->       
                                        <div class="form-group">
                                            {{ Form::label('partprice', 'Prix de la part', array('class' => 'control_label')) }}
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-laptop"></i>
                                                </div>
                                                {{ Form::text('partprice', $product->partprice > 0 ? $product->partprice : 10, array('class' => 'form-control')) }}
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->   

                                        <div class="box box-danger">
                                            <div class="box-header">
                                                <h3 class="box-title">Photos du produit</h3>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 ">  
                                                    <div class="panel panel-primary">
                                                        <div class="panel-heading">
                                                            <i class="fa fa-bar-chart-o fa-fw"></i> Image
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <label for="spinned" class="col-sm-12">Image</label>
                                                                <div class="col-sm-12">
                                                                    <div id="imagegraph"></div>
                                                                    {{ Form::hidden('photo',$product->photo, ['id' => 'photo']) }}                       
                                                                    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
                                                                        Selectionner une image
                                                                    </button>
                                                                </div>
                                                            </div>                                              
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box -->

              
                                    </div>
                                </div>

                            </div><!-- /.box -->



                        </div><!-- /.col (left) -->

                    </div><!-- /.row -->                    



                </section><!-- /.content -->


                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <div id="elfinder"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>   
            {{ Form::close() }}
@stop


@section('header')
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="/packages/barryvdh/laravel-elfinder/css/elfinder.min.css">
    <link rel="stylesheet" type="text/css" href="/packages/barryvdh/laravel-elfinder/css/theme.css">
@stop

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

 <script src="/packages/barryvdh/laravel-elfinder/js/elfinder.full.js"></script>
<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript" charset="utf-8">
    // Documentation for client options:
    // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
    $().ready(function() {

        if($("#photo").val() != "")
        {
            $("#imagegraph").html('<img src="/assets/uploads/'+$("#photo").val()+'" class="img-responsive" alt="image" />');
        }


         var directoryname = '';
        $('#elfinder').elfinder({
            // set your elFinder options here
            url : '<?= URL::action('Barryvdh\Elfinder\ElfinderController@showConnector') ?>',  // connector URL
                getFileCallback : function(url) {
                var urlpath = (url.path).replace(/\\/g,"\/" );
                $("#photo").val(urlpath);
                $("#imagegraph").html('<img src="/assets/uploads/'+urlpath+'" class="img-responsive" alt="image" />');
            },
        });
    });
</script>
@stop