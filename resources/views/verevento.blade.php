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
                        <h4 class="page-title">GESTEVENTO !!!</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Administração</li>
                            <li class="breadcrumb-item active"><a href="{{ url('listarEvento') }}">Listar Eventos</a></li>
                            <li class="breadcrumb-item active">Ver Evento</li>
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
            @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Alerta!</strong>
                    {{ session('warning')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <div class="row">
                            <div class="col-md-6">
								<input type="hidden" class="form-control" id="id_evento" name="id_evento" required value="{{$evento->id}}">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Entidade</label>
                                    <input  type="text" style="font-weight:bold" class="form-control" value="{{$evento->entidade}}" id="entidade" name="entidade" readonly="" value="<?php echo $evento->entidade ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Local</label>
                                    <input  type="text" style="font-weight:bold" class="form-control" readonly="" value="<?php echo $evento->local ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Tipo</label>
                                    <input  type="text" style="font-weight:bold" class="form-control" readonly="" value="<?php echo $evento->tipo ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Data</label>
                                    <input  type="text" style="font-weight:bold" class="form-control" readonly="" value="<?php echo date('d/m/Y',strtotime($evento->data)) ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Hora</label>
                                    <input  type="text" class="form-control" style="font-weight:bold" readonly="" value="<?php echo $evento->hora ?>">
                                </div>
                            </div>
                        </div>                                          
                        <hr>
                        <!-- Importação da Modal Assento -->
                        @include('modalassento')
                        @include('modaleditarassento')
						@include('modalrandomico')
						@if($evento->modalidade==1)
							<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalevento">
								<i class='fa  fa-plus-square'></i> Inserir Assento
							</button>
							<a href='{{ url("/eventoPDF/{$evento->id}") }}' class="btn btn-secondary">
								<i class='fa fa-file-pdf-o'></i> Ver PDF
							</a>
							<a href='{{ url("convitePDF") }}' class="btn btn-success">
								<i class='fa fa-file-pdf-o'></i> Digital Convite
							</a>
						@else
							<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalrandomico">
								<i class='fa  fa-plus-square'></i> Gerar Convite
							</button>
						@endif            
                    </div>
                </div>
            </div>
            
			@if($evento->modalidade==1)
				<!-- Listagem dos assentos caso exista ou caso seja gerenciavel -->
				<div class="row">
					<?php 
						 $assentos = App\Model\Assento::where('id_evento', '=', $evento->id)->paginate(15); 
						 foreach($assentos as $assento):
					?>
						<div class="col-3">
							<div style="width:250px" class="card">
								<div class="card-body">
									<h5 style="text-align:center;color:blue;font-weight:bold" class="card-title">{{ $assento->designacao }} == {{ $assento->capacidade }} LUG.</h5><hr>
								</div>
								<?php if($assento->tipo=='Cadeira'){ ?>
									<img class="card-img-top img-fluid" src="{{ url('images/cadeira.png') }}" alt="Card image cap"><hr>
								<?php }else{ ?>
									<img class="card-img-top img-fluid" src="{{ url('images/mesa.jpg') }}" alt="Card image cap"><hr>
								<?php } ?>
								<div style="text-align:center" class="card-body">
									<a href='{{ url("/verAssento/{$assento->id}/{$evento->id}/{$evento->entidade}") }}' class="btn-primary btn-sm">VER</a>
									<a href="#" id="{{ $assento->id }}" nome="{{ $assento->designacao }}" class="pegar btn-warning btn-sm">EDITAR</a>
									<a href='{{ url("/eliminarAssento/{$assento->id}/{$evento->id}") }}' class="btn-danger btn-sm">ELIMINAR</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>    
				</div>
			@else
				<div class="port m-b-20">
					<div id="convitesTable" class="portfolioContainer">
											   
					</div>
				</div>
			@endif
			<br>
        </div>
    </div>
</div>
<script>
	function carregarDataTable(){
        var id_evento = $('#id_evento').val();
		var entidade = $('#entidade').val();
        $.ajax({
            url: "{{ url('pegaConvitesGerados') }}/"+id_evento+"/"+entidade,
            success:function(data){
                $('#convitesTable').html(data);
            },
            error: function(e)
            {
                alert('Erro ao carregar dados');
            }
        })
    }
    carregarDataTable();
	
	$(window).on('load', function () {
		var $container = $('.portfolioContainer');
		$container.isotope({
			filter: '*',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
	
		$('.portfolioFilter a').click(function(){
			$('.portfolioFilter .current').removeClass('current');
			$(this).addClass('current');
	
			var selector = $(this).attr('data-filter');
			$container.isotope({
				filter: selector,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
			return false;
		});
	});
	
    $(document).on('click','.pegar',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var nome = $(this).attr('nome');

        $('.modalEditarAssento').modal('show');

        $('#id_assento').val(id);
        $('#designacao').val(nome);
    });
	
	$('#formularioGerarConvite').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
        $.ajax({
            url:"{{ url('gerarConvite') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
					$('#modalCloseRandomico').click();
                    Swal.fire({
                        text: "Gerados com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioGerarConvite')[0].reset(); 
                    carregarDataTable();
					location.reload();
                }            
            },
            error: function(e){
				$('#modalCloseRandomico').click();
				$('#formularioGerarConvite')[0].reset(); 
                Swal.fire({
                    text: 'Ocorreu um erro ao gerar.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });
</script>
@stop