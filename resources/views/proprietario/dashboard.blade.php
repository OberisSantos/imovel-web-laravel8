@extends('layouts.main')

@section('titulo', 'dashboard')

@section('conteudo')
    @if($user)
        <div class="row">
            <div class="col-sm-10">
                <a href="" class="btn btn-contrato">Novo contrato</a>
                <a href="" class="btn btn-locatario">Novo locatário</a>
            </div>
            <div class="col-sm-2">
                <span class="date-time" id="data">hora</span>
                <small class="date-time" id="hora">hora</small>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <h5 class="card-header">Contas à pagar</h5>
                            <div class="card-body">
                                @isset($contas_ag)
                                    @if (@count($contas_ag) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Conta</th>
                                                        <th>Data Vencimento</th>
                                                        <th>Data Pagamento</th>
                                                        <th>Valor à pagar</th>
                                                        <th>Valor Pago</th>
                                                        <th>Contrato</th>
                                                        <th>Locatário</th>
                                                        <th>Imóvel</th>
                                                        <th>Situação</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($contas_ag as $conta)

                                                    <tr>
                                                        @if ($conta->status == 'aguardando')
                                                            <td>{{$conta->id}}</td>
                                                            <td>{{$conta->vencimento}}</td>
                                                            <td>{{$conta->pagamento}}</td>
                                                            <td>{{$conta->valor_mensal}}</td>
                                                            <td>{{$conta->valor_recebido}}</td>
                                                            <td>{{$conta->contrato_id}}</td>
                                                            <td>{{$conta->nome}}</td>
                                                            <td>{{$conta->imovel_id}}</td>
                                                            <td>
                                                                <a href="" class="btn btn-warning btn-sm" title="Mudar para pago">{{$conta->status}}</a>
                                                            </td>
                                                        @endif
                                                    </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                @endisset

                                @if (@count($contas_ag) < 0)
                                <div class="jumbotron jumbotron-deshboard">
                                    <h5> Não existe contas à pagar</h5>
                                </div>
                            @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card bg-light">
                            <div class="card-header d-flex">
                                <h5>Contratos Ativos </h5>
                                <h5 class="ml-auto badge badge-secondary">Total:
                                    @if (@count($contratos)> 0)
                                        {{@count($contratos)}}
                                    @else
                                        0
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">
                                @isset($contratos)
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead >
                                                <tr>
                                                    <th>Contrato</th>
                                                    <th>Locatário</th>
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
                                                    <th><a href="" class="badge badge-info">{{$contrato->id}} </a></th>
                                                    <td>{{$contrato->nome}}</td>

                                                    <td>

                                                        {{date($contrato->inicio)}}

                                                    </td>

                                                    <td>{{$contrato->fim}}</td>
                                                    <td>{{$contrato->valor_mensal}}</td>
                                                    <td>{{$contrato->dia_pagamento}}</td>
                                                    <td>{{$contrato->situacao}}</td>
                                                    <td>{{$contrato->created_at}}</td>
                                                    <td class="d-flex">
                                                        <a href="/contrato/edit/{{$contrato->id}}" class="btn btn-warning btn-sm mr-2" title="Finalizar Contrato">
                                                            <span class="material-icons">do_not_disturb_on</span>
                                                            </a>


                                                        <a href="/contrato/edit/{{$contrato->id}}" title="Editar" class="btn btn-secondary btn-sm mr-2"><span class="material-icons">edit</span></a>
                                                    </td>

                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endisset

                                @if (@count($contratos) < 0)
                                    <div class="jumbotron jumbotron-deshboard">
                                        <h5> Não existe contratos Ativos</h5>
                                        <hr class="my-2">
                                        <a href="" class="btn btn-contrato">Novo contrato</a>
                                    </div>
                                @endif



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-light">
                    <h5 class="card-header">Contas pagas</h5>
                    <div class="card-body">
                        @isset($contas_pg)
                                    @if (@count($contas_pg) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Conta</th>
                                                        <th>Dt Pg</th>
                                                        <th>Valor</th>
                                                        <th>Contrato</th>
                                                        <th>Locatário</th>
                                                        <th>Situação</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($contas_pg as $conta)

                                                    <tr>
                                                        @if ($conta->status == 'pago')
                                                            <td>{{$conta->id}}</td>
                                                            <td>{{$conta->pagamento}}</td>
                                                            <td>{{$conta->valor_recebido}}</td>
                                                            <td>{{$conta->contrato_id}}</td>
                                                            <td>{{$conta->nome}}</td>
                                                            <td>
                                                                <a href="" class="btn btn-success btn-sm" title="Pago">
                                                                    <span class="material-icons">check_circle</span>
                                                                </a>
                                                            </td>
                                                        @endif
                                                    </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                @endisset
                    </div>
                </div>
            </div>

        </div>

    @endif


@endsection



