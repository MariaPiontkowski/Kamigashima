@extends('layouts.auth', ['title' => 'Redefinir Senha'])

@section('content')
    <form class="form-validation" action="{{ route('password.request') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        @if($errors->has('email'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    >&times;</span></button>
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
                <i class="material-icons">email</i>
            </span>
            <div class="form-line">
                <input type="email" class="form-control" name="email" placeholder="E-mail"
                       value="{{ $email or old('email') }}" required autofocus>
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" id="password" class="form-control" name="password" minlength="6"
                       placeholder="Senha" required>
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                <input type="password" class="form-control" name="password_confirmation" minlength="6"
                       placeholder="Confirmar Senha" required>
            </div>
        </div>
        <button class="btn btn-block btn-lg bg-blue-grey waves-effect">Redefinir Senha</button>
    </form>
@endsection