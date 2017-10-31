@extends("layouts.admin", ["title" => "Agenda"])

@section("breadcrumb")
    <li class="active"><i class="material-icons">event_note</i> Agenda</li>
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
                        Consultas
                    </h2>

                    <div class="row">
                        <div class="consult-calendar">

                            <div class="btn bg-teal btn-xs waves-effect" id="prev">
                                <i class="material-icons">arrow_back</i>
                            </div>

                            <input type="text" id="date" class="form-control-border text-center"
                                   data-toggle="tooltip" data-placement="top" title="Selecionar Data"
                                   readonly value="{{ date('d/m/Y') }}"/>

                            <div class="btn bg-teal btn-xs waves-effect pull-right" id="next">
                                <i class="material-icons">arrow_forward</i>
                            </div>

                        </div>
                    </div>

                    <div class="body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Contato</th>
                                <th>Observação</th>
                                <th width="9%">Ações</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th>Contato</th>
                                <th>Observação</th>
                                <th width="9%">Ações</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include("layouts.modules.datatables")
@include("layouts.modules.dialogs")

@push("styles")
<link rel="stylesheet"
      href="{{ asset("plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css") }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@push("scripts")
<script src="{{ asset("plugins/momentjs/moment-with-locales.min.js") }}"></script>
<script src="{{ asset("plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js") }}"></script>
<script>
    var date = new Date();

    $('#prev').click(function () {
        date.setDate(date.getDate() - 1);
        $('#date').val(date.toLocaleDateString());

    });

    $('#next').click(function () {
        date.setDate(date.getDate() + 1);
        $('#date').val(date.toLocaleDateString());
    });

    var table = $(".table").DataTable({
        language: {
            url: "{{ asset("plugins/jquery-datatable/i18n/Portuguese-Brasil.json") }}"
        },
        autoWidth: false,
        processing: true,
        serverSide: true,
        paging: false,
        bInfo: false,
        ajax: {
            url: "{{ route("api.consult.data") }}",
            type: 'post',
            data: {_token: "{{ csrf_token() }}"}
        },
        columns: [
            {data: "hour", orderable: false, searchable: false},
            {data: "name", id: "patient", orderable: false},
            {data: "phone", orderable: false},
            {data: "note", orderable: false},
            {data: "action", orderable: false, searchable: false}
        ],
        createdRow: function (row, data) {
            if (data['name'] !== null) {
                $(row).css('background-color', '#f5f5f5');
            }

        }
    });

    $('#date').bootstrapMaterialDatePicker({
        format: "DD/MM/YYYY",
        switchOnClick: true,
        time: false,
        lang: "pt-br",
        cancelText: "Cancelar"
    });
</script>
@endpush
