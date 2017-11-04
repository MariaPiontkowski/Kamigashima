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

                            <div class="btn bg-blue-grey btn-xs waves-effect" id="prev">
                                <i class="material-icons">arrow_back</i>
                            </div>

                            <input type="text" id="date" class="form-control-border text-center"
                                   data-toggle="tooltip" data-placement="top" title="Selecionar Data"
                                   readonly value="{{ date('d/m/Y') }}"/>

                            <div class="btn bg-blue-grey btn-xs waves-effect pull-right" id="next">
                                <i class="material-icons">arrow_forward</i>
                            </div>

                        </div>
                    </div>

                    <div class="body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="5%">Hora</th>
                                <th>Paciente</th>
                                <th>Contato</th>
                                <th>Observação</th>
                                <th width="10%">Ações</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th width="5%">Hora</th>
                                <th>Paciente</th>
                                <th>Contato</th>
                                <th>Observação</th>
                                <th width="10%">Ações</th>
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
<style>
    .consult-calendar{
        float: none !important;
        margin: auto;
        width: 246px;
    }

    .consult-calendar input{
        margin: 8px;
        width: 110px;
    }

    .consult-calendar input:hover{
        cursor: pointer;
        background-color: #F5F5F5;
    }

    .consult-calendar div{
        float:left;
        margin: 12px 15px;
    }
</style>

@endpush

@push("scripts")
<script src="{{ asset("plugins/momentjs/moment-with-locales.min.js") }}"></script>
<script src="{{ asset("plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js") }}"></script>
<script>
    var date = new Date();
    inputdate = $('#date');
    $(function () {

        var splitdate = inputdate.val().split("/");
        var inputdateval = new Date(splitdate[2], splitdate[1] - 1, splitdate[0]);


        $(document).on({
            ajaxStart: function() {
                $(".sweet-alert").css({ 'background-color': "transparent" });
                swal({
                    title: null,
                    html:true,
                    showConfirmButton: false,
                    text: '<div class="preloader">' +
                                '<div class="spinner-layer pl-blue-grey">' +
                                    '<div class="circle-clipper left">' +
                                        '<div class="circle"></div>' +
                                    '</div>' +
                                    '<div class="circle-clipper right">' +
                                        '<div class="circle"></div>' +
                                    '</div>' +
                                '</div>' +
                           '</div>'
                });
            },
            ajaxStop: function () {
               swal.close()
            }
        });
        $('body').on('click', '#btn-delete', function (e) {
            e.preventDefault();

            $(".sweet-alert").css({ 'background-color': "#fff" });

            var idform = $(this).data('form');

            swal({
                title: "Deseja realmente desmarcar?",
                text: "Você não poderá mais recuperar esta informação!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#f44336",
                confirmButtonText: "Sim, quero desmarcar!",
                closeOnConfirm: false
            },function () {
                var form = $("#" + idform);
                form.submit();
            });
        });

    table = $(".table").DataTable({
        language: {
            url: "{{ asset("plugins/jquery-datatable/i18n/Portuguese-Brasil.json") }}"
        },
        autoWidth: false,
        processing: true,
        paging: false,
        bInfo: false,
        ajax: {
            url: "{{ route("api.consult.data") }}",
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                date: formatDate(inputdateval)
            }
        },
        columns: [
            {data: "hour", orderable: false, searchable: false},
            {data: "name", orderable: false,
                fnCreatedCell: function (nTd, sData, oData) {

                var name = oData.name !== null ? oData.name : '';
                    $(nTd).html("<a href='/admin/paciente/"+oData.patient_id+"/editar' target='_blank'>"+name+"</a>");
                }
            },
            {data: "phone", orderable: false},
            {data: "note", orderable: false},
            {data: "action", orderable: false, searchable: false}
        ],
        createdRow: function (row, data) {
            if (data['name'] !== null) {
                $(row).css('background-color', '#E1E1E1');
            }
        }
    });

    $('#prev').on('click', function () {
        date.setDate(date.getDate() - 1);
        inputdate.val(date.toLocaleDateString());
        agenda(formatDate(date));

    });

    $('#next').on('click', function () {
        date.setDate(date.getDate() + 1);
        inputdate.val(date.toLocaleDateString());
        agenda(formatDate(date));
    });

    inputdate.bootstrapMaterialDatePicker({
        format: "DD/MM/YYYY",
        switchOnClick: true,
        time: false,
        lang: "pt-br",
        cancelText: "Cancelar"
    });

    inputdate.on('change', function(){
        var splitdate = this.value.split("/");
        var inputdateval = new Date(splitdate[2], splitdate[1] - 1, splitdate[0]);
        agenda(formatDate(inputdateval));
    });
    });



    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

    function agenda(date){
        $.ajax({
            url: "{{ route("api.consult.data") }}",
            data: {
                date: date,
                _token: "{{ csrf_token() }}"
            },
            type: "post"
        }).done(function (result) {
            table.clear().draw();
            table.rows.add(result['data']).draw();
        });
    }


</script>
@endpush
