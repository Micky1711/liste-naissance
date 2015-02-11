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
                                    <h3 class="box-title">Toutes les offres</h3>                                    
                                </div><!-- /.box-header -->
                                @include('admin.partials.messages')
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>                                   
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Inscrit le</th>
                                                <th>Roles</th>
                                                <th>honorées / Reservations</th>
                                                <th>Actions</th> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Inscrit le</th>
                                                <th>Roles</th>
                                                
                                                <th>Actions</th>                             
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($users AS $u)
                                                <tr>
                                                    <td>{{ $u->name }}</td>
                                                    <td>{{ $u->email }}</td>
                                                    <td>{{ \MyHelper::datefr($u->created_at) }}</td>
                                                    <td>
                                                        @foreach($u->roles AS $r)
                                                            {{ $r->name }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{ count($u->financements) }} / {{ count($u->gifts) }} 

                                                    </td>
                                                    <td>
                                                       Supprimer<br>
                                                       <a href="{{ URL::route('admin.users.fiche',['id' => $u->id]) }}">Fiche</a>
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