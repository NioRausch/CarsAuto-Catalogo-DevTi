<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;


class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("carro.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carro = new Carro;

        if ($request->image != null) {

            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);

            $imageName = time() . '.' . $request->image->extension();

            // Public Folder
            $request->image->move(public_path('images'), $imageName);
            $carro->img_path = $imageName;
        }

        $carro->nome = $request->nome;
        $carro->modelo = $request->modelo;
        $carro->ano = $request->ano;
        $carro->ano_modelo = $request->ano_modelo;
        $carro->km = $request->km;
        $carro->cambio = $request->cambio;
        $carro->combustivel = $request->combustivel;
        $carro->cor = $request->cor;
        $carro->preco = $request->preco;
        $carro->descricao = "";

        $carro->save();

        return view("home");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carro = Carro::where('id', $id)->first();
        if ($carro != null)
            return view('carro.show', ["carro" => $carro]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carro = Carro::where('id', $id)->first();
        if ($carro != null)
            return view('carro.edit', ["carro" => $carro]);
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
        $carro = Carro::find($id);

        if ($request->image != null) {

            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);

            $imageName = time() . '.' . $request->image->extension();

            // Public Folder
            $request->image->move(public_path('images'), $imageName);
            $carro->img_path = $imageName;
        }

        $carro->img_path = $carro->img_path;

        $carro->nome = $request->nome;
        $carro->modelo = $request->modelo;
        $carro->ano = $request->ano;
        $carro->ano_modelo = $request->ano_modelo;
        $carro->km = $request->km;
        $carro->cambio = $request->cambio;
        $carro->combustivel = $request->combustivel;
        $carro->cor = $request->cor;
        $carro->preco = $request->preco;
        $carro->descricao = "";

        $carro->save();

        return view("home");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carro = Carro::find($id);

        $carro->delete();
        return "Done delete";
    }
}
