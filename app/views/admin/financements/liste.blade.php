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
                        Liste des Offres / Achats
                        <small>Offres / Achats effectuées par nos proches</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
                        <li class="active">Offres / Achats</li>
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
                                                <th>Date</th>
                                                <th>Proche</th>
                                                <th>Type</th>
                                                <th>Article</th>
                                                <th>Infos</th>
                     
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Proche</th>
                                                <th>Type</th>
                                                <th>Article</th>
                                                <th>Infos</th>                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($financements AS $f)
                                                <tr>
                                                    <td>{{ \MyHelper::datefr($f->created_at ) }}</td>
                                                    <td>{{ $f->user->name }}<br>{{ $f->user->email }}</td>
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
                            </div><!-- /.box -->                            
                        </div>
                    </div>

                </section><!-- /.content -->
          

@stop