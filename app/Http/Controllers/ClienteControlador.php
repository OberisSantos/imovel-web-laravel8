<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Dono;
use App\Models\Imovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteControlador extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imovel_id = $request->imovel;

        $imovel = Imovel::find($imovel_id);

        if($imovel){
            $cl = new Cliente();
            $cl->email = $request->email;
            $cl->nome = $request->nome;
            $cl->telefone = $request->telefone;
            $cl->imovel()->associate($imovel->id);

            $cl->save();

            return back()->with('msg','Aguarde que o proprietário vai entrar em contato')->withInput();
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=null)
    {
        $user = auth()->user();
        $ano_atual = Date('Y');
        $mes_atual = Date('m');

        if ($user->dono) {
            $dono = Dono::find($user->dono->id);

            $notific = DB::table('imoveis')
            ->join('clientes', 'imovel_id', '=', 'imoveis.id')
            ->where('imoveis.dono_id', $dono->id)
            ->get();

            return view('cliente.mensagens', ['mensagem'=>$notific]);
        }

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
