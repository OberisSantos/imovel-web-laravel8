@extends('layouts.main')

@section('titulo', 'Lista de contratos')

@section('conteudo')


    <div class="row-col-12 text-right">
        <a href="/locatario/list/{}" type="button" class="btn mb-3 btn-primary">Novo Contrato</a>
    </div>

    @isset($contrato)

        <div class="table-responsive">
            <table class="table table-sm shadow-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Contrato</th>
                        <th>Locatário</th>
                        <th>Imóvel</th>
                        <th>Inicio</th>
                        <th>Fim</th>
                        <th>Valor</th>
                        <th>Dia-pagamento</th>
                        <th>Situação</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contrato as $contrato)
                        <tr>
                            <td>{{$contrato->id}}</td>
                            <td>{{$contrato->nome}}</td>
                            <td>{{$contrato->imovel_id}}</td>
                            <td>{{$contrato->inicio}}</td>
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
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endisset

    <hr>

    @isset($contratos)
        @if($contratos->count() > 0)
            <div class="table-responsive">
                <h5>Lista de Contratos</h5>
                <table class="table table-sm shadow-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Contrato</th>
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
                        @foreach ($contratos as $contrato)

                        <tr>
                            <td>{{$contrato->id}}</td>
                            <td>{{$contrato->nome}}</td>
                            <td>{{$contrato->imovel_id}}</td>

                            <td>

                                {{date($contrato->inicio)}}

                            </td>

                            <td>{{$contrato->fim}}</td>
                            <td>{{$contrato->valor_mensal}}</td>
                            <td>{{$contrato->dia_pagamento}}</td>
                            <td>{{$contrato->situacao}}</td>
                            <td>{{$contrato->created_at}}</td>
                            <td>
                                @if ($contrato->situacao == 'Pendente')
                                    <a href="/contrato/edit/{{$contrato->id}}"><button class="btn btn-success" title="Concluir Cadastro">Confirmar</button></a>
                                @elseif ($contrato->situacao == 'Aberto')
                                    <a href="/contrato/edit/{{$contrato->id}}"><button class="btn btn-warning" title="Finalizar Contrato">Finalizar</button></a>
                                @endif

                            </td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-dark">
                Não possui <strong>Contratos</strong> cadastrados! <a href="/locatario/list/{}" class="alert-link">Novo contrato</a>.
            </div>

        @endif
    @endisset

@endsection
