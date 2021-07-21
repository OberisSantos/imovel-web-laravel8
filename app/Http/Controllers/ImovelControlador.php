<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Endereco;
use App\Models\Imagem;
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
        return view('web-site.index');
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
        //$data=$request->validate([
            //'qt_quartos'=>'required']);
            //'qt_quartos' => 'required|min:5|max:64',


        $data = $request->validate([
            'qt_quartos' => 'required|unique:imoveis,qt_quartos',
            'qt_suite' => 'required',
            ], [
            'qt_quartos.required' => 'Este campo é obrigatório',
            'qt_quartos.unique' => 'Ja existe esse valor',
            'qt_suite.required' => 'Informar a quantidade',
            ]);

        $user = auth()->user();
        if($user->dono){
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
            $imovel->dono()->associate($user->dono->id);//encontrar uma maneira de trazer o dono
            $imovel->save();
            return redirect("/imagem/add/$imovel->id")->with('msg', 'Imóvel cadastrado com sucesso!');
        }

        return redirect('/prop/create');


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
        $user = auth()->user();
        $imovel = Imovel::find($id);
        if($imovel != null){
            if($user->dono->id == $imovel->dono_id){
                return view('imovel.show', ['imovel'=> $imovel]);
            }
        }
        return redirect('/dashboard');
    }

    public function list()
    {
        $user = auth()->user();
        if($user->dono){
            $imoveis = Imovel::all()->where('dono_id', $user->dono->id)->sortByDesc('created_at');

            return view('imovel.list', ['imoveis'=> $imoveis]);
        }
        //return view('imovel.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $imovel = Imovel::find($id);

        return view('imovel.edit', ['imovel'=> $imovel]);
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
        $imovel = [
            'status' => $request->status,

        ];

        $contas = Contrato::verificarContas($id);

        if ($contas) {
            Imovel::findOrFail($id)->update($imovel);

            return redirect("/imovel/$id")->with('msg', 'O imóvel foi editado com sucesso!');
        }
        return redirect("/contrato/$id");
    }

    public function up($id){
        $contas = Contrato::verificarContas($id);

        if ($contas) {
            Imovel::find($id)->update(['status'=>"Disponivel"]);
            return redirect("/imovel/$id");
        }
        //Imovel::find($id)->update(['status'=>"Disponivel"]);
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
