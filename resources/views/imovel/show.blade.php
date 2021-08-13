@extends('layouts.main')

@section('titulo', 'Imoveis')

@section('conteudo')

    <div class="col-md-7 offset-md-3">
        @isset($imovel)
            <h5>Detalhe do imóvel</h5>
            <div class="card mb-3" style="max-width: 900px;">
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
                                                <a href="#" data-toggle="modal" data-target="#statusModal">
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
                                        </tr>
                                        <tr>
                                            <td>{{$imovel->endereco->rua}}</td>
                                            <td>{{$imovel->endereco->numero}}</td>
                                            <td>{{$imovel->endereco->bairro}}</td>
                                            <td>{{$imovel->endereco->cep}}</td>
                                            <td>{{$imovel->endereco->cidade}}</td>
                                            <td>{{$imovel->endereco->uf}}</td>

                                        </tr>
                                    </table>
                                </div>

                            </span>
                        </div>
                    </div>

                </div>
                <div class="row no-gutters m-1">
                    <button type="button" title="Apagar" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#delimovel">
                        <span class="material-icons">delete</span>
                    </button>


                    <!--<a href="/imovel/edit/{{$imovel->id}}"  title="Editar" class="btn btn-secondary btn-sm mr-2">
                        <span class="material-icons">edit</span>
                    </a>-->
                </div>
            </div>

            <!--Carrocel para imagens do imovel-->
            @isset($imovel->imagem)
                <div class="card mb-3" style="max-width: 720px;">
                    <div class="row no-gutters">
                        <div class="col-md-8">
                            <div id="imovel-imagens" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">

                                    @foreach ($imovel->imagem as $imagem)
                                        <div class="carousel-item @if($loop->first) active @endif">
                                            <img class="d-block w-100" src="/img/imagem/{{$imagem->img}}" alt={{$imagem->nome}}>
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>{{$imagem->nome}}</h5>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                                <a class="carousel-control-prev" href="#imovel-imagens" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#imovel-imagens" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Próximo</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md ml-2">
                            <div class="card-body">
                                <a href="/imagem/add/{{$imovel->id}}" class="btn btn-warning btn-block" role="button">Adicionar imagens</a>
                            </div>
                        </div>
                    </div>
                </div>

            @endisset

            <!--Aqui vai o modal para alterar status /imovel/edit/{{$imovel->id}}-->
            <div class="modal fade" id="statusModal">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Alterar Status</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <form action="/imovel/update/{{$imovel->id}}" method="post">
                        <div class="modal-body">
                            <label>Status</label>
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-control" id="">

                                <option value={{$imovel->status}} @if ($imovel->status== $imovel->status){selected;} @endif>{{$imovel->status}}</option>

                                <option value="Aguardando">Aguardando</option>
                                <option value="Disponivel">Disponivel</option>
                                <option value="Alugado">Alugado</option>
                            </select>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" title="Alterar" class="btn btn-warning ml-2">Alterar</button>

                        </div>
                    </form>

                  </div>
                </div>
            </div>


        @endisset

        <!-- Modal para confirmar o delete-->
        <div class="modal fade" id="delimovel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">O imóvel será deletado. Confirmar?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                </div>
                <div class="modal-body">
                ID: {{$imovel->id}}
                </div>
                <div class="modal-footer">
                    <form action="/imovel/destroy/{{$imovel->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                        <button type="submit" title="Confirmar" class="btn btn-danger">Confirmar</button>

                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
