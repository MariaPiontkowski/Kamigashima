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
                    <div class="row" style="margin: 0">
                        <h2 class="pull-left">
                            Consultas
                        </h2>

                        <div class="btn bg-green btn-xs waves-effect pull-right" id="today" title="Hoje"
                             data-toggle="tooltip" data-placement="bottom">
                            <i class="material-icons">event_note</i>
                        </div>
                    </div>

                  <div class="row">
                        <div class="consult-calendar">

                            <div class="btn btn-xs waves-effect" id="prevmonth" title="Recuar 1 mês"
                                 data-toggle="tooltip" data-placement="left">
                                <i class="material-icons">arrow_back</i>
                            </div>

                            <div class="btn btn-xs waves-effect" id="prevweek" title="Recuar 1 semana"
                                 data-toggle="tooltip" data-placement="top">
                                <i class="material-icons">first_page</i>
                            </div>

                            <div class="btn bg-blue-grey btn-xs waves-effect" id="prev" title="Recuar 1 dia"
                                 data-toggle="tooltip" data-placement="bottom">
                                <i class="material-icons">chevron_left</i>
                            </div>

                            <input type="text" id="date" class="form-control-border text-center"
                                   data-toggle="tooltip" data-placement="top" title="Selecionar Data"
                                   readonly value="{{ date('d/m/Y') }}"/>


                            <div class="btn btn-xs waves-effect pull-right" id="nextmonth" title="Avançar 1 mês"
                                 data-toggle="tooltip" data-placement="right">
                                <i class="material-icons">arrow_forward</i>
                            </div>

                            <div class="btn btn-xs waves-effect pull-right" id="nextweek" title="Avançar 1 semana"
                                 data-toggle="tooltip" data-placement="top">
                                <i class="material-icons">last_page</i>
                            </div>

                            <div class="btn bg-blue-grey btn-xs waves-effect pull-right" id="next" title="Avançar 1 dia"
                                 data-toggle="tooltip" data-placement="bottom">
                                <i class="material-icons">chevron_right</i>
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
<style>
    .sweet-alert{
        background-color: transparent;
    }

    .consult-calendar{
        margin: auto;
        width: 410px;
        height: 55px;
    }

    .consult-calendar input{
        margin-top: 8px;
        width: 110px;
        border:none;
        border-radius: 0;
        border-bottom: 1px solid #ccc;
        box-shadow: none;
    }

    .consult-calendar input:hover{
        cursor: pointer;
        border-bottom: 2px solid #1f91f3;
    }

    .consult-calendar div{
        float:left;
        margin: 12px 15px;
        color: #fff;
    }

    .consult-calendar div:hover{
        color:#fff;
    }

    #prevweek, #nextweek{
        margin: 12px 0;
        background-color: #76919b;
    }

    #prevmonth, #nextmonth{
        background-color: #8b9ea7;
    }

    .tooltip{
        margin: auto !important;;
    }
</style>

@endpush

@push("scripts")
<script src="{{ asset("plugins/momentjs/moment-with-locales.min.js") }}"></script>
<script src="{{ asset("plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js") }}"></script>
<script>
    inputdate = $('#date');

    $(function () {

        var splitdate = inputdate.val().split("/");
        var inputdateval = new Date(splitdate[2], splitdate[1] - 1, splitdate[0]);

        inputdate.bootstrapMaterialDatePicker({
            format: "DD/MM/YYYY",
            switchOnClick: true,
            time: false,
            lang: "pt-br",
            cancelText: "Cancelar"
        });

        inputdate.on('change', function(){
            splitdate = this.value.split("/");
            inputdateval = new Date(splitdate[2], splitdate[1] - 1, splitdate[0]);
            agenda(formatDate(inputdateval));
        });


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
                    $(nTd).html("<a href='/admin/paciente/"+oData.patient_id+"/editar'>"+name+"</a>");
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

        $('#today').on('click', function () {
            var date = new Date();
            inputdate.val(date.toLocaleDateString());
            agenda(formatDate(date));
        });

        $('#prevmonth').on('click', function () {
            inputdateval.setMonth(inputdateval.getMonth() - 1);
            inputdate.val(inputdateval.toLocaleDateString());
            agenda(formatDate(inputdateval));
        });

        $('#prevweek').on('click', function () {
            inputdateval.setDate(inputdateval.getDate() - 7);
            inputdate.val(inputdateval.toLocaleDateString());
            agenda(formatDate(inputdateval));
        });

        $('#prev').on('click', function () {
            inputdateval.setDate(inputdateval.getDate() - 1);
            inputdate.val(inputdateval.toLocaleDateString());
            agenda(formatDate(inputdateval));
        });

        $('#next').on('click', function () {
            inputdateval.setDate(inputdateval.getDate() + 1);
            inputdate.val(inputdateval.toLocaleDateString());
            agenda(formatDate(inputdateval));
        });

        $('#nextweek').on('click', function () {
            inputdateval.setDate(inputdateval.getDate() + 7);
            inputdate.val(inputdateval.toLocaleDateString());
            agenda(formatDate(inputdateval));
        });

        $('#nextmonth').on('click', function () {
            inputdateval.setMonth(inputdateval.getMonth() + 1);
            inputdate.val(inputdateval.toLocaleDateString());
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
