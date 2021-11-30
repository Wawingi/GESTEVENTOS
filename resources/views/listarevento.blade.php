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
                            <li class="breadcrumb-item"><a href="#">Administração</a></li>
                            <li class="breadcrumb-item active">Listar Eventos</li>
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
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <!-- Importação da Modal Evento -->
                        @include('modalevento')
                        @include('modaleditarevento')
                        
                        <h4 class="m-t-0 header-title">
                            <a id="modalRegistar" href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalevento">
                                <i class='fa  fa-plus-square'></i> AD EVENTO
                            </a>
                            <button style="display:none" id="modalEditar" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modaleditevento">
                            </button>
                        </h4>
                        <hr>
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">#</th>
                                <th style="text-align: center">Tipo</th>
                                <th style="text-align: center">Entidade</th>
                                <th style="text-align: center">Local</th>
                                <th style="text-align: center">Data</th>
                                <th style="text-align: center">Hora</th>
                                <th style="text-align: center">Opções</th>
                            </tr>
                            </thead>
                           
                            <tbody id="eventoTable"> 
                            
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
    function carregarDataTable(){
        $.ajax({
            url: "{{ url('pegaEventos') }}",
            success:function(data){
                $('#eventoTable').html(data);
            },
            error: function(e)
            {
                alert(e);
            }
        })
    }
    carregarDataTable();
    $('#formularioSalvar').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
        $.ajax({
            url:"{{ url('registarEvento') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
					$('#modalClose').click();
                    Swal.fire({
                        text: "Evento registado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioSalvar')[0].reset(); 
                    carregarDataTable();
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao registar o departamento.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });
    $(document).on('click','.pegar',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            url: "{{ url('pegaEvento') }}/"+id,
            method: "GET",
            dataType: "JSON",
            success: function(data){                                     
                $('#modalEditar').click();
                $('#tipo').val(data.tipo);
                $('#entidade').val(data.entidade);
                $('#local').val(data.local);
                $('#data').val(data.data);
                $('#hora').val(data.hora);
                $('#id_evento').val(data.id);
            },
            error: function(e)
            {
                
            }
        });
    });
    $('#formularioEditar').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
        $.ajax({
            url:"{{ url('editarEvento') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    Swal.fire({
                        text: "Evento actualizado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#closeModalEdit').click();
                    carregarDataTable();
                }                
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao actualizar o departamento.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });
    $(document).on('click','.eliminar',function(e){
        Swal.fire({
            title: 'Deseja realmente eliminar o evento?',
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
                        url: "{{ url('eliminarEvento') }}/"+id,
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
                                text: 'Ocorreu um erro ao remover o evento.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
        });
    });
    
    /*$(document).on('click','.eliminar',function(e){        
        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            url: "{{ url('eliminarEvento') }}/"+id,
            type: "GET",
            success: function(data){
                carregarDataTable();
            },
            error: function(e)
            {}
        });
    });*/
</script>
@stop