@extends('layouts.admin', ['title' => 'Editar Paciente'])

@section('breadcrumb')
    <li><a href="{{ route('paciente.index') }}"><i class="material-icons">supervisor_account</i> Pacientes</a></li>
    <li class="active">Editar Paciente</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header" style="height: 60px;">
                    <h2 class="pull-left">
                        Editar Paciente
                    </h2>
                    <button class="btn btn-xs btn-copy waves-effect pull-right" title="Copiar Paciente"
                    data-toggle="tooltip" data-placement="left"
                    data-clipboard-action="copy" data-clipboard-text="{{$patient->name}}">
                    <i class="material-icons">content_copy</i>
                    </button>
                </div>
                <div class="body">
                    @include('admin.patient.form')
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script src="{{ asset("plugins/clipboardjs/clipboard.min.js") }}"></script>
<script>
    new Clipboard('.btn-copy');
</script>
@endpush