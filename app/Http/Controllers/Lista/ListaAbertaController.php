<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Lista;
use App\Models\ListaItem;
use Illuminate\Http\Request;

class ListaAbertaController extends Controller
{
    public function listaAberta()
    {
        $user = Auth()->user() ; //Pega os dados do Usuario logado

        $listasAbertas = Lista::where('status', 'Aberto')->where('requisitante', $user->id)->with('itens')->get();

        return view('sistema.listaAberta.index', ['user' => $user, 'listasAbertas' => $listasAbertas]);
    }

    public function novaLista()
    {
        $user = Auth()->user() ; //Pega os dados do Usuario logado

        $lista = new Lista();
        $lista->requisitante = $user->id;
        $lista->status = 'Aberto';
        $lista->save();

        return redirect()->route("listaAberta");
    }

    public function addItensLista(Request $request)
    {
        $listaItem = new ListaItem();
        $listaItem->lista = $request->idlista;
        $listaItem->produto = $request->produto;
        $listaItem->quantidade = $request->qtd;
        $listaItem->unidade = $request->und;
        $listaItem->status = 'Não Avaliado';
        $listaItem->observacao = $request->obs;
        $listaItem->save();

        return redirect()->route("listaAberta");
    }

    public function cancelLista(Lista $lista)
    {
        $lista->status = 'Cancelado';
        $lista->save();

        return redirect()->route("listaAberta");
    }

    public function finalizaLista(Lista $lista)
    {
        $lista->status = 'Comprado';
        $lista->save();

        return redirect()->route("listaAberta");
    }

    public function itemDisponivel(ListaItem $item)
    {
        $item->status = 'Disponivel';
        $item->save();

        return redirect()->route("listaAberta");
    }

    public function itemIndisponivel(ListaItem $item)
    {
        $item->status = 'Indisponivel';
        $item->save();

        return redirect()->route("listaAberta");
    }

    public function itemDelete(ListaItem $item)
    {
        $item->delete();

        return redirect()->route("listaAberta");
    }

    public function itemEdit(ListaItem $item, Request $request)
    {
        $item->produto = $request->produto;
        $item->quantidade = $request->qtd;
        $item->unidade = $request->und;
        $item->valor = $request->valor;
        $item->observacao = $request->obs;
        $item->save();

        return redirect()->route("listaAberta");
    }

}
