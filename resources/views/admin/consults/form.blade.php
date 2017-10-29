<form class="form-validation" action="{{ $action }}" method="post">
    {{ csrf_field() }}
    {{ method_field($method) }}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="code">CID</label>
                <div class="form-line">
                    <input id="code" name="code" class="form-control" value="{{ $cid->code }}"
                           placeholder="Digite o código do CID" required autofocus>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="description">CID</label>
                <div class="form-line">
                    <input id="description" name="description" class="form-control" value="{{ $cid->description }}"
                           placeholder="Digite o código do CID" required autofocus>
                </div>
            </div>
        </div>
    </div>

    <div class="row button-demo">
        <div class="col-sm-10">
            <button class="btn bg-light-green m-t-15 waves-effect">Salvar</button>
            <a href="{{ route("cid.index") }}" class="btn bg-grey m-t-15 waves-effect">Voltar</a>
        </div>
        @if($cid->id)
            <div class="col-sm-2">
                <a href="#" class="btn bg-red m-t-15 waves-effect dialog-btn" data-form="form-delete"
                   data-type="confirm">
                    Remover CID
                </a>
            </div>
        @endif
    </div>
</form>

@if($cid->id)
    <form id="form-delete" action="{{ route("cid.destroy", $cid->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field("delete") }}
    </form>
@endif

@include("layouts.modules.dialogs")
@include("layouts.modules.validation")

