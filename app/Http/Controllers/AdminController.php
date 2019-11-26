<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function relatorios() {
        return view('admin.relatorios');
    }

}