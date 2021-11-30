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
                                        <li class="breadcrumb-item active">Actualizar Evento</li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="">
                                    <form method="post" action="{{ url('/actualizar',array($evento->id)) }}" >
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Tipo</label>
                                                    <select name="tipo" class="custom-select mt-3">
                                                        <option>Casamento</option>
                                                        <option>Aniversario</option>
                                                        <option>Forum</option>
                                                        <option>Outro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Entidade</label>
                                                    <input  type="text" class="form-control" name="entidade" value="<?php echo $evento->entidade ?>" placeholder="ex: Casal Acordeon">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Local</label>
                                                    <input  type="text" class="form-control" name="local"  value="<?php echo $evento->local ?>" placeholder="ex: Salão de Eventos GPLine">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Data</label>
                                                    <input  type="date" class="form-control" name="data"  value="<?php echo $evento->data ?>" placeholder="ex: Ambiente Favorável">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Hora</label>
                                                    <input  type="time" class="form-control" name="hora"  value="<?php echo $evento->hora ?>" placeholder="ex: Ambiente Favorável">
                                                </div>
                                            </div>
                                        </div>
                    
                                        <hr>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                        <a href="{{ url('/listar') }}" class="btn btn-danger">Cancelar</a>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
@stop