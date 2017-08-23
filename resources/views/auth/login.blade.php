@extends('layouts.auth', ['title' => 'Login'])

@section('content')
    <form class="form-validation" action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        @if($errors->has('email'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span>&times;</span>
                </button>
                <strong>Oops!</strong> {{ $errors->first('email') }}
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">person</i>
            </span>
            <div class="form-line">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                       placeholder="E-mail" required autofocus>
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" class="form-control" name="password" placeholder="Senha" required>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-7 p-t-5">
                <input type="checkbox" name="remember" id="remember"
                       class="filled-in chk-col-blue-grey" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Manter-me conectado</label>
            </div>
            <div class="col-xs-5">
                <button class="btn btn-block bg-blue-grey waves-effect">Entrar</button>
            </div>
        </div>
        <div class="row m-t-20 m-b--5 align-center">
            <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
        </div>
    </form>
@endsection