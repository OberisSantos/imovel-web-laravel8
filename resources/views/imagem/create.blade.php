@extends('layouts.main')

@section('titulo', 'Novo Proprietário')

@section('conteudo')

    <div class="col-md-5 offset-md-3 shadow p-3 mb-6 rounded" id="form_prop" ><!--bg-white-->

        @if(session('msg'))
            <p>{{session('msg')}}</p>
        @endif

        <div class="titulo-form">
            <h3 >Adicionar imagens</h3>
        </div>

        <form action="/imagem" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row-col-12">
                <div class="form-group">
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
            </div>

            <div class="row-col-12">
                <div class="form-group">
                    @if(isset($imovel))
                        <input type="hidden" name="id" id="id" value="{{$imovel->id}}" class="form-control">

                    @endif

                </div>
            </div>

            <div class="row-col-12">
                <div class="form-group">
                    <label for="">Descrição</label>
                    <input type="text" name="nome" class="form-control">
                </div>
            </div>

            <div class="form-row text-right">
                <div class="col-12">
                    <button type="submit" id='salvar' class='btn btn-success btn-sm'>Salvar</button>
                    <a href="/imovel/{{$imovel->id}}"><button type="button" id='concluir' class='btn btn-danger btn-sm'>Concluir</button></a>
                </div>
            </div>

        </form>

        <div class="row" id="add-img">
            @if (isset($imagem))

                    @foreach ($imagem as $img)
                    <div class="col-sm-6">
                        <div class="card">
                            <a href=""><img class="card-img-top" src="/img/imagem/{{$img->img}}"alt="{$img->nome}"></a>
                            <div class="card-body">
                                <h5 class="card-title">{{$img->nome}}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach

            @endif

            @if (isset($imovel_img))
                <img src="/img/imovel/{{$imovel_img->img_perfil}}"alt="" class="img-fluid" width="150">
                <img src="/img/imagem/{{$imovel->imagem->img}}"alt="" class="img-fluid" width="150">
                <img src="/img/imagem/{{$img}}"alt="" class="img-fluid" width="150">
            @endif
        </div>
    </div>

@endsection



