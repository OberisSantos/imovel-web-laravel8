@extends('layouts.main')

@section('titulo', 'Mensagens')

@section('conteudo')

    @isset($mensagem)
        @if ($mensagem->count() > 0)
            <div class="table-responsive">
                <h5>Mensagens</h5>
                <table class="table table-sm shadow-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Imóvel</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mensagem as $notific)

                            <tr>
                                <td>{{$notific->nome}}</td>
                                <td>{{$notific->email}}</td>
                                <td>{{$notific->telefone}}</td>
                                <td>{{$notific->imovel_id}}</td>
                                <td>{{$notific->created_at}}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-dark">
                Não possui nenhuma <strong>mensagem</strong> </a>.
            </div>
        @endif



    @endisset

@endsection
