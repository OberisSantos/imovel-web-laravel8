@extends('web-site.main')

@section('titulo', 'Detalhe do imóvel')

@section('conteudo')
    <div class="shadow p-3 mb-5 bg-white rounded container">
        <div class="row">
            <div class="col-9 imovel-show" >
                @isset($imovel)
                    <h5>Mais detalhes</h5>
                    <div class="card mb-3" style="max-width: 900px;">
                        <div class="row no-gutters">
                            <div class="col-md-5">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-12">
                                            <div id="imagem" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">

                                                    @foreach ($imovel->imagem as $imagem)
                                                        <div class="carousel-item @if($loop->first) active @endif">
                                                            <img height="250px" class="d-block w-100 myImg" src="/img/imagem/{{$imagem->img}}" alt={{$imagem->nome}} >
                                                            <div class="carousel-caption d-none d-md-block">
                                                                <h5>{{$imagem->nome}}</h5>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                </div>
                                                <a class="carousel-control-prev" href="#imagem" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Anterior</span>
                                                </a>
                                                <a class="carousel-control-next" href="#imagem" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Próximo</span>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md ml-2">
                                <div class="card-body">
                                    <h5 class="card-title">{{$imovel->tipo}} | Aluguel</h5>
                                    <hr>
                                    <p class="card-text" style="font-size: 1.2rem; font-weight: bold">R$ {{$imovel->valor}}</p>
                                    <hr>
                                    <p class="card-text"><span class="material-icons">
                                        room
                                        </span>
                                        {{$imovel->endereco->cidade}}-{{$imovel->endereco->uf}}, {{$imovel->endereco->bairro}}, {{$imovel->endereco->rua}}, {{$imovel->endereco->numero}}
                                    </p>
                                    <hr>
                                    <p class="card-text">{{$imovel->qt_quartos}} Quartos | {{$imovel->qt_suite}} Suíte | Possui garagem: {{$imovel->garagem}}</p>

                                    <p class="card-text">O imóvel está {{$imovel->status}}</p>

                                </div>
                            </div>
                        </div>

                    </div>

                    <!--Carrocel para imagens do imovel-->
                    @isset($imovel->imagem)

                        <div class="row row-cols-1 row-cols-md-3" >
                            @foreach ($imovel->imagem as $imagem)

                                <div class="col mb-4">
                                    <div class="card" style="margin: 0 auto;">
                                        <img id="" src="/img/imagem/{{$imagem->img}}" height="200px" alt={{$imagem->nome}}  class="card-img-top myImg" >
                                        <div class="card-body">
                                        <small class="card-title">{{$imagem->nome}}</small>

                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                    @endisset

                @endisset
            </div> <!--Fim da col imovel-show-->

            <div class="col-3">

                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Entrar em contato</div>
                    <form action="/mensagem" method="post">
                        @csrf
                        <div class="card-body">

                                <div class="form-group ">
                                  <label >E-mail</label>
                                  <input type="email" name="email" class="form-control form-control-sm" placeholder="Informar seu e-mail">
                                </div>
                                <div class="form-group">
                                  <label>Nome</label>
                                  <input type="text" name="nome" class="form-control form-control-sm"  placeholder="Informar seu nome">
                                </div>
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" name="telefone" id="tel" class="form-control form-control-sm" placeholder="Telefone para contato">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="imovel" value="{{$imovel->id}}" class="form-control form-control-sm">
                                </div>


                            <button class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                  </div>
            </div>

        </div>

    </div>

@endsection
