@extends('layouts.app')
@section('content')
<div style="border:solid 1px #3bafda" class="wrapper-page card-box" >
    <div class="text-center">
        <a href="#" class="logo-lg"><i class=" fa fa-birthday-cake"></i> <span>GESTEVENTO</span> </a>
    </div>
    <hr><br>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group row">
            <div class="col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input id="email" placeholder="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                    </div>
                    <input id="password" placeholder="senha" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>
            </div>
        </div>
        <div class="form-group text-right m-t-10">
            <div class="col-xs-12 ">
                <input type="hidden" value="logar" name="operacao">
                <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">Entrar</button>
            </div>
        </div>
    </form>
</div>
@endsection
