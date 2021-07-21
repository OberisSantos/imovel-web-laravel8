@extends('layouts.main')

@section('titulo', 'Lista de Contas')

@section('conteudo')

    @isset($contas)

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
                        <td>{{$conta->valor_mensal}}</td>
                        <td>{{$conta->valor_recebido}}</td>
                        <td>
                            @if ($conta->status == 'aguardando')
                                <a href=""><button class="btn btn-warning" title="Concluir Cadastro">{{$conta->status}}</button></a>
                            @elseif ($conta->status == 'pago')
                                <a href=""><button class="btn btn-success" title="Finalizar Contrato">{{$conta->status}}</button></a>
                            @endif
                        </td>
                        <td>{{$conta->contrato_id}}</td>
                        <td>{{$conta->contrato->locatario->nome}}</td>
                        <td>{{$conta->contrato->imovel->endereco->rua}} nº {{$conta->contrato->imovel->endereco->numero}}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

    @endisset

@endsection
