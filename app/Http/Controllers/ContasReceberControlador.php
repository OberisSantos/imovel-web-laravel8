<?php

namespace App\Http\Controllers;

use App\Models\ContasReceber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContasReceberControlador extends Controller
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
        return view('financas.createreceber');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $dono = $user->dono;

        if ($id != null && $id != "{}") {
            $contas = ContasReceber::where('contrato_id', $id)->get();
            if($contas != null){
                //if($user->dono->id == $contas->dono_id){
                $contas  = DB::table('locatarios')
                    ->join('contratos', 'locatario_id', '=', 'locatarios.id')
                    ->join('contasareceber', 'contrato_id', '=', 'contratos.id')
                    ->where('contrato_id', $id)
                    ->where('locatarios.dono_id', $dono->id)
                    ->get();
                return view('financas.show', ['contas'=> $contas]);
                //}
            }
        }
        $contas_ag  = DB::table('locatarios')
                    ->join('contratos', 'locatario_id', '=', 'locatarios.id')
                    ->join('contasareceber', 'contrato_id', '=', 'contratos.id')
                    ->where('locatarios.dono_id', $dono->id)
                    ->get();


        return view('financas.show', ['contas'=>$contas_ag]);
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
    public function update(Request $request, $id = null)
    {
        if($id == null){
            $idConta = $request->idConta;
        }else{
            $idConta = $id;
        }
        $conta = ContasReceber::find($idConta);

        if($conta != null){
            $dados = [
                'status'=>'pago',
                'valor_recebido'=> $request->valorRecebido,
                'pagamento'=>$request->dataPagamento
            ];

            $conta->update($dados);

            return back()->with('msg','Status alterado com suesso!')->withInput();
        }
        return back()->with('msg','Não foi possível alterar!')->withInput();
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
