<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Locatario;
use Illuminate\Http\Request;

class LocatarioControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Locatario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1 - criar um endereco e salvar
        $end = new Endereco();
        $end->rua = $request->rua;
        $end->bairro = $request->bairro;
        $end->numero = $request->numero;
        $end->cep = $request->cep;
        $end->cidade = $request->cidade;
        $end->uf = $request->uf;

        $end->save();

        //2 - cverificar se possuir perfil se não possuir criar um
        /*$perfil = new Perfil();
        if($perfil->perfil_exists('2')){
            $perfil->perfil = '2';
            $perfil->descricao = 'Locatario';
            $perfil->save();

        }
        $perfil = Perfil::where('perfil','2')->get();
        foreach ($perfil as $key) {
            $perfil_id = ($key->id);
        }*/

        //3 - criar um contato e salvar
        $tel = new Contato();
        $tel->tel = $request->tel;
        $tel->tipo = $request->tipo;
        $tel->save();

        //4 - criar um locatario com os dados de endereco e perfil
        $locatario = new Locatario();
        $locatario->nome = $request->nome;
        $locatario->cpf = $request->cpf;
        $locatario->rg = $request->rg;
        $locatario->email = $request->email;
        $locatario->endereco()->associate($end->id);
        //$locatario->perfil()->associate($perfil_id);
        $locatario ->contato()->associate($tel->id);
        $locatario->save();

        return redirect ("/locatario/list/$locatario->id")->with('msg','Locatário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function list($id = null)
    {
        //$locatarios = Locatario::all()->orderBy('created_at', 'desc')->paginate(10);
        $locatarios = Locatario::all()->sortByDesc('created_at');
        if(!count($locatarios) > 0){
            $locatarios = null;
        }
        $locatario = null;

        if($id !=null && $locatarios != null){
            foreach ($locatarios as $key) {
                if($key ->id == $id){
                    $locatario = $key;
                    break;
                }
            }

        }

       return view('Locatario.list', ['locatarios'=> $locatarios, 'locatario'=>$locatario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
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
