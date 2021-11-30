@extends('home')
@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> GESTEVENTO !!!</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Administração</a></li>
                            <li class="breadcrumb-item active">Eventos a Decorrer</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
						<h4 style="text-align:center;color:green">EVENTOS A DECORRER </h4><hr>
                        <table id="table" class="table  table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align: center">Codigo Evento</th>
                                <th style="text-align: center">Tipo</th>
                                <th style="text-align: center">Entidade</th>
                                <th style="text-align: center">Local</th>
                                <th style="text-align: center">Data</th>
                                <th style="text-align: center">Hora Início</th>
                            </tr>
                        </thead>
                        <tbody> 
                        @foreach($eventos as $evento)
                            <tr class="clickable-row tabelaClicked" data-href='{{url("vereventodecorrer/{$evento->id}")}}'>
                                <td style="text-align: center">{{ $evento->id_evento }}</td>
                                <td style="text-align: center">{{ $evento->tipo }}</td>
                                <td style="text-align: center">{{ $evento->entidade }}</td>
                                <td style="text-align: center">{{ $evento->local }}</td>
                                <td style="text-align: center">{{ date('d/m/Y',strtotime($evento->data)) }}</td>
                                <td style="text-align: center">{{ $evento->hora }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<script>
  jQuery().ready(function(){
    $(".clickable-row").click(function(){
        window.location = $(this).data("href");
    });
  });
</script>
@stop