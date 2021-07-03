@extends('layouts.main')

@section('titulo', 'Novo imovel')

@section('conteudo')
    <div class="col-md-6 offset-md-3 p-3 mb-5" id="form_prop" ><!--bg-white-->
        <div class="titulo-form">
            <h3 >Novo Imóvel</h3>
        </div>
        <form action="/imovel" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="">Escolher uma imagem para o imóvel</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <hr>
            <div class="form-row">
                <div class="col-4">
                    <span>Garagem:</span>
                    <div class="form-check-inline">
                        <label class='form-check-label' ><input type="radio" name='garagem' value='sim' class='form-check-input'>Sim</label>
                    </div>
                    <div class="form-check-inline">
                        <label class='form-check-label' ><input type="radio" name='garagem' value='nao' class='form-check-input' checked>Não</label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <input type="text" class='form-control' name='vagas_garagem' placeholder='Nº vagas'>
                    </div>
                </div>
                <div class="col text-right">
                        <div class="form-check-inline">
                            <label class='form-check-label' ><input type="radio" name='tipo' value='Apartamento' class='form-check-input'>Ap</label>
                        </div>
                        <div class="form-check-inline">
                            <label class='form-check-label' ><input type="radio" name='tipo' value='Casa' class='form-check-input' checked>Casa</label>
                        </div>
                        <div class="form-check-inline">
                            <label class='form-check-label' ><input type="radio" name='tipo' value='Quitinete' class='form-check-input'>Kitnet</label>
                        </div>

                </div>
            </div>

            <div class="form-row">
                <div class="col-6">
                    <div class="form-row">
                        <div class="form-group col-sm">
                            <label for="">Quartos</label>
                            <input type="text" class="form-control" name="qt_quartos" placeholder="nº de quartos">
                        </div>
                        <div class="form-group col-sm">
                            <label for="">Suítes</label>
                            <input type="text" class="form-control" name="qt_suite" placeholder="nº de suítes">
                        </div>
                    </div>
                </div>
                <div class="col-2">

                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Valor mensal(R$)</label>
                        <input type="text" name="valor" class="form-control" placeholder="R$">
                    </div>
                </div>
            </div>


            <div class="form-row">
                <div class="col-9">
                    <div class="form-group">
                        <label for="">Rua:</label>
                        <input type="text" class='form-control' name='rua' placeholder='Nome da rua' require='true'>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="">Número:</label>
                        <input type="text" class='form-control' name='numero' placeholder='Ex: 00' require='true'>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Bairro:</label>
                        <input type="text" class='form-control' name="bairro" placeholder='Ex.: Centro' require='true'>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">CEP:</label>
                        <input type="text" class='form-control' name="cep" placeholder='00000-000' require='true'>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">Cidade</label>
                        <input type="text" class='form-control' name="cidade" placeholder='Cidade' require='true'>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="">UF</label>
                        <select name="uf" class='form-control' require='true'>
                            <option value="pi">PI</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-8">
                    <div class="form-group">
                        <label for="">Ponto de referência do imóvel</label>
                        <textarea class="form-control" rows="5" id="referencia" name="referencia"></textarea>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control" name="lat">

                        <label for="">Longitude</label>
                        <input type="text" class="form-control" name="long">
                    </div>

                </div>
            </div>

            <div class="form-row text-right">
                <div class="col-12">
                    <button type="submit" id='salvar' class='btn btn-success'>Salvar</button>
                </div>
             </div>

        </form>

        <!--

        <form action="/imovel/4" method="post">
            @csrf
            @method('DELETE')

            <button type="submit">Deletar</button>
        </form>

    -->


    </div>

@endsection
