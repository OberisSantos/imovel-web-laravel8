@extends('layouts.main')

@section('titulo', 'Lista de Contas')

@section('conteudo')

    @isset($contas)
        @if (@count($contas) > 0)

            <div class="table-responsive">
                <h5>Lista de Contas</h5>
                <table class="table table-sm shadow-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Conta</th>
                            <th>Vencimento</th>
                            <th>Pagamento</th>
                            <th>Valor à pagar</th>
                            <th>Valor Pago</th>
                            <th>Situação</th>
                            <th>Contrato</th>
                            <th>Locatário</th>
                            <th>Imóvel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contas as $conta)

                        <tr>
                            <td>{{$conta->id}}</td>
                            <td>{{$conta->vencimento}}</td>
                            <td>{{$conta->pagamento}}</td>
                            <td data-valor="{{$conta->valor_mensal}}">{{$conta->valor_mensal}}</td>
                            <td>{{$conta->valor_recebido}}</td>
                            <td>
                                @if ($conta->status == 'aguardando')
                                    <button type="button" class="btn btn-warning" title="alterar status" data-toggle="modal" id='mudarStatus' data-target="#statusModal" data-id={{$conta->id}} >{{$conta->status}}</a>
                                @elseif ($conta->status == 'pago')
                                    <button type="button" class="btn btn-success" title="pago">{{$conta->status}}</button>
                                @endif
                            </td>
                            <td>{{$conta->contrato_id}}</td>
                            <td>{{$conta->nome}}</td>
                            <td>{{$conta->imovel_id}}</td>
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
                            <label>Status</label>
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

@endsection
