@extends('layouts.main')

@section('titulo', 'Editar Contrato')

@section('conteudo')

    <div class="col-md-6 offset-md-3 p-3 mb-5" id="form_prop" ><!--bg-white-->
        <div class="titulo-form">
            <h3 >Editar Contrato</h3>
        </div>


        <form action="/contrato/update/{{$contrato->id}}" method="post">
            @csrf
            @method('PUT')
            <hr>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="">Locatário:</label>
                        <select name="locatario_id" class="form-control" id="">
                            <option value={{$contrato->locatario->id}}>{{$contrato->locatario->nome}}</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="">Imóvel:</label>

                        <select name="imovel_id" id="" class="form-control">
                            @isset($imoveis)
                                @foreach ($imoveis as $imovel)
                                    <option value={{$imovel->id}} @if ($imovel->id == $contrato->imovel->id){selected;} @endif>
                                        Rua: {{$imovel->endereco->rua}} - Cidade: {{$imovel->endereco->cidade}} / {{$imovel->endereco->numero}}
                                    </option>
                                @endforeach
                            @endisset

                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="">Inicio do contrato</label>
                        <input type="date" class='form-control'  name='inicio' value=@isset($contrato->inicio)
                        {{$contrato->inicio->format('Y-m-d')}}
                        @endisset>
                    </div>
                    <div class="col">
                        <label for="">Fim do contrato</label>
                        <input type="date" class='form-control' name='fim' value=@isset($contrato->fim){{$contrato->fim->format('Y-m-d')}}@endisset>
                    </div>
                    <div class="col">
                        <label for="">Tipo</label>
                        <select name="tipo" id="" class="form-control">
                            <option value="Aluguel">Aluguel</option>
                        </select>
                    </div>

                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="">Valor mensal</label>
                        <input type="number" class='form-control' name='valor_mensal' require='true' value=@isset($contrato->valor_mensal){{$contrato->valor_mensal}}@endisset>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="">Dia pagamento</label>
                        <input type="number" class='form-control' max="31" min="1" name='dia_pagamento' placeholder='Ex.:15' require='true' value=@isset($contrato->dia_pagamento){{$contrato->dia_pagamento}}@endisset>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Situação</label>
                        <select name="situacao" id="" class="form-control">
                            <option value={{$contrato->situacao}} {selected;} >
                                {{$contrato->situacao}}
                            </option>
                            <option value="Aberto">Aberto</option>
                            <option value="Finalizado">Finalizado</option>
                            <option value="Pendente">Pendente</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row text-right">
                <div class="col-12">
                    <button type="submit" id='salvar' class='btn btn-success'>Salvar</button>
                </div>
             </div>

        </form>
    </div>
@endsection



