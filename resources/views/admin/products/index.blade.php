@extends('layouts.admin', ['title' => 'Produtos'])

@section('breadcrumb')
    <li><a href="{{ route('fornecedor.index') }}"><i class="material-icons">supervisor_account</i> Fornecedores</a></li>
    <li class="active"><i class="material-icons">loyalty</i> Produtos</li>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            {{ session('success') }}
        </div>
    @endif
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Lista de Produtos
                        <small>Fornecedor {{ $provider->name }}</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="#" onclick="event.preventDefault()" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('fornecedor.produtos.create', $provider->id) }}">Adicionar Produtos</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover table-basic">
                        <thead>
                            <tr>
                                <th>Referência</th>
                                <th>Nome</th>
                                <th>Comissão</th>
                                <th width="15%">Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Referência</th>
                                <th>Imagem</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($provider->products as $product)
                                <tr>
                                    <td>{{ $product->reference }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->commission }}%</td>
                                    <td>
                                        <div class="pull-right">
                                            <a href="{{ route('fornecedor.edit', $product->id) }}" data-toggle="tooltip"
                                               class="btn btn-default btn-xs waves-effect" title="Editar fornecedor">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form action="{{ route('fornecedor.destroy', $product->id) }}" method="post"
                                                  class="visible-lg-inline">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="button" class="btn bg-red btn-xs waves-effect dialog-btn"
                                                        data-type="confirm" data-toggle="tooltip" title="Excluir fornecedor">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </div>
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

@include('layouts.modules.datatables')
@include('layouts.modules.dialogs')
