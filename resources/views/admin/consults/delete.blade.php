@extends('layouts.admin', ['title' => 'Adicionar Cid'])

@section('breadcrumb')
    <li class="active"><i class="material-icons">playlist_add_check</i> Administração</li>
    <li class="active"><a href="{{ route('cid.index') }}">Cids</a></li>
    <li class="active">Adicionar Cid</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Adicionar Cid
                    </h2>
                </div>
                <div class="body">
                    @include('admin.cid.form')
                </div>
            </div>
        </div>
    </div>
@endsection