@extends("layouts.admin", ["title" => "Prontuário"])

@section("breadcrumb")
    <li><a href="{{ route('paciente.index') }}"><i class="material-icons">supervisor_account</i> Pacientes</a></li>
    <li class="active">Prontuário</li>
@endsection

@section("content")
    @if (session("success"))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
            {{ session("success") }}
        </div>
    @endif
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Prontuário de {{ $patient->name }}
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="#" onclick="event.preventDefault()" class="dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route("paciente.prontuario.create", $patient->id) }}">Adicionar
                                        Histórico</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Hora</th>
                            <th width="5%">Ações</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Ações</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include("layouts.modules.datatables")
@include("layouts.modules.dialogs")

@push("scripts")
    <script>
        $(".table").DataTable({
            language: {
                url: "{{ asset("plugins/jquery-datatable/i18n/Portuguese-Brasil.json") }}"
            },
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route("api.record.data") }}",
            columns: [
                {data: "date_at"},
                {data: "hour_at"},
                {data: "action", orderable: false, searchable: false}
            ]
        });
    </script>
@endpush