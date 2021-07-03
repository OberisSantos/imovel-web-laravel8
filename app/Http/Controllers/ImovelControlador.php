<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Imovel;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImovelControlador extends Controller
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
        $user = auth()->user();
        if($user->dono){
            return view('imovel.create');
        }

        return redirect('prop/create')->with('msg','Proprietário ainda não cadastrado');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //1 - criar um endereco
        $end = new Endereco();
        $end->rua = $request->rua;
        $end->numero = $request->numero;
        $end->bairro = $request->bairro;
        $end->cep = $request->cep;
        $end->cidade = $request->cidade;
        $end->uf = $request->uf;
        $end->latitude = $request->lat;
        $end->longitude = $request->long;
        $end->referencia = $request->referencia;

        $end->save();

        //2 - criar um imovel
        $imovel = new Imovel();
        $imovel->tipo = $request->tipo;
        $imovel->garagem = $request->garagem;
        if($request->garagem == 'sim'){
            $imovel->vagas_garagem = $request->vagas_garagem;
        }
        $imovel->qt_quartos = $request->qt_quartos;
        $imovel->qt_suite = $request->qt_suite;
        $imovel->valor = $request->valor;
        $imovel->status = 'Aguardando';//'Disponivel', 'Alugado', 'Aguardando'

          // Imagem Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();
            //$name = uniqid(date('HisYmd'));
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            //$imageName = "{$name}.{$extension}";

            $requestImage->move(public_path('img/imovel'), $imageName);

            $imovel->img_perfil = $imageName;

        }
        $imovel->endereco()->associate($end->id);
        $imovel->dono()->associate(1);//encontrar uma maneira de trazer o dono
        $imovel->save();
        return redirect("/imagem/add/$imovel->id")->with('msg', 'Imóvel cadastrado com sucesso!');

        //return view('proprietario.create', ['imovel'=> $imovel->id])->with('msg', 'Imovel foi salvo com sucesso!');
        //return redirect()->route('imagem/create/', ['imovel'=> $imovel->id])->with('msg', 'Imovel foi salvo com sucesso!');
        //return redirect('/imagem/add-img/2');

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
        $imovel = Imovel::findOrFail($id);


        //$image_path = app_path("img\imovel\\{$imovel->img_perfil}");
        $image_path = public_path()."\img\imovel\\".$imovel->img_perfil;

        var_dump($image_path);


        //app_path(img/imovel/{$imovel->img_perfil});
        echo($image_path);
        if ($image_path) {
            //File::delete($image_path);
            unlink($image_path);
        }
        $imovel->delete();

    }
}
