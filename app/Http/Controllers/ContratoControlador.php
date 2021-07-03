<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Imovel;
use App\Models\Locatario;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;

class ContratoControlador extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**$table->foreignId('locatario_id')
            ->constrained()
            ->onDelete('cascade');
            $table->foreignId('imoveis_id')
            ->constrained()
            ->onDelete('cascade');

            $table->date('inicio')->nullable();
            $table->date('fim')->nullable();
            $table->enum('tipo',['Aluguel']);
            $table->double('valor_mensal', 6, 2);
            $table->integer('dia_pagamento');
            $table->enum('situacao', ['Aberto', 'Finalizado', 'Pendente']);
        */
        $locatario = Locatario::find($request->locatario);
        $imovel = Imovel::find($request->imovel);

        echo($imovel);

        if($locatario != null && $imovel != null){
            $contrato = new Contrato();
            $contrato->locatario()->associate($locatario->id);
            $contrato->imovel()->associate($imovel->id);

            $contrato->inicio = $request->inicio;
            $contrato->fim = $request->fim;
            $contrato->tipo = $request->tipo;
            $contrato->valor_mensal = $request->valor_mensal;
            $contrato->dia_pagamento = $request->dia_pagamento;
            $contrato->situacao = 'Pendente';

            $contrato->save();

            var_dump($contrato);

           return redirect ("/contrato/$contrato->id")->with('msg','Contrato cadastrado, aguardando confirmação!');
        }

        //$img->imovel()->associate($imovel->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato = Contrato::find($id);
        if($contrato != null){
            return view('contrato.list', ['contrato'=>$contrato]);
        }
        return view('contrato.list',['contrato'=>$contrato])->with('msg', 'Nenhum contrato localizado');
    }

    public function add($id)
    {
        $locatario = Locatario::find($id);
        if($locatario != null){
            $imoveis = Imovel::all()->where('status', 'Disponivel');
            return view('contrato.create', ['locatario'=> $locatario, 'imoveis'=>$imoveis]);
        }
        return redirect("locatario/list/$id")->with('msg', 'O locatário não foi localizado!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contrato = Contrato::findOrFail($id);
        $imoveis = Imovel::all()->where('dono_id', $contrato->imovel->dono->id);
        return view('contrato.edit', ['contrato'=> $contrato, 'imoveis'=>$imoveis]);
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
        $contrato = $request->all();

        Contrato::findOrFail($id)->update($contrato);

        return redirect("/contrato/$id");

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
