<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    public function login(): RedirectResponse
    {
        $user = User::find(1);
        // Usando o Auth (Fascade) eu estou usando o sistema de login gerado automaticamente pelo Laravel
        Auth::login($user);
        return redirect()->route('home');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function onlyAdmins()
    {
        // // A forma incorreta de verificar a autorização
        // if(Auth::user()->role !== 'admin'){
        //     echo 'User não é admin.';
        // } else {
        //     echo 'Bem-vindo';
        // }

        // // A forma correta de verificar a autorização
        // if(Gate::allows('user_is_admin')){
        //     echo 'Bem-vindo';
        // } else {
        //     echo 'User não é admin.';
        // }

        // Outra forma correta de verificar a autorização
        // O can método verifica se o usuário logado pode acessar a Gate especificada (que no caso é 'user_is_admin)
        if(Auth::user()->can('user_is_admin')){
            echo 'Bem-vindo';
            return;
        }

        echo 'não autorizado';
    }

    public function onlyUsers()
    {
        // // A forma correta de verificar a autorização
        // if(Gate::allows('user_is_user')){
        //     echo 'User é um usuário normal.';
        // } else {
        //     echo 'User é um usuário Admin';
        // }

        // // Método denies do gate é uma negativa
        // if(Gate::denies('user_is_admin')){
        //     echo 'Usuario logado é user';
        // } else {
        //     echo 'User é um admin';
        // }

        if(Auth::user()->can('user_is_user')){
            //...
        }

        if(Auth::user()->cannot('user_is_admin')){
            //...
        }
    }
}
