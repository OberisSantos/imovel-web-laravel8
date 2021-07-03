@extends('layouts.main')

@section('titulo', 'Lista de contratos')

@section('conteudo')


    <div class="row-col-12 text-right">
        <button type="button" class="btn mb-3 btn-primary">Novo Contrato</button>
    </div>

    @isset($contrato)

        <div class="table-responsive">
            <table class="table table-sm shadow-sm">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Locatário</th>
                        <th>Imóvel</th>
                        <th>Nº</th>
                        <th>Inicio</th>
                        <th>Fim</th>
                        <th>Valor</th>
                        <th>Dia-pagamento</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$contrato->id}}</td>
                        <td>{{$contrato->locatario->nome}}</td>
                        <td>{{$contrato->imovel->tipo}}</td>
                        <td>{{$contrato->imovel->endereco->numero}}</td>
                        <td>{{$contrato->inicio->format('d/m/Y')}}</td>
                        <td>{{$contrato->fim}}</td>
                        <td>{{$contrato->valor_mensal}}</td>
                        <td>{{$contrato->dia_pagamento}}</td>
                        <td>{{$contrato->situacao}}</td>
                        <td>
                            @if ($contrato->situacao == 'Pendente')
                                <a href="/contrato/edit/{{$contrato->id}}"><button class="btn btn-success" title="Concluir Cadastro">Confirmar</button></a>
                            @elseif ($contrato->situacao == 'Aberto')
                                <a href="/contrato/edit/{{$contrato->id}}"><button class="btn btn-warning" title="Finalizar Contrato">Finalizar</button></a>
                            @endif
                            <a href="/contrato/edit/{{$contrato->id}}"><button class="btn btn-secondary">Editar</button></a>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>

    @endisset

    <hr>

    @isset($contratos)

        <div class="table-responsive">
            <h5>Lista de Contratos</h5>
            <table class="table table-sm shadow-sm">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Locatário</th>
                        <th>Imóvel</th>
                        <th>Inicio</th>
                        <th>Fim</th>
                        <th>Valor</th>
                        <th>Dia-pagamento</th>
                        <th>Situação</th>
                        <th>Criado em</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locatarios as $lt)

                    <tr>
                        <td>{{$contrato->id}}</td>
                        <td>{{$contrato->locatario->nome}}</td>
                        <td>{{$contrato->imovel->rua}}| nº {{$contrato->imovel->numero}}</td>

                        <td>

                            {{date($contrato->inicio)}}

                           </td>

                        <td>{{$contrato->fim}}</td>
                        <td>{{$contrato->valor_mensal}}</td>
                        <td>{{$contrato->dia_pagamento}}</td>
                        <td>{{$contrato->situacao}}</td>
                        <td>{{$contrato->created_at}}</td>
                        <td>
                            <a href="/contrato/edit/{{$contrato->id}}"><button class="btn btn-danger">Confirmar</button></a>
                            <a href=""><button class="btn btn-secondary">Editar</button></a>
                        </td>

                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

    @endisset

@endsection
