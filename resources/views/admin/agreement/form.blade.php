<form class="form-validation" action="{{ $action }}" method="post">
    {{ csrf_field() }}
    {{ method_field($method) }}

    <div class="form-group">
        <label for="name">Convênio</label>
        <div class="form-line">
            <input id="name" name="name" class="form-control" value="{{ $agreement->agreement }}"
                   placeholder="Digite o convênio" required autofocus>
        </div>
    </div>

    <div class="row button-demo">
        <div class="col-sm-10">
            <button class="btn bg-light-green m-t-15 waves-effect">Salvar</button>
            <a href="{{ route("convenio.index") }}" class="btn bg-grey m-t-15 waves-effect">Voltar</a>
        </div>
        @if($agreement->id)
            <div class="col-sm-2">
                <a href="#" class="btn bg-red m-t-15 waves-effect dialog-btn" data-form="form-delete"
                   data-type="confirm">
                    Remover Convênio
                </a>
            </div>
        @endif
    </div>
</form>

@if($agreement->id)
    <form id="form-delete" action="{{ route("convenio.destroy", $agreement->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field("delete") }}
    </form>
@endif

@include("layouts.modules.dialogs")
@include("layouts.modules.validation")

