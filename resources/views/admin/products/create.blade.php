@extends('layouts.admin', ['title' => 'Adicionar Produto'])

@section('breadcrumb')
    <li><a href="{{ route('fornecedor.index') }}"><i class="material-icons">home</i> Fornecedores</a></li>
    <li><a href="{{ route('fornecedor.produtos.index', $provider->id) }}"><i class="material-icons">loyalty</i> Produtos</a></li>
    <li class="active">Adicionar Produto</li>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Adicionar Produto
                        <small>Fornecedor {{ $provider->name }}</small>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('fornecedor.produtos.store', $provider->id) }}" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="dz-message">
                            <div class="drag-icon-cph">
                                <i class="material-icons">touch_app</i>
                            </div>
                            <h3>Arraste os arquivos aqui ou clique para carregar.</h3>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('plugins/dropzone/dropzone.min.js') }}"></script>

    <script>
        $(function () {
            Dropzone.options.frmFileUpload = {
                paramName: "file",
                maxFilesize: 2
            };
        })
    </script>
@endpush