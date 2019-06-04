<?php

namespace App\Http\Controllers;

use App\Atracoes;

use Illuminate\Http\Request;
use App\Http\Requests\AtracoesRequest;

class AtracoesController extends Controller
{
    public function index() {
        $atracoes = Atracoes::all();
        return view('atracoes.index', ['atracoes'=>$atracoes]);
    }

    public function create() {
        return view('atracoes.create');
    }

    public function store(AtracoesRequest $request) {
    	$novo_atracao = $request->all();
    	Atracoes::create($novo_atracao);

        return redirect()->route('atracoes');
    }

    public function destroy($id) {
        Atracoes::find($id)->delete();
        return redirect()->route('atracoes');
    }

    public function edit($id) {
        $atracoes = Atracoes::find($id);
        return view('atracoes.edit', compact('atracoes'));
    }

    public function update(AtracoesRequest $request, $id) {
        Atracoes::find($id)->update($request->all());
        return redirect()->route('atracoes');    
    }
}
