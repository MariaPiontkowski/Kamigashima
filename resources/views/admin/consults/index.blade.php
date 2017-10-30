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

                    <div class="header-button pull-right">
                        <a href="#"
                           class="btn bg-green btn-xs waves-effect"
                           data-toggle="tooltip" data-placement="top">
                            <i class="material-icons">group_add</i>
                            <span class="i-span">Agendar Consulta</span>
                        </a>
                    </div>



                    <div class="row">
                        <div class="consult-calendar col-md-3">

                            <div class="btn bg-grey btn-xs waves-effect" id="prev">
                                <i class="material-icons">arrow_back</i>
                            </div>

                            <input type="text" value="<?php echo date("d/m/Y") ?>" id="date"
                                   class="form-control-border col-md-6 text-center" readonly/>

                            <div class="btn bg-grey btn-xs waves-effect" id="next">
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

@push("scripts")
<script>

    var date = new Date();

    $('#prev').click(function () {
        date.setDate(date.getDate() - 1);
        $('#date').val(date.toLocaleDateString())
    });

    $('#next').click(function () {
        date.setDate(date.getDate() + 1);
        $('#date').val(date.toLocaleDateString())
    });

    $(".table").DataTable({
        language: {
            url: "{{ asset("plugins/jquery-datatable/i18n/Portuguese-Brasil.json") }}"
        },
        autoWidth: false,
        processing: true,
        serverSide: true,
        paging: false,
        bInfo: false,
        ajax: {
           url: "{{ route("api.consult.data") }}"
        },
        length: 21,
        columns: [
            {data: "hour"},
            {data: "name", id: "patient"},
            {data: "phone"},
            {data: "note"},
            {data: "action", orderable: false, searchable: false}
        ],
        createdRow: function (row, data) {
            if (data['name'] !== null) {
                $(row).css('background-color', '#f5f5f5');
            }

        }
    });

</script>
@endpush