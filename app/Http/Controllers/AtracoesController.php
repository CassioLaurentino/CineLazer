<?php

namespace App\Http\Controllers;

use App\Atracoes;

use Illuminate\Http\Request;
use App\Http\Requests\AtracoesRequest;
use Intervention\Image\Facades\Image;

class AtracoesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
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
        } elseif ($atracao->cartaz != null) {
            return;
        }

        $atracao->update([
            'cartaz' => $cartaz,
        ]);

        $image = Image::make(public_path('storage/'. $atracao->cartaz))->fit(500, 500);
        $image->save();
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
        $atracao = Atracoes::find($id);
        $atracao->update($request->all());
        $this->storeCartaz($atracao);
        return redirect()->route('atracoes');    
    }
}
