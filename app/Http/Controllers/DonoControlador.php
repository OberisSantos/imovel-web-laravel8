<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Dono;
use App\Models\Endereco;
use App\Models\User;
use Illuminate\Http\Request;

class DonoControlador extends Controller
{

    public function dashboard(){

        $user = auth()->user();
        return view('proprietario.dashboard', ['user'=>$user]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //tela home
    {
      return view('web-site.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //usado para chamar o formulário de criar
    {
        return view('proprietario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//inserir valor no banco de dados
    {   //1 - criar um endereco e salvar
        $end = new Endereco();
        $end->rua = $request->rua;
        $end->bairro = $request->bairro;
        $end->numero = $request->numero;
        $end->cep = $request->cep;
        $end->cidade = $request->cidade;
        $end->uf = $request->uf;

        $end->save();

        //1 - cverificar se possuir perfil se não possuir criar um
        //$perfil = Perfil::where('perfil','2')->exists(); //retorna false ou true
        //$perfil = Perfil::where('perfil','2')->get(); //retorna o valor se encontrar
        /*$perfil = new Perfil();
        if($perfil->perfil_exists('1')){
            $perfil->perfil = '1';
            $perfil->descricao = 'Proprietario';
            $perfil->save();

        }
        $perfil = Perfil::where('perfil','1')->get();
        foreach ($perfil as $key) {
            $perfil_id = ($key->id);
        }*/

        $tel = new Contato();
        $tel->tel = $request->tel;
        $tel->tipo = $request->tipo;

        $tel->save();


        //3 - criar um proprietário(Dono) com os dados de endereco e perfil
        $prop = new Dono();
        $prop->nome = $request->nome;
        $prop->cpf = $request->cpf;
        $prop->rg = $request->rg;
        $prop->email = $request->email;
        $prop->endereco()->associate($end->id);
        //$prop->perfil()->associate($perfil_id);
        $prop ->contato()->associate($tel->id);

        $user = auth()->user();

        $prop->user_id = $user->id;

        $prop->save();

        // $end->Dono()->associate($prop->id);

        //$end->save();


        return redirect ('prop/create')->with('msg','Proprietário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //busca com base em um atributo
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//chamado qunado pretende editar algum valor
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//passa o valor editado
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
