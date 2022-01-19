<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Lista;
use Illuminate\Http\Request;

class ListaFechadaController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }
    
    public function listaFechada()
    {
        $user = Auth()->user() ; //Pega os dados do Usuario logado

        $listasAntigas = Lista::where('requisitante', $user->id)->where('status', 'Cancelado')->orwhere('requisitante', $user->id)->where('status', 'Comprado')->with('itens')->get()->take(30)->sortByDesc('id');

        return view('sistema.listasAnteriores.index', 
                    ['user' => $user ,
                     'listasAntigas' => $listasAntigas, ]);
    }
}
