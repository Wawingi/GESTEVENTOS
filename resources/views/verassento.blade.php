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
                            <li class="breadcrumb-item">Administração</li>
                            <li class="breadcrumb-item active"><a href='{{ url("ver/{$assento->id_evento}") }}'>Ver Evento</a></li>
                            <li class="breadcrumb-item active">Ver Assento</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            @if(session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Alerta!</strong>
                    {{ session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <!-- Importação da Modal Assento -->
            @include('modalconvidado')
            @include('modalQRCode')
            <div class="row">
                    <div class="col-12">
                        <div style="height:265px" class="card-box widget-user">
                            <div>
                                <?php if($assento->tipo == 'Mesa'){ ?>
                                    <img style="width:150px;height:150px" src="{{ asset('images/mesa.jpg') }}" class="img-responsive rounded-circle" alt="user">
                                <?php } else { ?>
                                    <img style="width:150px;height:150px" src="{{ asset('images/cadeira.png') }}" class="img-responsive rounded-circle" alt="user">
                                <?php } ?>
                                <div class="row">
                                    <div style="margin-top:5px" class="col-5">
                                        <div class="wid-u-info">
                                            <h3 style="font-size:20px" class="mt-0 m-b-8">Designação</h3>
                                            <h4><p class="text-muted m-b-5 font-20">Tipo</p></h4>
                                            <h4><p><b>Capacidade</b></p></h4>
                                        </div>
                                    </div>
                                    <div style="margin-top:5px;margin-left:-200px" class="col-6">
                                        <div class="wid-u-info">
                                            <h3 style="font-size:20px" class="mt-0 m-b-8">: {{ $assento->designacao }}</h3>
                                            <h4><p class="text-muted m-b-5 font-20">: {{ $assento->tipo }}</p></h4>
                                            <h4><p><b>: {{ $assento->capacidade }}</b></p></h4>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top:-20px" class="row">
                                    <div style="margin-left:90px" class="col-sm-5 m-t-20">   
                                        <small class="text-success"><b>Ocupação do Assento</b></small>
                                        <?php if($assento->tipo=='Cadeira'){ ?>  
                                            <div class="progress progress-md m-b-20">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($cont_elementos_mesa*100)/$assento->capacidade ?>%"><?php if($cont_elementos_mesa>0){ echo 'LUGAR JÁ OCUPADO'; } ?></div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="progress progress-md m-b-20">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($cont_elementos_mesa*100)/$assento->capacidade ?>%"><?php echo ($cont_elementos_mesa*100)/$assento->capacidade ?>%</div>
                                                
                                            </div>                    
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr>
                                <?php if ($cont_elementos_mesa>=$assento->capacidade){ ?>
                                    <p style="color:red;text-align:center"><b>O ASSENTO JA SE ENCONTRA PREENCHIDO!</b></p>
                                <?php }else{ ?>
                                    
                                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconvidado">
                                        <i class='fa  fa-plus-square'></i> Inserir Convidado
                                    </button>
                                <?php } ?>
                                
                            </div>
                        </div>
                    </div>
            </div>
            
            <!-- Listar convidados -->
            <div class="row">
                <div class="col-12">
					@csrf
                    <div  class="card-box table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <h4 style="text-align:center"><b>CONVIDADOS: <?php echo $cont_elementos_mesa. ' DE ' .$assento->capacidade ?></b></h4>   
                          
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">Nome</th>
                                <th style="text-align: center">Genero</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Acompanhante(s)</th>
                                <th style="text-align: center">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $convidados = App\Model\Convidado::where('id_assento', '=', $assento->id)->get(); 
								$cont=1;
                                foreach($convidados as $convidado):
                            ?>
                                <tr>
                                    <td style="text-align: center">{{$cont++}}</td>
                                    <td style="text-align: center"><a href="#">{{ $convidado->nome }}</a></td>
                                    <td style="text-align: center">{{ $convidado->genero }}</td>
                                    <td style="text-align: center">{{ $convidado->estado }}</td>
                                    <td style="text-align: left;width:25%">
                                        <?php 
                                            $acompanhantes = App\Model\Acompanhante::where('id_convidado', '=', $convidado->id)->get(); 
                                            foreach($acompanhantes as $acompanhante):
                                        ?>
                                            <li>{{ $acompanhante->nome }}</li>
                                        <?php endforeach ?>                                                   
                                    </td>
                                    <td style="text-align: center">
                                        <a href='{{ url("verqrcode/{$convidado->nome}/{$convidado->id}/{$pasta}") }}' id="{{$convidado->id}}" nome="{{$convidado->nome}}" pasta="{{$pasta}}" title="Ver Código QR" class="pegarQRCode btn-primary btn-sm mr-2"><i class="fa fa-qrcode"></i></a>
										<a href='#' id="{{$convidado->id}}" nome="{{$convidado->nome}}" pasta="{{$pasta}}" title="Eliminar Convidado" class="eliminarConvidado btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
									</td>								
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
						<hr>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>	
	function troca(){			
		var cbox = document.getElementsByClassName('flat');
		var cont=0;
		var btnApagar = $('#btnAp');
		var mostra = $('#texto');
		
		for(var i=0;i<=cbox.length;i++){
			if(cbox[i].checked){
				btnApagar.prop("disabled",false);
				mostra.text(++cont);
			}	
		}
	}

    $(document).on('click','.pegarQRCode',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var nome = $(this).attr('nome');
        var pasta = $(this).attr('pasta');
        let nomefile = nome.replace(/ /g,"_");
        nomefile = nomefile+'_'+id;
        let source = "{{asset('images/qrcodes')}}/"+pasta+"/"+nomefile+".png";
        $('#modalQRCode').modal('show');
        $('#nome').html(nomefile);
        $('#imagemQR').attr('src', source); 
    });

    $(document).on('click','.eliminarConvidado',function(e){
        Swal.fire({
            title: 'Deseja realmente eliminar o convidado?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    var nome = $(this).attr('nome');
                    var pasta = $(this).attr('pasta');
                    $.ajax({
                        url: "{{ url('apagarConvidado') }}/"+nome+"/"+id+"/"+pasta,
                        type: "GET",
                        success: function(data){
                            if(data=='Sucesso'){
                                location.reload();
                                Swal.fire({
                                    text: 'Eliminado com Sucesso.',
                                    icon: 'success',
                                    confirmButtonText: 'Fechar'
                                })
                            }
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao eliminar o convidado.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
        });
    });
</script>
@stop