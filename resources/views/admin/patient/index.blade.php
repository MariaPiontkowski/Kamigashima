@extends('layouts.admin', ['title' => 'Pacientes'])

@section('breadcrumb')
    <li class="active"><i class="material-icons">supervisor_account</i> Pacientes</li>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Lista de Pacientes
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="#" onclick="event.preventDefault()" class="dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('paciente.create') }}">Adicionar Paciente</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover table-basic">
                        <thead>
                        <tr>
                            <th>Referência</th>
                            <th>Nome</th>
                            <th>Comissão</th>
                            <th width="15%">Ações</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Referência</th>
                            <th>Nome</th>
                            <th>Comissão</th>
                            <th>Ações</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($patients as $patient)
                            <tr>
                                <td>{{ $patient->reference }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->commission }}%</td>
                                <td>
                                    <div class="pull-right">
                                        <a href="{{ route('paciente.edit', $patient->id) }}" data-toggle="tooltip"
                                           class="btn btn-default btn-xs waves-effect" title="Editar paciente">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <form action="{{ route('paciente.destroy', $patient->id) }}" method="post"
                                              class="visible-lg-inline">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="button" class="btn bg-red btn-xs waves-effect dialog-btn"
                                                    data-type="confirm" data-toggle="tooltip"
                                                    title="Excluir paciente">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.modules.datatables')
@include('layouts.modules.dialogs')
