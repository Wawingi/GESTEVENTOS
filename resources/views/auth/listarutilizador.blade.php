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
                            <li class="breadcrumb-item"><a href="#">Utilizadores</a></li>
                            <li class="breadcrumb-item active">Listar Utilizadores</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <br>
            <!-- mensagens de validação de erros -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Alerta!</strong>
                    {{ session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Alerta!</strong>
                    {{ session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <!-- Importação da Modal Evento -->
                        @include('auth.modalutilizador')
                        @include('auth.modalutilizadoreditar')
                        
                        <h4 class="m-t-0 header-title">
                            <button id="modalRegistar" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalevento">
                                <i class='fa  fa-plus-square'></i> ADICIONAR UTILIZADOR
                            </button>
                            <button style="display:none" id="modalEditar" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modaleditevento">
                            </button>
                        </h4>
                        <hr>
                        <table id="table" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center">#</th>
                                    <th style="text-align: center">Nome</th>
                                    <th style="text-align: center">Email</th>
                                    <th style="text-align: center">Tipo</th>
                                    <th style="text-align: center">Opções</th>
                                </tr>
                            </thead>                      
                            <tbody>
                            @foreach($utilizadores as $utilizador)
                                <tr>
                                    <td style="text-align: center"><i class='fa fa-user'></i></td>
                                    <td style="text-align: center">{{ $utilizador->name }}</td>
                                    <td style="text-align: center">{{ $utilizador->email }}</td>
                                    <td style="text-align: center">
                                        @if($utilizador->tipo==1)
                                            Administrador
                                        @else
                                            Protocolo
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <a href="#" id="{{$utilizador->id}}" nome="{{$utilizador->name}}" email="{{$utilizador->email}}" tipo="{{$utilizador->tipo}}" class="pegar btn btn-warning btn-sm" title='editar'><i class='fa fa-pencil-alt'></i></a>
                                        <a href="#" id="{{$utilizador->id}}" class="eliminar btn btn-danger btn-sm" title='eliminar'><i class='fa fa-trash-alt'></i></a>
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
<script>
    $(document).on('click','.pegar',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var nome = $(this).attr('nome');
        var email = $(this).attr('email');
        var tipo = $(this).attr('tipo');

        $('.editarModal').modal('show');

        $('#id').val(id);
        $('#nome').val(nome);
        $('#email').val(email);
        $('#tipo').val(tipo);
    });
    
    $(document).on('click','.eliminar',function(e){
        Swal.fire({
            title: 'Deseja realmente eliminar o utilizador?',
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
                        url: "{{ url('eliminarUtilizador') }}/"+id,
                        type: "GET",
                        success: function(data){
                            Swal.fire(
                            'Eliminado!',
                            'Eliminado com Sucesso.',
                            'success'
                            ),
                            location.reload();

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