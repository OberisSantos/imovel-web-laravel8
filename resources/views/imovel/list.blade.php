@extends('layouts.main')

@section('titulo', 'Imoveis')

@section('conteudo')

    <div class="col-md-7 offset-md-3">
        @isset($imoveis)
            <h5>Lista de imóveis</h5>
            @foreach ($imoveis as $imovel)

                <div class="card mb-3" style="max-width: 720px;">
                    <div class="row no-gutters">
                        <div class="col-md-5">
                            <a href=""><img class="img-fluid float-center" src="/img/imovel/{{$imovel->img_perfil}}" alt=""  height="auto" max-width="100%"></a>
                            <p class="card-text ml-1"><small class="text-muted">Data cadastro: {{$imovel->created_at}}</small></p>
                        </div>
                        <div class="col-md ml-2">
                            <div class="card-body">
                                <h5 class="card-title">{{$imovel->tipo}}</h5>
                                <p class="card-text">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tr>
                                                <th>ID</th>
                                                <th>Garagem</th>
                                                <th>Quartos</th>
                                                <th>Suítes</th>
                                                <th>Valor</th>
                                                <th>Status</th>
                                            </tr>
                                            <tr>
                                                <td>{{$imovel->id}}</td>
                                                <td>
                                                    @if ($imovel->garagem == "sim")
                                                        {{$imovel->vagas_garagem}}
                                                    @endif
                                                </td>
                                                <td>{{$imovel->qt_quartos}}</td>
                                                <td>{{$imovel->qt_suite}}</td>
                                                <td>{{$imovel->valor}}</td>
                                                <td>
                                                    <a href="/imovel/edit/{{$imovel->id}}">
                                                        @switch($imovel->status)
                                                            @case("Aguardando")
                                                                <span class="badge badge-warning">{{$imovel->status}}</span>

                                                                @break
                                                            @case("Alugado")
                                                                <span class="badge badge-primary">{{$imovel->status}}</span>

                                                                @break

                                                            @default
                                                            @case("Disponivel")
                                                                <span class="badge badge-success">{{$imovel->status}}</span>

                                                                @break

                                                        @endswitch
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </p>

                                <span class="card-text">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tr>
                                                <td>Rua</td>
                                                <td>Nº</td>
                                                <td>Bairro</td>
                                                <td>Cep</td>
                                                <td>Cidade</td>
                                                <td>UF</td>
                                                <td>Lat</td>
                                                <td>Lon</td>
                                            </tr>
                                            <tr>
                                                <td>{{$imovel->endereco->rua}}</td>
                                                <td>{{$imovel->endereco->numero}}</td>
                                                <td>{{$imovel->endereco->bairro}}</td>
                                                <td>{{$imovel->endereco->cep}}</td>
                                                <td>{{$imovel->endereco->cidade}}</td>
                                                <td>{{$imovel->endereco->uf}}</td>
                                                <td>{{$imovel->endereco->latitude}}</td>
                                                <td>{{$imovel->endereco->longitude}}</td>

                                            </tr>
                                        </table>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters m-2">
                        <a href="" title="Apagar" class="btn btn-danger btn-sm mr-2">
                            <span class="material-icons">delete</span>
                        </a>
                        <a href="/imovel/edit/{{$imovel->id}}"  title="Editar" class="btn btn-secondary btn-sm mr-2">
                            <span class="material-icons">edit</span>
                        </a>

                        <a href="/imovel/{{$imovel->id}}"  title="Detalhes" class="btn btn-warning btn-sm mr-2">
                            <span class="material-icons">infor</span>
                        </a>
                    </div>
                </div>
            @endforeach

        @endisset
    </div>
@endsection
