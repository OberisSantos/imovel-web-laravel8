<?php

namespace App\Http\Controllers;

use App\Models\ContasReceber;
use App\Models\Contato;
use App\Models\Contrato;
use App\Models\Dono;
use App\Models\Endereco;
use App\Models\Imovel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonoControlador extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //tela home
    {
        $user = auth()->user();
        $ano_atual = Date('Y');
        $mes_atual = Date('m');

        if ($user->dono) {
            $dono = Dono::find($user->dono->id);
           // $contratos = Imovel::join('imoveis', 'dono_id',"=", $dono->id)->select('contratos->imovel_id', 'imoveis->id')->get();
           // $contas = ContasReceber::table('contasareceber');
           // $imoveis = Imovel::all()->where('dono_id',$user->dono->id);
            $contratos = DB::table('locatarios')
                        ->join('contratos', "locatario_id", "=", "locatarios.id")
                        ->select("contratos.id", "contratos.inicio", "contratos.fim", "contratos.valor_mensal", "contratos.dia_pagamento", "contratos.situacao", "contratos.created_at", "locatarios.nome")
                        ->where("locatarios.dono_id", $dono->id)
                        -> get();

            /*$contas = DB::table('locatarios')
                        ->join('contratos', 'locatario_id', '=', 'locatarios.id')
                        ->join('contasareceber', 'contrato_id', '=', 'contratos.id')
                        ->where('locatarios.dono_id', $dono->id)
                        ->get();
            */
            $contas_pg = DB::table('locatarios')
                        ->join('contratos', 'locatario_id', '=', 'locatarios.id')
                        ->join('contasareceber', 'contrato_id', '=', 'contratos.id')
                        ->where('locatarios.dono_id', $dono->id)
                        ->where('status', 'pago')
                        ->get();

            $contas_ag  = DB::table('locatarios')
                    ->join('contratos', 'locatario_id', '=', 'locatarios.id')
                    ->join('contasareceber', 'contrato_id', '=', 'contratos.id')
                    ->where('locatarios.dono_id', $dono->id)
                    ->where('status', 'aguardando')
                    ->whereYear('vencimento', '<=', $ano_atual)
                    ->whereMonth('vencimento', '<=', $mes_atual)
                    ->get();


            //dd($contas_ag);
            // $contratos = Contrato::all()->where('locatario_id',$user->dono->locatario->id);
            //echo($user->dono->locatario->id);
            //$locatarios = $dono->locatario->all();

            //$contratos = $locatarios->contrato->all();
            //foreach ($locatarios as $l) {
                //dd($l->contato->id);

            //}

            return view('proprietario.dashboard', ['user'=>$user, 'dono'=>$dono, 'contratos'=>$contratos, 'contas_pg'=>$contas_pg, 'contas_ag'=>$contas_ag]);
        }


        return view('proprietario.dashboard', ['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //usado para chamar o formulário de criar
    {
        $user = auth()->user();

        //if(!Dono::where('user_id', $user->id)->count()>0){
        if (!$user->dono){
            return view('proprietario.create');
        }
        return redirect("/proprietario/$user->dono()->id");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//inserir valor no banco de dados
    {
        $user = auth()->user();

        if(!Dono::where('user_id', $user->id)->count()>0){
            //1 - criar um endereco e salvar
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

            $prop->user_id = $user->id;

            $prop->save();

            // $end->Dono()->associate($prop->id);

            //$end->save();

            return redirect ('prop/create')->with('msg','Proprietário cadastrado com sucesso!');
        }
        return redirect("/proprietario/$user->dono()->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //busca com base em um atributo
    {
        $user = auth()->user();

        //if(Dono::where('user_id', $user->id)->count()>0){
        if($user->dono){
            $dono = Dono::find($user->id);
            $imoveis = Imovel::all()->where('dono_id', $dono->id);


            return view('proprietario.show', ['dono'=>$dono, 'imoveis'=>$imoveis]);
        }
        return redirect('/dashboard')->with('msg', 'Usuário ainda não está cadastrado como proprietário de imóveis!');
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
