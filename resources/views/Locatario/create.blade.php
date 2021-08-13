@extends('layouts.main')

@section('titulo', 'Novo Locatário')

@section('conteudo')

    <div class="col" id="form_prop"  style="padding-left: 70px;  padding-right: 70px" ><!--bg-white-->
        <div class="titulo-form">
            <h3 >Novo Locatário</h3>
        </div>


        <form action="/locatario" method="post">
            @csrf
            <hr>

            <div class="form-group">
                <div class="row">
                    <div class="col-8">
                        <label for="">Nome:</label>
                        <input type="text" class='form-control' name='nome' placeholder='Nome e Sobrenome' require='true'>
                    </div>
                    <div class="col-4">
                        <label for="">CPF:</label>
                        <input type="text" class='form-control' id='cpf' name='cpf', placeholder='000.000.000-00' require='true'>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
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
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Rua:</label>
                        <input type="text" class='form-control' name='rua' placeholder='Nome da rua' require='true'>
                    </div>
                </div>

                <div class="col-2">
                    <div class="form-group">
                        <label for="">Número:</label>
                        <input type="text" class='form-control' id='numero' name='numero' placeholder='Ex: 00' require='true'>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">Bairro:</label>
                        <input type="text" class='form-control' name="bairro" placeholder='Ex.:Centro' require='true'>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">CEP:</label>
                        <input type="text" class='form-control' id='cep' name="cep" placeholder='00000-000' require='true'>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Cidade</label>
                        <input type="text" class='form-control' id='cidade' name="cidade" placeholder='Cidade' require='true'>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">UF</label>
                        <select id="uf" name="uf" class='form-control'>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="Telefone:">Telefone</label>
                        <input type="text" name='tel' class='form-control' id='tel' placeholder='(xx) x xxxx-xxxx' require>
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



