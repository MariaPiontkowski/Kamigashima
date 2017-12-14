@extends("layouts.admin", ["title" => "Paciente"])

@section("breadcrumb")
    <li><a href="{{ route('agenda.index', '') }}"><i class="material-icons">event_note</i> Agenda</a></li>
    <li class="active"><i class="material-icons">supervisor_account</i> Agendamentos</li>
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
                        Agendamentos para o paciente <b>{{$name}}</b>
                    </h2>
                    <br/>
                    <p>Sessões restantes: {{$remaining}}</p>
                </div>
                <div class="body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="40px">Data</th>
                            <th width="40px">Hora</th>
                            <th>Paciente</th>
                            <th>Contato</th>
                            <th>Observação</th>
                            <th width="30px">Sessão</th>
                            <th width="82px">Presença</th>
                            <th width="7%">Ação</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th width="40px">Data</th>
                            <th width="40px">Hora</th>
                            <th>Paciente</th>
                            <th>Contato</th>
                            <th>Observação</th>
                            <th width="30px">Sessão</th>
                            <th width="82px">Presença</th>
                            <th width="7%">Ação</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($consults as $consult)
                            <?php

                            $consult->hour = date("H:i", strtotime($consult->hour));

                            $id =  str_replace(':', '', $consult->hour);

                            $bg = ($consult->presence && $consult->presence == 'OK') ? "rgba(33, 150, 243, 0.3)" : "#9C9C9C";
                            $color = ($consult->presence && $consult->presence == 'OK') ? "#555" : "#fff";

                            ?>
                            <tr style="{{$consult->presence != '' ? "background-color:".$bg."; color:".$color : ""}}">

                                <td>
                                    {{date('d/m/Y', strtotime($consult->date))}}
                                </td>
                                <td>
                                    {{$consult->hour}}
                                </td>
                                <td><div class="name">{{$consult->patient}}</div>

                                    @if($consult->patient != '')
                                        <div style="float: right; width: 65px;">
                                        <button href="#" class="btn btn-xs btn-copy waves-effect"
                                                title="Copiar Paciente" data-toggle="tooltip"
                                                data-placement="bottom" data-clipboard-action="copy"
                                                data-clipboard-text="{{$consult->patient}}">
                                            <i class="material-icons">content_copy</i>
                                        </button>

                                        <a href="{{$patient ? route("paciente.edit", $patient->id) : '#'}}"
                                           class="btn btn-xs btn-copy waves-effect"
                                           title="Paciente{{!$patient ? ' sem Cadastro' : ''}}"
                                           data-toggle="tooltip" data-placement="top"
                                           data-clipboard-action="copy"
                                           data-clipboard-text="{{$consult->patient}}"
                                                {{!$patient ? 'disabled' : ''}}>
                                            <i class="material-icons">person</i>
                                        </a>
                                        </div>
                                    @endif
                                </td>
                                <td>{{$consult->phone}}
                                </td>
                                <td>{{$consult->note}}
                                </td>

                                <td>{{$consult->session}}
                                </td>
                                <td class="text-center" style="padding: 10px !important;">
                                    @if($consult->patient != '')
                                        <form method="get" action="{{route("agenda.presence", $consult->id)}}" style="float: left; width: 36px; height: 27px;">
                                            <button type="submit" class="btn btn-copy btn-xs waves-effect"
                                                    title="{{$consult->presence && $consult->presence == 'FT' ? "Desfazer Falta" : "Faltou"}}"
                                                    style="width: 30px; height: 27px; margin: 0 2px; {{$consult->presence == 'FT' ? "background: #DCDCDC; box-shadow: none; color: #9C9C9C;" : ""}}"
                                                    data-toggle="tooltip" data-placement="top">
                                                <i class="material-icons text-center" style="font-family: inherit; font-size: 15px">FT</i>
                                            </button>
                                            <input type="hidden" name="_method" value="FT">
                                            <input type="hidden" name="page" value="paciente">
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
                                            </button>
                                                <input type="hidden" name="_method" value="NV">
                                                <input type="hidden" name="page" value="paciente">

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
                                            </button>
                                                <input type="hidden" name="_method" value="OK">
                                                <input type="hidden" name="page" value="paciente">
                                        </form>
                                    @endif
                                </td>
                                <td class="text-center" style="padding: 10px !important;">
                                    <a href="{{route("agenda.edit", $consult->id)}}" class="btn bg-grey btn-xs waves-effect"
                                       title="Remarcar"
                                       data-toggle="tooltip" data-placement="top">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <form id="form-delete{{$consult->id}}" method="post"
                                          action="{{route("agenda.destroy", $consult->id)}}"
                                          class="form{{$id}} pull-right">
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

@include("layouts.modules.datatables")
@include("layouts.modules.dialogs")
@push("styles")
<link rel="stylesheet"
      href="{{ asset("plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css") }}">
<style>
    .name{
        width: auto !important;
        min-width: 150px;
        float: left;
    }
    .btn-copy{
        background: #fff;
        color: #337ab7;
    }
    .btn-copy:hover{
        color: #000;
    }
    table.dataTable tbody td {
        vertical-align: middle;
        text-align: center;
    }
</style>

@endpush

@push("scripts")
<script src="{{ asset("plugins/clipboardjs/clipboard.min.js") }}"></script>
    <script>
        {{--$(".table").DataTable({--}}
            {{--language: {--}}
                {{--url: "{{ asset("plugins/jquery-datatable/i18n/Portuguese-Brasil.json") }}"--}}
            {{--},--}}
            {{--autoWidth: false,--}}
            {{--processing: true,--}}
            {{--serverSide: true,--}}
            {{--ajax: "{{ route("api.patient.data") }}",--}}
            {{--columns: [--}}
                {{--{data: "name"},--}}
                {{--{data: "document"},--}}
                {{--{data: "status", orderable: false, searchable: false},--}}
                {{--{data: "action", orderable: false, searchable: false}--}}
            {{--]--}}
        {{--});--}}

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

        new Clipboard('.btn-copy');

        $(".table").DataTable({
            language: {
                url: "{{ asset("plugins/jquery-datatable/i18n/Portuguese-Brasil.json") }}"
            },
            autoWidth: false,
            columns: [
                null,
                null,
                null,
                { orderable: false },
                { orderable: false },
                { orderable: false },
                { orderable: false },
                { orderable: false }
            ]
        });
    </script>
@endpush