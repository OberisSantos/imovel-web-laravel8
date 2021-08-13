@extends('layouts.main')

@section('titulo', 'dashboard')

@section('conteudo')
    @if($user)

        @if (isset($dono))
            <div class="row">
                <div class="col-sm-10">
                    <a href="/locatario/list/{}" class="btn btn-contrato">Novo contrato</a>
                    <a href="/locatario/create" class="btn btn-locatario">Novo locatário</a>
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
                                        @if ($contas_ag->count() > 0)
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
                                                                <td data-valor="{{$conta->valor_mensal}}">{{$conta->valor_mensal}}</td>
                                                                <td>{{$conta->valor_recebido}}</td>
                                                                <td>{{$conta->contrato_id}}</td>
                                                                <td>{{$conta->nome}}</td>
                                                                <td>{{$conta->imovel_id}}</td>
                                                                <td>
                                                                    <a href="" data-toggle="modal" id='mudarStatus' data-target="#statusModal" data-id={{$conta->id}} class="btn btn-warning btn-sm" title="Mudar para pago">{{$conta->status}}</a>
                                                                </td>
                                                            @endif
                                                        </tr>

                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif

                                        <!--Aqui vai o modal para alterar status-->
                                        <div class="modal fade" id="statusModal">
                                            <div class="modal-dialog modal-sm">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Alterar para pago?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form action="/conta/update/" method="post" id='form'>
                                                    <div class="modal-body">

                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" id='idConta' name="idConta" class="form-control" value=''>
                                                        <div class="form-group">
                                                            <label for="">Data pagamento</label>
                                                            <input type="date" id='dataPagamento' name="dataPagamento" class="form-control" value=''>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Valor recebido</label>
                                                            <input type="text" id='valorRecebido' name="valorRecebido" class="form-control" value=''>
                                                        </div>
                                                        <label>Status</label>
                                                        <select name="status" class="form-control" id="">
                                                            <option value="pago">Pago</option>
                                                        </select>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" title="Confirmar" class="btn btn-warning ml-2">Confirmar</button>

                                                    </div>
                                                </form>

                                            </div>
                                            </div>
                                        </div>

                                    @endisset

                                    @if ($contas_ag->count() <= 0)
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
                                        @if (@count($contratos) > 0)
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

                                                                <a href="/contrato/edit/{{$contrato->id}}" title="Editar" class="btn btn-secondary btn-sm mr-2"><span class="material-icons">edit</span></a>
                                                            </td>

                                                        </tr>

                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    @endisset

                                    @if (@count($contratos) <= 0)
                                        <div class="jumbotron jumbotron-deshboard">
                                            <h5> Não existe contratos Ativos</h5>
                                            <hr class="my-2">
                                            <a href="/locatario/list/{}" class="btn btn-contrato">Novo contrato</a>
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
                                @if ($contas_pg->count() > 0)
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
                                @else
                                    <div class="jumbotron text-center">
                                        <p>Não existe nenhuma conta paga</p>
                                    </div>
                                @endif

                            @endisset
                        </div>
                    </div>
                </div>

            </div>
        @else
            <div class="jumbotron text-center">
                <p>Realizar cadastro como proprietário de imóvel </p>
                <a href="/prop/create" class="btn btn-locatario">Cadastro</a>
            </div>
        @endif

    @endif


@endsection



