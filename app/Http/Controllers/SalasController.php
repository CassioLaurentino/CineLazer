<?php

namespace App\Http\Controllers;

use App\Salas;

use Illuminate\Http\Request;
use App\Http\Requests\SalasRequest;

class SalasController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $salas = Salas::all();
        return view('salas.index', ['salas'=>$salas]);
    }

    public function create() {
        return view('salas.create');
    }

    public function store(SalasRequest $request) {
        $novo_sala = $request->all();
        $novo_sala['numero_de_poltronas'] = $novo_sala['colunas'] * $novo_sala['fileiras'];
    	Salas::create($novo_sala);
    	
        return redirect()->route('salas');
    }

    public function destroy($id) {
        try {
            Salas::find($id)->delete();
            $ret = array('status'=>'ok', 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit($id) {
        $sala = Salas::find($id);
        return view('salas.edit', compact('sala'));
    }

    public function update(SalasRequest $request, $id) {
        $novo_sala = $request->all();
        $novo_sala['numero_de_poltronas'] = $novo_sala['colunas'] * $novo_sala['fileiras'];
        Salas::find($id)->update($novo_sala);
        return redirect()->route('salas');    
    }
}
