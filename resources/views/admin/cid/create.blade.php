@extends('layouts.admin', ['title' => 'Adicionar Convênio'])

@section('breadcrumb')
    <li class="active"><i class="material-icons">playlist_add_check</i> Administração</li>
    <li class="active"><a href="{{ route('convenio.index') }}">Convênios</a></li>
    <li class="active">Adicionar Convênio</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Adicionar Convênio
                    </h2>
                </div>
                <div class="body">
                    @include('admin.agreement.form')
                </div>
            </div>
        </div>
    </div>
@endsection