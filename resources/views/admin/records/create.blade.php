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
                    <h2 class="pull-left">
                        Adicionar Histórico
                    </h2>

                    <div class="record-navigation pull-right">

                        <a href="{{ route('paciente.prontuario.edit', ['paciente'   => $patient, 'prontuario' => $firstrecord['id']])}}"
                           class="btn bg-grey btn-xs waves-effect" title="Primeiro"
                           data-toggle="tooltip" data-placement="top"
                                {{($firstrecord['id'] == $record->id || $firstrecord['id'] == null) ? 'disabled' : ''}}>
                            <i class="material-icons">first_page</i>
                        </a>

                        <a href="{{ route('paciente.prontuario.edit', ['paciente'   => $patient, 'prontuario' => $prevrecord['id']])}}"
                           class="btn bg-blue-grey btn-xs waves-effect" title="Anterior"
                           data-toggle="tooltip" data-placement="bottom"
                                {{($prevrecord['id']  == $record->id || $prevrecord['id']  == null) ? 'disabled' : ''}}>
                            <i class="material-icons">chevron_left</i>
                        </a>


                        <a href="#" class="btn bg-grey btn-xs waves-effect pull-right" title="Último"
                           data-toggle="tooltip" data-placement="bottom" disabled>
                            <i class="material-icons">last_page</i>
                        </a>

                        <a href="#" class="btn bg-blue-grey btn-xs waves-effect pull-right" title="Próximo"
                           data-toggle="tooltip" data-placement="top" disabled>
                            <i class="material-icons">chevron_right</i>
                        </a>

                        <a href="#" class="btn bg-green btn-xs waves-effect pull-right" disabled>
                            <i class="material-icons">note_add</i> Novo
                        </a>

                    </div>

                </div>
                <div class="body">
                    @include('admin.records.form')
                </div>
            </div>
        </div>
    </div>
@endsection

@push("styles")
<link rel="stylesheet"
      href="{{ asset("plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css") }}">
<style>
    .header{
        height: 65px;
        padding-bottom: 0;
    }


    .record-navigation a {
        margin: 0 4px;
    }
</style>

@endpush