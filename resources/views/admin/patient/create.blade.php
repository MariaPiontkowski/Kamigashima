@extends('layouts.admin', ['title' => 'Adicionar Paciente'])

@section('breadcrumb')
    <li><a href="{{ route('paciente.index') }}"><i class="material-icons">supervisor_account</i> Pacientes</a></li>
    <li class="active">Adicionar Paciente</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Adicionar Paciente
                    </h2>
                </div>
                <div class="body">
                    @include('admin.patient.form')
                </div>
            </div>
        </div>
    </div>
@endsection