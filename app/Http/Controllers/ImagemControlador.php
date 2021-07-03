<?php

namespace App\Http\Controllers;

use App\Models\Imagem;
use App\Models\Imovel;
use Illuminate\Http\Request;

class ImagemControlador extends Controller
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

    public function add($id){
        $imovel = Imovel::findOrFail($id);
        $imagem = Imagem::all()->where('imovel_id', $imovel->id)
        ->sortByDesc('created_at');

        //$imagem = Imagem::table('imagens')->where('imovel_id', $imovel->id)->get();


        return view('imagem.create', ['imovel'=> $imovel, 'imagem'=>$imagem]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imovel = Imovel::findOrFail($request->id);
        $img = new Imagem();
        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();
            //$name = uniqid(date('HisYmd'));
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            //$imageName = "{$name}.{$extension}";

            $requestImage->move(public_path('img/imagem'), $imageName);
            $img->img = $imageName;

        }

        $img->nome = $request->nome;
        $img->imovel()->associate($imovel->id);

        $img->save();

        return back()->with('msg','Imagem adicionada com cucesso!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'ola';
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
