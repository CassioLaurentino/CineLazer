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
        $atracao = Atracoes::create($novo_atracao);   
        $this->storeCartaz($atracao);
        return redirect()->route('atracoes');
    }

    public function storeCartaz(Atracoes $atracao) {
        $cartaz = 'no_photo.png';

        if (request()->has('cartaz')) {
            $cartaz = request()->cartaz->store('cartazes', 'public');
        }

        $atracao->update([
            'cartaz' => $cartaz,
        ]);
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
        $atracao = Atracoes::find($id)->update($request->all());
        $this->storeCartaz($atracao);
        return redirect()->route('atracoes');    
    }
}
