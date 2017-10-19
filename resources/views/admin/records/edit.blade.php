@extends('layouts.admin', ['title' => 'Editar CID'])

@section('breadcrumb')
    <li class="active"><i class="material-icons">playlist_add_check</i> Administração</li>
    <li class="active"><a href="{{ route('cid.index') }}">CIDs</a></li>
    <li class="active">Editar CID</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Editar CID
                    </h2>
                </div>
                <div class="body">
                    @include('admin.cid.form')
                </div>
            </div>
        </div>
    </div>
@endsection