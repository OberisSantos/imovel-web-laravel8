@extends('layouts.main')

@section('titulo', 'Novo Contrato')

@section('conteudo')

    <div class="col-md-6 offset-md-3 p-3 mb-5" id="form_prop" ><!--bg-white-->
        <div class="titulo-form">
            <h3 >Novo Contrato</h3>
        </div>


        <form action="/contrato" method="post">
            @csrf
            <hr>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="">Locatário:</label>
                        <select name="locatario" class="form-control" id="">
                            <option value={{$locatario->id}}>{{$locatario->nome}}</option>
                        </select>


                    </div>
                    <div class="col-6">
                        <label for="">Imóvel:</label>
                        <select name="imovel" id="imovel" class="form-control">
                            @isset($imoveis)
                                @foreach ($imoveis as $imovel)
                                    <option value={{$imovel->id}}>
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
                        <input type="date" class='form-control' name='inicio'>
                    </div>
                    <div class="col">
                        <label for="">Fim do contrato</label>
                        <input type="date" class='form-control' name='fim' >
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
                        <input type="number" class='form-control' name='valor_mensal' require='true'>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="">Dia pagamento</label>
                        <input type="number" class='form-control' max="31" min="1" name='dia_pagamento' placeholder='Ex.:15' require='true'>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Situação</label>
                        <select name="situacao" id="" class="form-control">
                            <option value="Aberto">Aberto</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row text-right">
                <div class="col-12">
                    <button type="submit" id='salvar' id='salvar' class='btn btn-success'>Salvar</button>
                </div>
             </div>

        </form>
    </div>
@endsection



