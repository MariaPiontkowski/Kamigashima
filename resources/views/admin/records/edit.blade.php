@extends('layouts.admin', ['title' => 'Editar Histórico'])

@section('breadcrumb')
    <li><a href="{{ route('paciente.index') }}"><i class="material-icons">supervisor_account</i> Pacientes</a></li>
    <li><a href="{{ route('paciente.prontuario.index', $patient->id) }}"><i
                    class="material-icons">supervisor_account</i> Prontuário</a></li>
    <li class="active">Editar Histórico</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Editar Histórico - {{ $record->date_at }} {{ $record->hour_at }}
                    </h2>
                </div>
                <div class="body">
                    @include('admin.records.form')
                </div>
            </div>
        </div>
    </div>
@endsection