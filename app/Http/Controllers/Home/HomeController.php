<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Lista;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth()->user() ; //Pega os dados do Usuario logado

        $listasAbertas = Lista::where('requisitante', $user->id)->where('status', 'Aberto')->with('itens')->get();
        $listasAntigas = Lista::where('requisitante', $user->id)->where('status', 'Cancelado')->orwhere('status', 'Comprado')->with('itens')->get()->sortByDesc('id');

        //dd($listasAntigas);

        return view('sistema.dashboard',
        [   'user' => $user,
            'listasAbertas' => $listasAbertas,
            'listasAntigas' => $listasAntigas,
        ]);
    }
}
