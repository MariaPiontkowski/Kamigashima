<form class="form-validation" action="{{ $action }}" method="post">
    {{ csrf_field() }}
    {{ method_field($method) }}

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group text-center">
                <label for="code">Data</label>
                <div class="form-line">
                    <input id="code" name="code" class="form-control text-center" value="{{ date('d/m/Y', strtotime($date)) }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group text-center">
                <label for="code">Hora</label>
                <div class="form-line">
                    <input id="code" name="code" class="form-control text-center" value="{{ $hour }}" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="patient">Paciente</label>
                <div class="form-line">
                    <select name="patient" id="patient" class="form-control show-tick selectpicker autofocus"
                            title="Selecione o paciente" data-dropup-auto="false" data-live-search="true"
                            data-live-search-normalize="true" data-live-search-style="contains" autofocus required>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">
                                {{ $patient->name }}
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
                <label for="historic">Observações</label>
                <div class="form-line">
                    <textarea name="note" class="form-control" rows="4"
                              placeholder="Observações" required autofocus>
                    </textarea>
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

@include("layouts.modules.dialogs")
@include("layouts.modules.validation")

