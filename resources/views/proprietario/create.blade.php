@extends('layouts.main')

@section('titulo', 'Novo Proprietário')

@section('conteudo')

    <div class="col-md-6 offset-md-3 p-3 mb-5" id="form_prop" ><!--bg-white-->




        <div class="titulo-form">
            <h3 >Novo Proprietário</h3>
        </div>


        <form action="/proprietario" method="post">
            @csrf
            <hr>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-8">
                        <label for="">Nome:</label>
                        <input type="text" class='form-control' name='nome' placeholder='Nome e Sobrenome' require='true'>
                    </div>
                    <div class="col-4">
                        <label for="">CPF:</label>
                        <input type="text" class='form-control' name='cpf', placeholder='000.000.000-00' require='true'>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-4">
                        <label for="">RG:</label>
                        <input type="text" class='form-control' name='rg', placeholder='Ex.: 0000000'>
                    </div>
                    <div class="col-8">
                        <label for="">E-mail:</label>
                        <input type="email" class='form-control' name='email' placeholder='exemplo@exemplo.com' require='true'>
                    </div>
                </div>
            </div>

            <hr>
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
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Bairro:</label>
                        <input type="text" class='form-control' name="bairro" placeholder='Ex.:Centro' require='true'>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">CEP:</label>
                        <input type="text" class='form-control' name="cep" placeholder='00000-000' require='true'>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">Cidade</label>
                        <input type="text" class='form-control' name="cidade" placeholder='Cidade' require='true'>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="">UF</label>
                        <select name="uf" class='form-control' require='true'>
                            <option value="pi">PI</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="Telefone:">Telefone</label>
                        <input type="text" name='tel' class='form-control' placeholder='(xx) x xxxx-xxxx' require>
                    </div>
                </div>

                <div class="col-6">
                <label class="form-check" for="">Tipo:</label>
                        <div class="form-check-inline">
                            <label class='form-check-label' ><input type="radio" name='tipo' value='cel' class='form-check-input'> Celular</label>
                        </div>
                        <div class="form-check-inline">
                            <label class='form-check-label' ><input type="radio" name='tipo' value='zap' class='form-check-input' checked> Zap</label>
                        </div>
                        <div class="form-check-inline">
                            <label class='form-check-label' ><input type="radio" name='tipo' value='fixo' class='form-check-input'> Fixo</label>
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



