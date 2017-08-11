@extends('layouts.admin', ['title' => 'Produtos'])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Editar Produto
                    </h2>
                </div>
                <div class="body">
                    @include('admin.provider.form')
                </div>
            </div>
        </div>
    </div>
@endsection