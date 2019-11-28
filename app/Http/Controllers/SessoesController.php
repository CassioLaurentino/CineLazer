<?php

namespace App\Http\Controllers;

use App\Sessoes;
use App\Salas;
use App\Reservas;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\SessoesRequest;

class SessoesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $sessoes = Sessoes::all();
        return view('sessoes.index', ['sessoes'=>$sessoes]);
    }

    public function create() {
        return view('sessoes.create');
    }

    public function store(SessoesRequest $request) {
        $novo_sessao = $request->all();

        $sala = Salas::find($novo_sessao["sala_id"]);
        $novo_sessao["numero_de_poltronas"] = array_fill(0, $sala->numero_de_poltronas+1, "");
        $novo_sessao["display"] = $novo_sessao["local"] . ' ' . $novo_sessao["data"] . ' ' . $novo_sessao["hora"];

    	Sessoes::create($novo_sessao);

        return redirect()->route('sessoes');
    }

    public function destroy($id) {
        try {
            Sessoes::find($id)->delete();
            $ret = array('status'=>'ok', 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit($id) {
        $sessoes = Sessoes::find($id);
        return view('sessoes.edit', compact('sessoes'));
    }
    
    public function update(SessoesRequest $request, $id) {
        $sessao = Sessoes::find($id);
        
        if (Reservas::where('sessao_id', $sessao->id)->get()->first() != null) {
            return array('status'=>'erro_data', 'msg'=>'Desculpe, mas já existem reservas para esta sessão. Portanto não se pode altera-la!');
        }
        
        $sessao->update($request->all());
        $sala = Salas::find($sessao->sala_id);
        $sessao->numero_de_poltronas = array_fill(0, $sala->numero_de_poltronas+1, "");
        $sessao->save();

        return redirect()->route('sessoes');    
    }

    public function find($id) {
        return Sessoes::find($id)->delete();
    }
}
