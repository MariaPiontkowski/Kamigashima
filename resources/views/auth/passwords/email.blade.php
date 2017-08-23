@extends('layouts.auth', ['title' => 'Recuperar Senha'])

@section('content')
    <form class="form-validation" action="{{ route('password.email') }}" method="post">
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
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span>&times;</span>
                </button>
                <strong>Sucesso!</strong> {{ session('status') }}.
            </div>
        @endif
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">email</i>
            </span>
            <div class="form-line">
                <input type="email" class="form-control" name="email" placeholder="E-mail" required autofocus>
            </div>
        </div>
        <button class="btn btn-block btn-lg bg-blue-grey waves-effect">Recuperar Minha Senha</button>
        <div class="row m-t-20 m-b--5 align-center">
            <a href="{{ route('login') }}">Fazer Login!</a>
        </div>
    </form>
@endsection