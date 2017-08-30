<form class="form-validation" action="{{ $action }}" method="post">
    {{ csrf_field() }}
    {{ method_field($method) }}
    <div class="row">
        <div class="col-sm-6">
            <label for="name">Nome</label>
            <div class="form-group">
                <div class="form-line">
                    <input id="name" name="name" class="form-control" value="{{ $patient->name }}"
                           placeholder="Digite o nome do paciente" required>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <label for="document">CPF</label>
            <div class="form-group">
                <div class="form-line">
                    <input id="document" name="document" class="form-control" value="{{ $patient->document }}"
                           placeholder="Digite o documento do paciente" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="email">E-mail</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="email" id="email" name="email" class="form-control" value="{{ $patient->email }}"
                           placeholder="Digite o e-mail do paciente">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <label for="gender">Sexo</label>
            <div class="form-group">
                <div class="form-line">
                    <select name="gender" class="form-control show-tick selectpicker"
                            title="Selecione o sexo do paciente">
                        <option value="F" {{ $patient->gender == "F" ? 'selected' : '' }}>Feminino</option>
                        <option value="M" {{ $patient->gender == "M" ? 'selected' : '' }}>Masculino</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="birthday">Data de Aniversário</label>
            <div class="form-group">
                <div class="form-line">
                    <input id="birthday" name="birthday" class="datepicker form-control"
                           value="{{ $patient->birthday ? \Carbon\Carbon::parse($patient->birthday)->format('d/m/Y') : '' }}"
                           placeholder="Escolha a data de aniversário do paciente">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <label for="profession">Profissão</label>
            <div class="form-group">
                <div class="form-line">
                    <input id="profession" name="profession" class="form-control" value="{{ $patient->profession }}"
                           placeholder="Digite a profissão do paciente">
                </div>
            </div>
        </div>
    </div>
    <div class="row button-demo">
        <div class="col-sm-10">
            <button class="btn bg-light-green m-t-15 waves-effect">Salvar</button>
            <a href="{{ route('paciente.index') }}" class="btn bg-grey m-t-15 waves-effect">Voltar</a>
        </div>
        @if($patient->id)
            <div class="col-sm-2">
                <a href="#" class="btn bg-red m-t-15 waves-effect dialog-btn" data-form="form-delete"
                   data-type="confirm">
                    Remover Paciente
                </a>
            </div>
        @endif
    </div>
</form>

@if($patient->id)
    <form id="form-delete" action="{{ route('paciente.destroy', $patient->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
@endif

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/nouislider/nouislider.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('plugins/momentjs/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/nouislider/nouislider.min.js') }}"></script>

    <script>
        $(function () {
            $('.datepicker').bootstrapMaterialDatePicker({
                format: 'DD/MM/YYYY',
                clearButton: true,
                time: false,
                lang: 'pt-br',
                maxDate: new Date(),
                cancelText: 'Cancelar',
                clearText: 'Limpar'
            });

            $('#phone').inputmask({
                mask: ["(99) 9999-9999", "(99) 99999-9999"],
                showMaskOnHover: false,
                clearIncomplete: true
            });

            $('#document').inputmask({
                mask: "999.999.999-99",
                showMaskOnHover: false,
                clearIncomplete: true
            });
        });

    </script>
@endpush

@include('layouts.modules.dialogs')
@include('layouts.modules.validation')

