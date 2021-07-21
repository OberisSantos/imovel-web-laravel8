@extends('layouts.main')

@section('titulo', 'proprietario')

@section('conteudo')


    <div class="row-col-12 text-right">
        <button type="button" class="btn mb-3 btn-primary">Novo Imóvel</button>
    </div>

    @isset($dono)

        <div class="table-responsive">
            <table class="table table-sm shadow-sm">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Rg</th>
                        <th>Endereço</th>
                        <th>Contato</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$dono->id}}</td>
                        <td>{{$dono->nome}}</td>
                        <td>{{$dono->cpf}}</td>
                        <td>{{$dono->email}}</td>
                        <td>{{$dono->rg}}</td>
                        <td>{{$dono->endereco->rua}} nº {{$dono->endereco->numero}}</td>
                        <td>{{$dono->contato->tel}}</td>
                        <td>
                            <a href=""><button class="btn btn-danger">Apagar</button></a>
                            <a href=""><button class="btn btn-secondary">Editar</button></a>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>

        @if($imoveis)
            <div class="table-responsive">
                <h5>Lista de Imóveis</h5>
                <table class="table table-sm shadow-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Topo</th>
                            <th>Endereço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($imoveis as $imovel)
                            <tr>
                                <td>{{$imovel->id}}</td>
                                <td>{{$imovel->tipo}}</td>
                                <td>{{$imovel->endereco->rua}} nº {{$imovel->endereco->numero}}</td>
                                <td>
                                    <a href=""><button class="btn btn-danger">Apagar</button></a>
                                    <a href=""><button class="btn btn-secondary">Editar</button></a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif


    @endisset
@endsection
