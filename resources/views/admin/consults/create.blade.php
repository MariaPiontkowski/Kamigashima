@extends('layouts.admin', ['title' => 'Agendar'])

@section('breadcrumb')
    <li class="active"><a href="{{ route('agenda.index') }}">Agenda</a></li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Agendar Consulta
                    </h2>
                </div>
                <div class="body">
                    @include('admin.consults.form')
                </div>
            </div>
        </div>
    </div>
@endsection