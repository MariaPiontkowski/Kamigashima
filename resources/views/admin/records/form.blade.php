<form class="form-validation" action="{{ $action }}" method="post">
    {{ csrf_field() }}
    {{ method_field($method) }}

    <div class="form-group">
        <label for="historic">Histórico</label>
        <div class="form-line">
                <textarea id="historic" name="historic" class="form-control" rows="4" placeholder="Digite o histórico do paciente" required autofocus>{{ $record->historic }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="evolution">Evolução</label>
        <div class="form-line">
                <textarea id="evolution" name="evolution" class="form-control" rows="4" placeholder="Digite a evolução do paciente" required>{{ $record->evolution }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="procedure">Procedimentos</label>
        <div class="form-line">
                <textarea id="procedure" name="procedure" class="form-control" rows="4" placeholder="Digite os procedimentos utilizados" required>{{ $record->procedure }}</textarea>
        </div>
    </div>

    <div class="row button-demo">
        <div class="col-sm-10">
            <button class="btn bg-light-green m-t-15 waves-effect">Salvar</button>
            <a href="{{ route("paciente.prontuario.index", $patient->id) }}" class="btn bg-grey m-t-15 waves-effect">Voltar</a>
        </div>
        @if($record->id)
            <div class="col-sm-2">
                <a href="#" class="btn bg-red m-t-15 waves-effect dialog-btn" data-form="form-delete"
                   data-type="confirm">
                    Remover Histórico
                </a>
            </div>
        @endif
    </div>
</form>

@if($record->id)
    <form id="form-delete"
          action="{{ route("paciente.prontuario.destroy", ['paciente', $patient->id, 'prontuario' => $record->id]) }}"
          method="post">
        {{ csrf_field() }}
        {{ method_field("delete") }}
    </form>
@endif

@include("layouts.modules.dialogs")
@include("layouts.modules.validation")

