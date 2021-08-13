@extends('web-site.main')

@section('titulo', 'Pagina inicial')

@section('conteudo')
    <div class="shadow p-3 mb-5 bg-white rounded container">

        @if (@count($imoveis) > 0)
            <div style="width: 100%; display: flex; justify-content: center;">
                <div class="row row-cols-1 row-cols-md-3 card-img">
                    @foreach ($imoveis as $imovel)
                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="/img/imovel/{{$imovel->img_perfil}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{$imovel->tipo}} para Aluguel</h5>
                                    <p class="card-text"><span class="material-icons">
                                        room
                                        </span>{{$imovel->endereco->cidade}}-{{$imovel->endereco->uf}}, {{$imovel->endereco->bairro}}, {{$imovel->endereco->rua}}</p>
                                    <p class="card-text">{{$imovel->qt_quartos}} Quartos | {{$imovel->qt_suite}} Suíte</p>

                                    <hr style="margin-top: 2px; margin-bottom: 2px ">

                                    <p class="card-text" style="font-size: 1.2rem; font-weight: bold">R$ {{number_format($imovel->valor, 2)}}</p>
                                </div>
                                <div class="card-footer bg-transparent border-secondary" >
                                    <a href="/imovel/detalhe/{{$imovel->id}}">
                                        <span class="material-icons">visibility</span> Mais detalhes

                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @else
            <div class="jumbotron text-center">
                <p>Não foi localizado nenhum imóvel</p>
            </div>
        @endif

    </div>


@endsection


