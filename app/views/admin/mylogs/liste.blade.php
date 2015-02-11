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
                <section class="content-header" id="logsareread">
                    <h1>
                        Liste des logs
                        <small>Actions effectuées par nos proches</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
                        <li class="active">Logs</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Tous les logs</h3>                                    
                                </div><!-- /.box-header -->
                                @include('admin.partials.messages')
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Statut</th>
                                                <th>Date</th>
                                                <th>Qui?</th>
                                                <th>Action</th>
                                                <th>Commentaires</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Statut</th>
                                                <th>Date</th>
                                                <th>Qui?</th>
                                                <th>Action</th>
                                                <th>Commentaires</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($logs AS $l)
                                            <tr>
                                                <td>
                                                    @if($l->read == 1)
                                                        <span class="glyphicon glyphicon-envelope" style="color:#a9aeee"></span>
                                                    @else
                                                        <span class="glyphicon glyphicon-envelope" style="color:#0012ff"></span>
                                                    @endif
                                                </td>
                                                <td>{{ \MyHelper::datefr($l->created_at) }}</td>
                                                <td>
                                                    @if($l->user_id > 0)
                                                        {{ $l->user->name }}
                                                    @endif
                                                </td>
                                                <td>{{ $l->action }}</td>
                                                <td>{{ $l->comment }}</td>
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