@extends('layouts.admin')

@section('content')
          

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Fiche de {{ $user->name }}
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Utlisateurs</a></li>
                        <li class="active">
                            Fiche {{ $user->name }}
                        </li>
                    </ol>
                </section>
            {{ Form::open(array('route' => 'admin.users.fiche.post')) }}
                {{ Form::hidden('user_id',$user->id) }}
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        Profil
                                    </h3>
                                </div>
                                @include('admin.partials.messages')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-9 ">
                                        <div class="box-body">
                                            <!-- Date dd/mm/yyyy -->
                                            <div class="form-group">
                                                {{ Form::label('name', 'Nom', array('class' => 'control_label')) }}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    {{ Form::text('name', $user->name , array('class' => 'form-control', 'placeholder' => 'Nom / Identité')) }}
                                                </div><!-- /.input group -->
                                                @if(isset(Session::get('errors_form')['name'][0]))
                                                    <div class="alert alert-danger">{{ Session::get('errors_form')['name'][0]}}</div>
                                                @endif
                                            </div><!-- /.form group -->
                                            <div class="form-group">
                                                {{ Form::label('email', 'Email', array('class' => 'control_label')) }}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    {{ Form::text('email', $user->email , array('class' => 'form-control', 'placeholder' => 'Adresse email')) }}
                                                </div><!-- /.input group -->
                                                @if(isset(Session::get('errors_form')['email'][0]))
                                                    <div class="alert alert-danger">{{ Session::get('errors_form')['email'][0]}}</div>
                                                @endif
                                            </div><!-- /.form group -->
                                            <div class="form-group">
                                                {{ Form::label('password', 'Password', array('class' => 'control_label')) }}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    {{ Form::password('password', array('class' => 'form-control')) }}
                                                </div><!-- /.input group -->
                                                @if(isset(Session::get('errors_form')['password'][0]))
                                                    <div class="alert alert-danger">{{ Session::get('errors_form')['password'][0]}}</div>
                                                @endif
                                            </div><!-- /.form group -->
                                            <div class="form-group">
                                                {{ Form::label('password_confirmation', 'Confirmer le mot de passe', array('class' => 'control_label')) }}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                                                </div><!-- /.input group -->
                                                @if(isset(Session::get('errors_form')['password_confirmation'][0]))
                                                    <div class="alert alert-danger">{{ Session::get('errors_form')['password_confirmation'][0]}}</div>
                                                @endif
                                            </div><!-- /.form group -->
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 ">
                                        <div class="form-group">
                                            <div class="input-group">   
                                                <button class="btn btn-success">
                                                    Modifier
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('role_id', 'Roles', ['class' => 'control_label']) }}
                                            <div class="input-group">   
                                                @foreach($roles AS $r)
                                                <div>
                                                    {{ Form::checkbox('role_id[]',$r->id, (in_array($r->id,$userroles) ) ? true : false) }}
                                                    {{ $r->name }}
                                                </div>
                                                @endforeach
                                                                                     
                                            </div><!-- /.input group -->
                                        </div><!-- /.form group -->   
              
                                    </div>
                                </div>

                            </div><!-- /.box -->



                        </div><!-- /.col (left) -->

                    </div><!-- /.row -->                    



                </section><!-- /.content -->
 
            {{ Form::close() }}


                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        Réservations
                                    </h3>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 ">
                                        <div class="box-body table-responsive">
                                            <table id="tab_gifts" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>                                   
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Article</th>
                                                        <th>Ok</th>
                             
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Type</th>
                                                        <th>Article</th>
                                                        <th>Ok</th>                                        
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    @foreach($user->gifts AS $g)
                                                    <tr>                                    
                                                        <td>{{ \MyHelper::datefr($g->created_at) }}</td>
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
                                    </div>
                                </div>
                            </div><!-- /.box -->
                        </div><!-- /.col (left) -->
                    </div><!-- /.row -->                 
                </section><!-- /.content -->

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        Financements / achats
                                    </h3>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 ">
                                <div class="box-body table-responsive">
                                    <table id="tab_financemeents" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>                                   
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Article</th>
                                                <th>Infos</th>
                     
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Article</th>
                                                <th>Infos</th>                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($user->financements AS $f)
                                                <tr>
                                                    <td>{{ \MyHelper::datefr($f->created_at ) }}</td>
                                                    <td>{{ $f->gift->product->name }}</td>
                                                    <td>@if($f->type_id == 1)
                                                            Offert
                                                        @elseif($f->type_id == 2)
                                                            Financé ({{ $f->type }})
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($f->type_id == 2)
                                                            {{ $g->payment_amount }}<br>
                                                            {{ $g->txn_id }}
                                                        @else
                                                            &nbsp;
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                    </div>
                                </div>
                            </div><!-- /.box -->
                        </div><!-- /.col (left) -->
                    </div><!-- /.row -->                 
                </section><!-- /.content -->

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">
                                        Logs
                                    </h3>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 ">
                                        <div class="box-body table-responsive">
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                        <th>Commentaires</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                        <th>Commentaires</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    @foreach($user->mylogs AS $l)
                                                    <tr>
                                                        <td>{{ \MyHelper::datefr($l->created_at) }}</td>
                                                        <td>{{ $l->action }}</td>
                                                        <td>{{ $l->comment }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>
                            </div><!-- /.box -->
                        </div><!-- /.col (left) -->
                    </div><!-- /.row -->                 
                </section><!-- /.content -->
@stop


@section('header')

@stop

@section('footer')
    <script type="text/javascript">
    $(function() {
        $('#tab_gifts').dataTable({
            "lengthMenu": [ 10, 25, 50, 75, 100 ],
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
        $('#tab_financements').dataTable({
            "lengthMenu": [ 10, 25, 50, 75, 100 ],
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
        $('#tab_logs').dataTable({
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