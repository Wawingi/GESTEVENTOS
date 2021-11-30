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
                            <li class="breadcrumb-item active">Ver Consumo</li>
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
                        @include('modalconsumo')
						<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconsumo">
							<i class='fa  fa-plus-square'></i> Inserir Produto
						</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">                     
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">Categoria</th>
                                <th style="text-align: center">Designação</th>
                                <th style="text-align: center">Quantidade</th>
                                <th style="text-align: center">Opções</th>
                            </tr>
                            </thead>
                           
                            <tbody id="consumoTable"> 
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>	
        </div>
    </div>
</div>
<script>
	function carregarDataTable(){
        var id_evento = $('#id_evento').val();
        $.ajax({
            url: "{{ url('pegaConsumos') }}/"+id_evento,
            success:function(data){
                $('#consumoTable').html(data);
            },
            error: function(e)
            {
                alert('Erro ao carregar dados');
            }
        })
    }
    carregarDataTable();
	
	$('#formularioConsumo').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
        $.ajax({
            url:"{{ url('inserirProduto') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
					$('#modalCloseConsumo').click();
                    Swal.fire({
                        text: "Registado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioConsumo')[0].reset(); 
                    carregarDataTable();
                }            
            },
            error: function(e){
				$('#modalCloseConsumo').click();
				$('#formularioGerarConvite')[0].reset(); 
                Swal.fire({
                    text: 'Ocorreu um erro ao registar.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $(document).on('click','.eliminar',function(e){
        Swal.fire({
            title: 'Deseja realmente eliminar o produto?',
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
                    $.ajax({
                        url: "{{ url('eliminarConsumo') }}/"+id,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
                            Swal.fire(
                            'Eliminado!',
                            'Eliminado com Sucesso.',
                            'success'
                            )
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao eliminar.',
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