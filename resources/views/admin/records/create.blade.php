@extends('layouts.admin', ['title' => 'Adicionar Histórico'])

@section('breadcrumb')
    <li><a href="{{ route('paciente.index') }}"><i class="material-icons">supervisor_account</i> Pacientes</a></li>
    <li><a href="{{ route('paciente.prontuario.index', $patient->id) }}"><i
                    class="material-icons">supervisor_account</i> Prontuário</a></li>
    <li class="active">Adicionar Histórico</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Adicionar Histórico
                    </h2>
                </div>
                <div class="body">
                    @include('admin.records.form')
                </div>
            </div>
        </div>
    </div>
@endsection