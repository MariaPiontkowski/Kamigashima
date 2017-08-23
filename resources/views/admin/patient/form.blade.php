<form class="form-horizontal form-validation" action="{{ $action }}" method="post">
    {{ csrf_field() }}
    {{ method_field($method) }}
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="reference">Referência</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <input id="reference" name="reference" class="form-control"
                           value="{{ $provider->reference }}"
                           placeholder="Digite a referência do fornecedor" required autofocus>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="name">Nome</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <input id="name" name="name" class="form-control" value="{{ $provider->name }}"
                           placeholder="Digite o nome do fornecedor" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="email">E-mail</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <input type="email" id="email" name="email" class="form-control" value="{{ $provider->email }}"
                           placeholder="Digite o e-mail do fornecedor">
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="phone">Telefone</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <input id="phone" name="phone" class="form-control" value="{{ $provider->phone }}"
                           placeholder="Digite o telefone do fornecedor" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="birthday">Data de Aniversário</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
            <div class="form-group">
                <div class="form-line">
                    <input id="birthday" name="birthday" class="datepicker form-control"
                           value="{{ $provider->birthday ? \Carbon\Carbon::parse($provider->birthday)->format('d/m/Y') : '' }}"
                           placeholder="Escolha a data de aniversário do fornecedor">
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
            <label for="commission">Comissão (<span class="nouislider-value"></span>)</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7">
            <div class="form-group">
                <input type="hidden" id="commission" name="commission" value="{{ $provider->commission }}">
                <div id="nouislider" class="m-t-10"></div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-offset-2 col-sm-offset-4 col-xs-offset-5 col-md-2 col-sm-3 col-xs-7">
            <div class="form-group">
                <button class="btn btn-block bg-light-green m-t-15 waves-effect">Salvar</button>
            </div>
        </div>
    </div>
</form>

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

            var sliderBasic = document.getElementById('nouislider');
            var inputHidden = document.getElementById('commission');
            var start = inputHidden.value === '' ? 50 : inputHidden.value;

            noUiSlider.create(sliderBasic, {
                start: start,
                connect: 'lower',
                step: 5,
                range: {
                    'min': [0],
                    'max': [100]
                }
            });
            getNoUISliderValue(sliderBasic, true, inputHidden);
        });

        function getNoUISliderValue(slider, percentage, input) {
            slider.noUiSlider.on('update', function () {
                var val = slider.noUiSlider.get();
                if (percentage) {
                    val = parseInt(val);
                    input.value = val;
                    val += '%';
                }
                $('.nouislider-value').text(val);
            });
        }
    </script>
@endpush

@include('layouts.modules.validation')

