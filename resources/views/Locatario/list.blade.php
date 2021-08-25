@extends('layouts.main')

@section('titulo', 'Lista de Locatários')

@section('conteudo')

    @if(isset($locatarios))
        <div class="row-col-12 text-right">
            <a href="/locatario/create" class="btn mb-3 btn-primary">Novo Locatário</a>
        </div>
    @endif

    @isset($locatario)

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
                        <td>{{$locatario->id}}</td>
                        <td>{{$locatario->nome}}</td>
                        <td>{{$locatario->cpf}}</td>
                        <td>{{$locatario->email}}</td>
                        <td>{{$locatario->rg}}</td>
                        <td>{{$locatario->endereco->cidade}}</td>
                        <td>{{$locatario->contato->tel}}</td>
                        <td>
                            <a href="/contrato/add/{{$locatario->id}}"><button class="btn btn-warning">Contrato</button></a>
                            <!--<a href=""><button class="btn btn-secondary">Editar</button></a>-->
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>

    @endisset

    <hr>

    @if(isset($locatarios))

        <div class="table-responsive">
            <h5>Lista de Locatários</h5>
            <table class="table table-sm shadow-sm">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Rg</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Contato</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locatarios as $lt)

                    <tr>
                        <td>{{$lt->id}}</td>
                        <td>{{$lt->nome}}</td>
                        <td>{{$lt->cpf}}</td>
                        <td>{{$lt->email}}</td>
                        <td>{{$lt->rg}}</td>
                        <td>{{$lt->endereco->cidade}}</td>
                        <td>{{$lt->contato->tel}}</td>
                        <td>
                            <a href="/contrato/add/{{$lt->id}}"><button class="btn btn-warning">Contrato</button></a>
                            <!--<a href=""><button class="btn btn-secondary">Editar</button></a>-->
                        </td>


                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="jumbotron jumbotron-deshboard">
            <h5> Não existe locatários cadastrados</h5>
            <a href="/locatario/create" class="btn mb-3 btn-primary">Novo Locatário</a>
        </div>
    @endif

@endsection
