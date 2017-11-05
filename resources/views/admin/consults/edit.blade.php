@extends('layouts.admin', ['title' => 'Remarcar Consulta'])

@section('breadcrumb')
    <li><a href="{{ route('agenda.index') }}"><i class="material-icons">supervisor_account</i>Agenda</a></li>
    <li class="active">Remarcar Consulta</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Remarcar Consulta
                    </h2>
                </div>
                <div class="body">
                    <form class="form-validation" action="{{ $action }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field($method) }}

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group text-center">
                                    <label for="date">Data</label>
                                    <div class="form-line">
                                        <input id="date" name="date" class="form-control text-center"
                                               value="{{ date('d/m/Y', strtotime($date)) }}" style="padding: 0" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group text-center">
                                    <label for="hour">Hora</label>
                                    <div class="form-line">
                                        <select name="hour" id="hour" class="form-control" data-dropup-auto="false"
                                                title="Selecione o horário" style="padding: 0" autofocus required>
                                            @foreach($hours as $hour)
                                                <option value="{{ $hour->hour }}">
                                                    {{ $hour->hour }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="patient">Paciente</label>
                                    <div class="form-line">
                                        <input type="text" name="patient" id="patient" class="form-control" disabled value="{{ $patient->name }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="note">Observações</label>
                                    <div class="form-line">
                                        <textarea name="note" class="form-control" rows="4" placeholder="Observações" autofocus>{{$note}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row button-demo">
                            <div class="col-sm-10">
                                <button class="btn bg-light-green m-t-15 waves-effect">Salvar</button>
                                <a href="{{ route("agenda.index") }}" class="btn bg-grey m-t-15 waves-effect">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@include("layouts.modules.dialogs")
@include("layouts.modules.validation")


@push("styles")
    <link rel="stylesheet"
          href="{{ asset("plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css") }}">

    <style>
        .sweet-alert{
            background-color: transparent !important;
        }

        .filter-option{
            text-align: center !important;
        }
    </style>

@endpush

@push("scripts")
    <script src="{{ asset("plugins/momentjs/moment-with-locales.min.js") }}"></script>
    <script src="{{ asset("plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js") }}"></script>
    <script>

        inputdate = $('#date');

        inputdate.bootstrapMaterialDatePicker({
            format: "DD/MM/YYYY",
            switchOnClick: true,
            time: false,
            lang: "pt-br",
            cancelText: "Cancelar"
        });

        $(document).on({
            ajaxStart: function() {
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

        inputdate.on('change', function(){

            var splitdate = this.value.split("/");
            var inputdateval = new Date(splitdate[2], splitdate[1] - 1, splitdate[0]);
            var hour = $('#hour');

            var d = new Date(inputdateval),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            var date = [year, month, day].join('-');

            $.ajax({
                url: "{{ route("api.agenda.hour") }}",
                data: {
                    date: date
                },
                type: "post"
            }).done(function (hours) {
                hour.empty();
                for(i = 0; i < hours.length; i++){
                    hour.append('<option value="'+hours[i].hour+'">'+hours[i].hour+'</option>');
                }
            });
        });

    </script>
@endpush