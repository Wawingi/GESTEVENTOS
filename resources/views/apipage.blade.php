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
                                        <li class="breadcrumb-item active">Gerar API</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <br><br>

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
									<h4 style="text-align:center">ESCOLHA EVENTO A GERAR </h4><br>
                                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="text-align: center">#</th>
                                            <th style="text-align: center">Entidade</th>  
                                            <th style="text-align: center">Data</th>                                           
                                            <th style="text-align: center">Opções</th>
                                        </tr>
                                        </thead>
                                    
                                        <tbody>
                                        @foreach($eventos as $evento)
                                            <tr>
                                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                                <td style="text-align: center">{{ $evento->entidade }}</td> 
                                                <td style="text-align: center">{{ date('d/m/Y',strtotime($evento->data)) }}</td>                                           
                                                <td style="text-align: center">
                                                    <a href='{{ url("/vereventoAPI/{$evento->id}") }}' class="btn btn-primary btn-sm"  data-original-title='Ver'><i class='fa fa-eye'></i></a> 
                                                </td>
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
@stop