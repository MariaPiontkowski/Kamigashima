@extends('layouts.admin', ['title' => 'Editar Fornecedor'])

@section('breadcrumb')
    <li><a href="{{ route('fornecedor.index') }}"><i class="material-icons">supervisor_account</i> Fornecedores</a></li>
    <li class="active">Editar Fornecedor</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Editar Fornecedor
                    </h2>
                </div>
                <div class="body">
                    @include('admin.patient.form')
                </div>
            </div>
        </div>
    </div>
@endsection