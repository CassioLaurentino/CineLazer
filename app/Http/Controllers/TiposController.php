<?php

namespace App\Http\Controllers;

use App\Tipos;

use Illuminate\Http\Request;
use App\Http\Requests\TiposRequest;

class TiposController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $tipos = Tipos::all();
        return view('tipos.index', ['tipos'=>$tipos]);
    }

    public function create() {
        return view('tipos.create');
    }

    public function store(TiposRequest $request) {
    	$novo_tipo = $request->all();
    	Tipos::create($novo_tipo);
    	
        return redirect()->route('tipos');
    }

    public function destroy($id) {
        try {
            Tipos::find($id)->delete();
            $ret = array('status'=>'ok', 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit($id) {
        $tipo = Tipos::find($id);
        return view('tipos.edit', compact('tipo'));
    }

    public function update(TiposRequest $request, $id) {
        Tipos::find($id)->update($request->all());
        return redirect()->route('tipos');    
    }
}
