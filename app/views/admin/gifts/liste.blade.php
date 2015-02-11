@extends('layouts.admin')
@section('footer')
    <script type="text/javascript">
    $(function() {
        $('#example2').dataTable({
            "lengthMenu": [ 10, 25, 50, 75, 100 ],
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
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
                        Liste des réservations
                        <small>Réservations effectuées par nos proches</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
                        <li class="active">Réservations</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Toutes les réservations</h3>                                    
                                </div><!-- /.box-header -->
                                @include('admin.partials.messages')
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>                                   
                                                <th>Date</th>
                                                <th>Proche</th>
                                                <th>Type</th>
                                                <th>Article</th>
                                                <th>Ok</th>
                     
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Proche</th>
                                                <th>Type</th>
                                                <th>Article</th>
                                                <th>Ok</th>

                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($gifts AS $g)
                                            <tr>                                    
                                                <td>{{ \MyHelper::datefr($g->created_at) }}</td>
                                                <td>{{ $g->user->name }}<br>{{ $g->user->email }}</td>
                                                <td>
                                                @if($g->type == 1)
                                                    Offre
                                                @elseif($g->type == 2)
                                                    Financement
                                                @endif
                                                </td>
                                                <td>{{ $g->product->name }}</td>
                                                <td>
                                                    @if(count($g->financement) == 1)
                                                        Ok
                                                    @else
                                                        Attente
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