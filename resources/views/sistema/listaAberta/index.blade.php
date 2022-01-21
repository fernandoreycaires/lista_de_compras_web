@extends('sistema/layout/index')

@section('conteudo')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <form action="{{route("novaLista")}} " method="get">
                <button type="submit" class="btn btn-sm btn-rounded btn-primary"><i class="icon-plus menu-icon"></i> Adicionar Nova Lista </button>
            </form>
        </div>
    </div>
    <hr>

    @foreach ($listasAbertas as $listaAberta)
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4># {{$listaAberta->id}} </h4>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn mb-1 btn-sm btn-rounded btn-primary float-right" data-toggle="modal" data-target="#addItem{{$listaAberta->id}}"><i class="icon-plus menu-icon"></i> Adicionar item</button>
                                <button type="button" class="btn mb-1 btn-sm btn-rounded btn-danger float-right" data-toggle="modal" data-target="#cancelList{{$listaAberta->id}}"><i class="icon-plus menu-icon"></i> Cancelar Lista</button>
                                <button type="button" class="btn mb-1 btn-sm btn-rounded btn-success float-right" data-toggle="modal" data-target="#finalizarList{{$listaAberta->id}}"><i class="icon-check menu-icon"></i> Finalizar Lista</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produto</th>
                                    <th>Status</th>
                                    <th>Qtd</th>
                                    <th>Unidade</th>
                                    <th>Valor Unitário</th>
                                    <th>Valor Total</th>
                                    <th>Disponivel</th>
                                    <th>Indisponivel</th>
                                    <th>Editar</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ; ?>
                                @foreach ($listaAberta->itens as $item)
                                <?php
                                $i++ ;

                                if ($item->status == "Não Avaliado"){
                                    $badge = 'badge-light';
                                    $style = 'none';
                                } else if ($item->status == "Indisponivel") {
                                    $badge = 'badge-danger';
                                    $style = 'background-color: rgba(252, 176, 146, 0.534)';
                                } else if ($item->status == "Disponivel") {
                                    $badge = 'badge-success';
                                    $style = 'background-color: rgba(172, 252, 152, 0.534)';
                                }
                                ?>
                                <tr style="{{$style}} ">
                                    <th>{{$i}} </th>
                                    <td>{{ $item->produto }}</td>
                                    <td><span class="badge {{$badge}} px-2">{{ $item->status }}</span></td>
                                    <td> {{ $item->quantidade }} </td>
                                    <td>{{ $item->unidade }}</td>
                                    <td>R$ {{ $item->valor }}</td>
                                    <td>R$ {{ $item->valor * $item->quantidade }}</td>
                                    <td>
                                        <form action="{{route('itemDisponivel',['item'=>$item->id])}} " method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-rounded btn-success">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('itemIndisponivel',['item'=>$item->id])}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-rounded btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-rounded btn-secondary" data-toggle="modal" data-target="#editItem{{$item->id}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <form action="{{route('itemDelete',['item'=>$item->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-rounded btn-warning">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                    <!-- Modal Editar Item-->
                                    <div class="modal fade" id="editItem{{$item->id}}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Visualizar e/ou Editar Item da lista #{{$listaAberta->id}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('itemEdit',['item'=>$item->id])}} " method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <p><input class="form-control form-control-lg input-rounded" name="produto" type="text" placeholder="Produto" value="{{ $item->produto }}" ></p>
                                                            <p><input class="form-control form-control-lg input-rounded" name="qtd" type="text" placeholder="Quantidade" value="{{ $item->quantidade }}"></p>
                                                            <p><input class="form-control form-control-lg input-rounded" name="und" type="text" placeholder="Unidade" value="{{ $item->unidade }}"></p>
                                                            <p><input class="form-control form-control-lg input-rounded" name="valor" type="number" step="any" placeholder="0,00" value="{{ $item->valor }}"></p>
                                                            <label>Observação:</label>
                                                            <textarea class="form-control h-150px" rows="4" id="comment" name="obs">{{ $item->observacao }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /# column -->
        
    </div>

    <!-- Modal Adicionar Item-->
    <div class="modal fade" id="addItem{{$listaAberta->id}}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Item na lista #{{$listaAberta->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{route('addItensLista')}}" method="get">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="idlista" value="{{$listaAberta->id}}">
                            <p><input class="form-control form-control-lg input-rounded" name="produto" type="text" placeholder="Produto" required></p>
                            <p><input class="form-control form-control-lg input-rounded" name="qtd" type="number" placeholder="Quantidade" required></p>
                            <p><input class="form-control form-control-lg input-rounded" name="und" type="text" placeholder="Unidade" required></p>
                            <label>Observação:</label>
                            <textarea class="form-control h-150px" rows="4" id="comment" name="obs"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Cancelar lista -->
    <div class="modal fade" id="cancelList{{$listaAberta->id}}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cancelar Lista</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{route('cancelLista',['lista' => $listaAberta->id])}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <h1>Deseja cancelar lista # {{$listaAberta->id}}</h1>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-danger">Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Finalizar lista -->
    <div class="modal fade" id="finalizarList{{$listaAberta->id}}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Finalizar Lista</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{route('finalizaLista',['lista' => $listaAberta->id])}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <h3>Deseja encerrar e fechar a lista # {{$listaAberta->id}}</h3>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-success">Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

</div>
<!-- #/ container -->

@endsection