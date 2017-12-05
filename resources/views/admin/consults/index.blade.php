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

                    <div class="row text-center" style=" height: 55px;">
                        <input type="text" id="date" class="form-control-border text-center"
                               data-toggle="tooltip" data-placement="top" title="Selecionar Data"
                               readonly value="{{ date('d/m/Y', strtotime($date)) }}"/>
                    </div>

                    <div class="row">
                        <div class="consult-calendar">

                            <a href="{{route('agenda.index', [
                            "date" =>  date('Y-m-d', strtotime($date . ' -1 month'))]
                            )}}" class="btn bg-grey btn-xs waves-effect" id="prevmonth" title="Recuar 1 mês"
                                 data-toggle="tooltip" data-placement="left">
                                <i class="material-icons">arrow_back</i>
                            </a>

                            <a href="{{route('agenda.index', [
                            "date" =>  date('Y-m-d', strtotime($date . ' -7 days'))]
                            )}}" class="btn btn-xs waves-effect" id="prevweek" title="Recuar 1 semana"
                                 data-toggle="tooltip" data-placement="top">
                                <i class="material-icons">first_page</i>
                            </a>

                            <a href="{{route('agenda.index', [
                            "date" =>  date('Y-m-d', strtotime($date . ' -1 day'))]
                            )}}" class="btn bg-blue-grey btn-xs waves-effect" id="prev" title="Recuar 1 dia"
                                 data-toggle="tooltip" data-placement="bottom">
                                <i class="material-icons">chevron_left</i>
                            </a>

                            <a href="{{route('agenda.index', ["date" =>  ""])}}"
                               class="btn bg-teal btn-xs waves-effect" id="today" style="width: 80px">
                                <i class="tiny material-icons">event_note</i> Hoje
                            </a>


                            <a href="{{route('agenda.index', [
                            "date" =>  date('Y-m-d', strtotime($date . ' +1 month'))]
                            )}}" class="btn bg-grey btn-xs waves-effect pull-right" id="nextmonth" title="Avançar 1 mês"
                                 data-toggle="tooltip" data-placement="right">
                                <i class="material-icons">arrow_forward</i>
                            </a>

                            <a href="{{route('agenda.index', [
                            "date" =>  date('Y-m-d', strtotime($date . ' +7 days'))]
                            )}}" class="btn btn-xs waves-effect pull-right" id="nextweek" title="Avançar 1 semana"
                                 data-toggle="tooltip" data-placement="top">
                                <i class="material-icons">last_page</i>
                            </a>

                            <a href="{{route('agenda.index', [
                            "date" =>  date('Y-m-d', strtotime($date . ' +1 day'))]
                            )}}" class="btn bg-blue-grey btn-xs waves-effect pull-right" id="next" title="Avançar 1 dia"
                                 data-toggle="tooltip" data-placement="bottom">
                                <i class="material-icons">chevron_right</i>
                            </a>

                        </div>
                    </div>


                    <div class="body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="40px">Hora</th>
                                <th>Paciente</th>
                                <th>Contato</th>
                                <th>Observação</th>
                                <th width="30px">Sessão</th>
                                <th width="82px">Presença</th>
                                <th width="50px">Ação</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th width="40px">Hora</th>
                                <th>Paciente</th>
                                <th>Contato</th>
                                <th>Observação</th>
                                <th width="30px">Sessão</th>
                                <th width="82px">Presença</th>
                                <th>Ação</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($consults as $consult)
                                <?php $id =  str_replace(':', '', $consult->hour);

                                $bg = ($consult->presence && $consult->presence == 'OK') ? "rgba(33, 150, 243, 0.3)" : "#9C9C9C";
                                $color = ($consult->presence && $consult->presence == 'OK') ? "#555" : "#fff";

                                ?>
                                <tr style="{{$consult->presence != '' ? "background-color:".$bg."; color:".$color : ""}}">
                                    <td>
                                        <input id="hour{{$id}}"
                                               value="{{$consult->hour}}" readonly/>
                                    </td>
                                    <td>
                                        <input id="name{{$id}}"
                                               value="{{$consult->patient}}" class="name"
                                               data-reference="{{$id}}"/>

                                        @if($consult->patient != '')
                                            <button href="#" class="btn btn-xs btn-copy waves-effect"
                                                    title="Copiar Paciente" data-toggle="tooltip"
                                                    data-placement="bottom" data-clipboard-action="copy"
                                                    data-clipboard-text="{{$consult->patient}}">
                                                <i class="material-icons">content_copy</i>
                                            </button>

                                            <a href="{{$consult->patient_id != '' ? route("paciente.edit", $consult->patient_id) : '#'}}"
                                                class="btn btn-xs btn-copy waves-effect"
                                                title="Paciente{{$consult->patient_id == '' ? ' sem Cadastro' : ''}}"
                                                data-toggle="tooltip" data-placement="top"
                                                data-clipboard-action="copy"
                                                data-clipboard-text="{{$consult->patient}}"
                                                {{$consult->patient_id == '' ? 'disabled' : ''}}>
                                                <i class="material-icons">person</i>
                                            </a>

                                            <a href="{{route("agenda.paciente", $consult->patient)}}"
                                               class="btn btn-xs btn-copy waves-effect"
                                               title="Ver agendamentos "
                                               data-toggle="tooltip" data-placement="top">
                                                <i class="material-icons">event_note</i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <input id="phone{{$id}}"
                                               value="{{$consult->phone}}"
                                               data-reference="{{$id}}"/>
                                    </td>
                                    <td>
                                        <input id="note{{$id}}"
                                               value="{{$consult->note}}"
                                               data-reference="{{$id}}"/>
                                    </td>

                                    <td>
                                        <input id="session{{$id}}"
                                               value="{{$consult->session}}"
                                               data-reference="{{$id}}"/>
                                    </td>
                                    <td class="text-center" style="padding: 10px !important;">
                                        @if($consult->patient != '')
                                            <form id="form-ft{{$consult->id}}" method="get"
                                                  action="{{route("agenda.presence", $consult->id)}}"
                                                  class="form{{$id}}" style="float: left; width: 36px; height: 27px;">
                                                <button type="submit" class="btn btn-copy btn-xs waves-effect"
                                                        title="{{$consult->presence && $consult->presence == 'FT' ? "Desfazer Falta" : "Faltou"}}"
                                                        style="width: 30px; height: 27px; margin: 0 2px; {{$consult->presence == 'FT' ? "background: #DCDCDC; box-shadow: none; color: #9C9C9C;" : ""}}"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-form="form-ft{{$consult->id}}">
                                                    <i class="material-icons text-center" style="font-family: inherit; font-size: 15px">FT</i>
                                                    <input type="hidden" name="_method" value="FT">
                                                </button>
                                            </form>

                                            <form id="form-nv{{$consult->id}}" method="get"
                                                  action="{{route("agenda.presence", $consult->id)}}"
                                                  class="form{{$id}}" style="float: left;">
                                                <button type="submit" class="btn btn-copy btn-xs waves-effect"
                                                        title="{{$consult->presence && $consult->presence == 'NV' ? "Desfazer Ausência" : "Não Vem"}}"
                                                        style="width: 30px; height: 27px;{{$consult->presence == 'NV' ? "background: #DCDCDC; box-shadow: none; color: #9C9C9C;" : ""}}"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-form="form-ft{{$consult->id}}">
                                                    <i class="material-icons text-center" style="font-family: inherit; font-size: 15px">NV</i>
                                                    <input type="hidden" name="_method" value="NV">
                                                </button>
                                            </form>

                                            <form id="form-ok{{$consult->id}}" method="get"
                                                  action="{{route("agenda.presence", $consult->id)}}"
                                                  class="form{{$id}}" style="float: left;">
                                                <button type="submit" class="btn btn-copy btn-xs waves-effect"
                                                        title="{{$consult->presence && $consult->presence == 'OK' ? "Desfazer Presença" : "Confirmar Presença"}}"
                                                        style="width: 30px; height: 27px; margin: 0 3px;{{$consult->presence == 'OK' ? "background: #DCDCDC; box-shadow: none; color: #9C9C9C;" : ""}}"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-form="form-ok{{$consult->id}}">
                                                    <i class="material-icons text-center" style="font-family: inherit; font-size: 15px">OK</i>
                                                    <input type="hidden" name="_method" value="OK">
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="text-center" style="padding: 10px !important;">
                                        <button class="btn-submit btn bg-green btn-xs waves-effect hidden"
                                                id="btn{{$id}}"
                                                title="Salvar" data-toggle="tooltip" data-placement="top"
                                                data-hour="{{$id}}"
                                                data-hourf="{{$consult->hour}}">
                                            <i class="material-icons">check</i>
                                        </button>
                                        <input type="hidden" id="check{{$id}}" value="{{$consult->patient != '' ? 'form'.$id : ''}}"/>
                                        @if($consult->patient != '')
                                            <form id="form-delete{{$consult->id}}" method="post"
                                                  action="{{route("agenda.destroy", $consult->id)}}"
                                                class="form{{$id}}">
                                            <button type="submit" class="btn bg-red btn-xs waves-effect"
                                                    title="Desmarcar"
                                                    data-toggle="tooltip" data-placement="top" id="btn-delete"
                                                    data-form="form-delete{{$consult->id}}"
                                                    data-hour="{{$consult->hour}}">
                                                <i class="material-icons">clear</i>
                                            </button>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="delete">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
        /*.sweet-alert {*/
            /*background-color: transparent;*/
        /*}*/

        .consult-calendar {
            margin: auto;
            width: 410px;
        }

        #date {
            margin-top: 8px;
            width: 410px;
            border: none;
            border-radius: 0;
            border-bottom: 1px solid #ccc;
            box-shadow: none;
        }

        #date:hover {
            cursor: pointer;
            border-bottom: 2px solid #1f91f3;
        }

        .consult-calendar a {
            float: left;
            margin: 12px 15px;
            color: #fff;
        }

        .consult-calendar a:hover {
            color: #fff;
        }

        #prevweek, #nextweek {
            margin: 12px 0;
            background-color: #7F8E95;
        }

        .tooltip {
            margin: auto !important;
        }
        td input {
            height: 40px;
            width: 100%;
            background: transparent;
            border: none;
            padding: 0 10px;
        }
        td {
            padding: 0 !important;
        }
        .name{
            width: 65% !important;
        }
        .btn-copy{
            background: #fff;
            color: #337ab7;
        }
        .btn-copy:hover{
            color: #000;
        }
    </style>

@endpush

@push("scripts")
    <script src="{{ asset("plugins/momentjs/moment-with-locales.min.js") }}"></script>
    <script src="{{ asset("plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js") }}"></script>
    <script src="{{ asset("plugins/clipboardjs/clipboard.min.js") }}"></script>
    <script>
        inputdate = $('#date');
        var splitdate = inputdate.val().split("/");
        var inputdateval = new Date(splitdate[2], splitdate[1] - 1, splitdate[0]);

        $(function () {

            $('.btn-submit').on('click', function () {

                var hour = $(this).data('hour');
                var hourf = $(this).data('hourf');

                var name = table.$('#name' + hour).val();
                var phone = table.$('#phone' + hour).val();
                var note = table.$('#note' + hour).val();

                $.ajax({
                    url: "{{ route("agenda.store") }}",
                    data: {
                        name: name,
                        date: formatDate(inputdateval),
                        hour: hourf,
                        phone: phone,
                        note: note,
                        _token: "{{ csrf_token() }}"
                    },
                    type: "post"
                }).done(function (result) {
//                    swal({
//                        title: "Enviar E-mail",
//                        text: "Envio de e-mail ao paciente",
//                        type: "input",
//                        inputValue: result,
//                        showCancelButton: true,
//                        closeOnConfirm: false,
//                        inputPlaceholder: "Write something"
//                    }, function (inputValue) {
//                        if (inputValue === false) return false;
//                        if (inputValue === "") {
//                            swal.showInputError("You need to write something!");
//                            return false
//                        }
//                        swal("Nice!", "You wrote: " + inputValue, "success");
//                    });
                    console.log(result);
                });

            });

            $('#btn-ft').on('click', function (e) {

                var id = $(this).data('id');

                    e.preventDefault();

                    $(".sweet-alert").css({'background-color': "#fff"});

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
                    }, function () {
                        var form = $("#" + idform);
                        form.submit();
                    });
            });

            $('td input').on('keyup', function () {
                var reference =  $(this).data('reference');
                var button = $('#btn'+reference);
                var form = $('.form'+reference);

                if($("#name"+reference).val() !== ''){
                    button.removeClass('hidden');
                    if($('#check'+reference).val() !== ''){
                        button.css('float', 'right');
                        form.css('float', 'left');
                    }
                }else{
                    button.addClass('hidden');
                }

            });

            inputdate.bootstrapMaterialDatePicker({
                format: "DD/MM/YYYY",
                switchOnClick: true,
                time: false,
                lang: "pt-br",
                cancelText: "Cancelar"
            });

            inputdate.on('change', function () {
                splitdate = this.value.split("/");
                inputdateval = new Date(splitdate[2], splitdate[1] - 1, splitdate[0]);

                location.href = "/admin/agenda/"+formatDate(inputdateval);

            });


//            $(document).on({
//                ajaxStart: function () {
//                    $(".sweet-alert").css({'background-color': "transparent"});
//                    swal({
//                        title: null,
//                        html: true,
//                        showConfirmButton: false,
//                        text: '<div class="preloader">' +
//                        '<div class="spinner-layer pl-blue-grey">' +
//                        '<div class="circle-clipper left">' +
//                        '<div class="circle"></div>' +
//                        '</div>' +
//                        '<div class="circle-clipper right">' +
//                        '<div class="circle"></div>' +
//                        '</div>' +
//                        '</div>' +
//                        '</div>'
//                    });
//                },
//                ajaxStop: function () {
//                    swal.close()
//                }
//            });

            $('body').on('click', '#btn-delete', function (e) {
                e.preventDefault();

                $(".sweet-alert").css({'background-color': "#fff"});

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
                }, function () {
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
                bInfo: false
            });

            new Clipboard('.btn-copy');

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

    </script>
@endpush
