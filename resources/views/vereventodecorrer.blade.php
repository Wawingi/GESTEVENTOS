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
            <br>
            <div class="row">
                <div class="col-5">
                    <div id="piechart" style="width:500px;height:250px"></div>
                </div>
            </div>
            <br>                   
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <table class="table  table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">Convidado</th>
                                <th style="text-align: center">Acompanhante</th>
                                <th style="text-align: center">Mesa</th>
                                <th style="text-align: center">Hora de Chegada</th>
                                <th style="text-align: center">Estado</th>
                            </tr>
                        </thead>
                        <tbody> 
                        @foreach($convidados as $convidado)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td style="text-align: center">{{ $convidado->nome }}</td>
                                <td style="text-align: center">{{ $convidado->acompanhante }}</td>
                                <td style="text-align: center">{{ $convidado->assento }}</td>
                                <td style="text-align: center">{{ date('H:i:s',strtotime($convidado->updated_at)) }}</td>
                                <td style="text-align: center">
                                    @if($convidado->estado=='Ausente')  
                                        <div class="progress progress-md m-b-20">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                            {{ $convidado->estado }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="progress progress-md m-b-20">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                            {{ $convidado->estado }}
                                            </div>
                                        </div>
                                    @endif    
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<script src="https://www.gstatic.com/charts/loader.js" type="text/javascript"></script>    
<script>
  jQuery().ready(function(){
    $(".clickable-row").click(function(){
        window.location = $(this).data("href");
    });
  });
  
    google.charts.load('current',{'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart(){
        var data = google.visualization.arrayToDataTable([
            ['Convidado nome','Estado'],
            @php
                foreach($estados as $est){
                    echo "['".$est->estado."',".$est->quantidade."],";
                }
            @endphp
        ]);

        var options = {
            //title: 'Product Details',
            is3D: false,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data,options);           
    }
</script>
@stop