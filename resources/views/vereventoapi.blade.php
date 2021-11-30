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
                <br>
				@if(session('info'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Alerta!</strong>
							{{ session('info')}}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
                @endif
                <div class="row">
                    <div class="col-sm-12">       
                        <form method="post" action="{{ url('registarAPI')}}" >
                            @csrf
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Alerta!</strong> {{$error}}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endforeach
                            @endif									
                            <div class="row">
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="field-3" class="control-label">Entidade</label>
                                                <input style="background:white;font-weight:bold" readonly value="{{ $evento->entidade }}"  type="text" class="form-control" name="entidade">
                                                <input  style="background:white;font-weight:bold" readonly value="{{ $evento->id }}"  type="hidden" class="form-control" name="id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="field-3" class="control-label">Data</label>
                                                <input style="background:white;font-weight:bold" disabled value="{{ date('d/m/Y',strtotime($evento->data)) }}"  type="text" class="form-control" name="entidade">
                                            </div>
                                        </div>
										<div class="col-md-5">
                                            <div class="form-group">
                                                <label for="field-3" class="control-label">ID</label>
                                                <input style="background:white;font-weight:bold" disabled value="{{ $evento->id }}"  type="text" class="form-control" name="entidade">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- pEGAR O NOME ID DO EVENTO E JUNTAR EM UMA STRING PARA PEGAR Qr CODE -->
                                <?php
                                    if($evento->modalidade==1){        
                                        $contConvidadosAPI = count(DB::select('select * from convidadoapi where id_evento = ?',[$evento->id])); 
                                    }else if($evento->modalidade==2){
                                        $contConvidadosAPI = DB::table('convidadoapi')->where('id_evento',$evento->id)->count('nome');
                                    }
                                    $novonome = Str_replace(' ','_',$evento->entidade);
                                    $novonome = $novonome.'_'.$evento->id.'.png';
							    ?>
                                <div style="margin-top:20px;margin-left:-90px" class="col-2">
                                    <img class="card-img-top img-fluid" src='{{ url("images/qrcodes/EventosQR/{$novonome}") }}'>                                         
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <hr>
                                </div>
                            </div>
                            <?php
								if($contConvidados != $contConvidadosAPI || $contConvidados <= 0){
							?>
                                <input type="hidden" name="modalidade" value="{{$evento->modalidade}}">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-file-export"> Exportar Dados</i></button>
							<?php } ?>
                            <?php if(date('d/m/Y',strtotime($evento->data))!=date('d/m/Y',strtotime('today')) && $contConvidadosAPI>0){ ?>
                                <a href='{{ url("apagarEventoAPI/{$evento->id}") }}' class="btn btn-danger"><i class="fa fa-trash"> Eliminar Dados</i></a>
                            <?php } ?>
                            <br><br><br><br>
                        </form>                              
                    </div>                               
                </div>
                <div class="row">
                    <div class="col-11">
                        <div class="card-box table-responsive">
                            <hr>
                            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Convidado</th>                                           
                                    <th style="text-align: center">Assento</th>
                                    <th style="text-align: center">Acompanhante</th>
                                </tr>
                                </thead>                                   
                                <tbody>
                                <?php
                                    $cont=0; 
                                    $convidados = DB::select('select * from convidadoapi where id_evento = ?',[$evento->id]); 
                                    foreach($convidados as $convidado):
                                ?>
                                    <tr>
                                        <td style="text-align: center">{{ ++$cont }}</td>
                                        <td style="text-align: center">{{ $convidado->nome }}</td>                                           
                                        <td style="text-align: center">{{ $convidado->assento }}</td>
                                        <td style="text-align: center">{{ $convidado->acompanhante }}</td>
                                    </tr>
                                <?php endforeach ?>                                 
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