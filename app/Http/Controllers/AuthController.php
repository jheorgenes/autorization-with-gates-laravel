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
        // A forma correta de verificar a autorização
        if(Gate::allows('user_is_admin')){
            echo 'Bem-vindo, admin';
        } else {
            echo 'NOK.';
        }

        // // Outra forma correta de verificar a autorização
        // // O can método verifica se o usuário logado pode acessar a Gate especificada (que no caso é 'user_is_admin)
        // if(Auth::user()->can('user_is_admin')){
        //     echo 'Bem-vindo';
        //     return;
        // }

        // echo 'não autorizado';
    }

    public function onlyUsers()
    {
        // // A forma correta de verificar a autorização
        if(Gate::allows('user_is_user')){
            echo 'Bem vindo, user';
        } else {
            echo 'NOK.';
        }

        // if(Auth::user()->can('user_is_user')){
        //     //...
        // }

        // if(Auth::user()->cannot('user_is_admin')){
        //     //...
        // }
    }

    public function delete()
    {
        if(Auth::user()->can('user_can', 'delete')){
            echo 'Eliminado';
        } else {
            return;
        }
    }
}
