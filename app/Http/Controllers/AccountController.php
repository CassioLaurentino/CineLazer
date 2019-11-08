<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use Redirect;

use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use Intervention\Image\Facades\Image;

class AccountController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        return view('minha_conta.index', ['user'=>$user]);
    }

    public function edit() {
        $user = Auth::user();
        return view('minha_conta.edit', compact('user'));
    }

    public function changePasswordForm(){
        return view('auth.changepassword');
    }

    public function update(AccountRequest $request) {
        $user = Auth::user();
        
        if (request()->has('cpf')) {
            $cpf = preg_replace('/[^0-9]/is', '', $request->cpf);
            if ($this->validaCPF($cpf)) {
                try {
                    $user->cpf = $cpf;
                    $user->save();
                } catch (\Throwable $th) {
                    return Redirect::back()->withErrors('CPF informado já está em uso');
                }
            } else {
                return Redirect::back()->withErrors('CPF inválido');
            }
        }
        
        $user->update($request->all());
        $this->storeImage($user);
        return redirect()->route('profile');    
    }

    public function storeImage(User $user) {
        $profile_image = 'avatar.png';

        if (request()->has('profile_image')) {
            $profile_image = request()->profile_image->store('profile_image', 'public');
        } elseif ($user->profile_image != null) {
            return;
        }

        $user->update([
            'profile_image' => $profile_image,
        ]);

        $image = Image::make(public_path('storage/'. $user->profile_image))->fit(100, 100);
        $image->save();
    }
    //Função a seguir não é de minha autoria. segue link -> https://github.com/5balloons/change-password-laravel/blob/master/app/Http/Controllers/HomeController.php
    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Sua senha atual é diferente da senha que voçê inseriu. Por favor, tente novamente.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Nova senha não pode ser igual a senha atual. Por favor, escolha uma senha diferente.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Senha atualizada com sucesso!");
    }

    // Função a seguir não é de minha autoria. segue link -> https://gist.github.com/rafael-neri/ab3e58803a08cb4def059fce4e3c0e40
    public function validaCPF($cpf) {
 
        // Extrai somente os números
        // $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }

}
