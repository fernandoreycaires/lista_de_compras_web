<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Lista;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }
    
    public function home()
    {
        $user = Auth()->user() ; //Pega os dados do Usuario logado

        $listasAbertas = Lista::where('requisitante', $user->id)->where('status', 'Aberto')->with('itens')->get();
        $listasAntigas = Lista::where('requisitante', $user->id)->where('status', 'Cancelado')->orwhere('requisitante', $user->id)->where('status', 'Comprado')->with('itens')->get()->take(30)->sortByDesc('id');

        //dd($listasAntigas);

        return view('sistema.dashboard',
        [   'user' => $user,
            'listasAbertas' => $listasAbertas,
            'listasAntigas' => $listasAntigas,
        ]);
    }
}
