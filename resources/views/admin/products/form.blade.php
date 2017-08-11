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
                    <input type="text" id="reference" name="reference" class="form-control"
                           value="{{ $provider->reference }}"
                           placeholder="Digite a referência do fornecedor" required autofocus>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-offset-2 col-sm-offset-4 col-xs-offset-5 col-md-2 col-sm-3 col-xs-7">
            <div class="form-group">
                <button type="submit" class="btn btn-block bg-light-green m-t-15 waves-effect">Salvar</button>
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
    <script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}"></script>

    <script>
        $(function () {
            $('#reference').inputmask({
                mask: "9{1,5}",
                showMaskOnHover: false,
                clearIncomplete: true
            });
        });
    </script>
@endpush

@include('layouts.modules.validation')

