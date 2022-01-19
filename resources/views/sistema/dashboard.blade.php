@extends('sistema/layout/index')

@section('conteudo')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <form action="{{route("novaLista")}} " method="get">
                <button type="submit" class="btn btn-sm btn-rounded btn-primary"><i class="fa fa-shopping-cart"></i> Adicionar Nova Lista </button>
            </form>
        </div>
    </div>
    <hr>
    
    <div class="row">
        <div class="col-lg-6">
            @foreach ($listasAbertas as $listaAberta)

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
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ; ?>
                                @foreach ($listaAberta->itens as $item)
                                <?php 
                                $i++;

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
                                <tr style="{{$style}}">
                                    <th>{{ $i }} </th>
                                    <td>{{ $item->produto }}</td>
                                    <td><span class="badge {{$badge}} px-2">{{ $item->status }}</span></td>
                                    <td>{{ $item->quantidade }} </td>
                                    <td>{{ $item->unidade }} </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
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
                                    <p><input class="form-control form-control-lg input-rounded" name="qtd" type="text" placeholder="Quantidade" required></p>
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

            @endforeach

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

        </div>
        <!-- /# column -->

        <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Listas Anteriores</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Status</th>
                                        <th>Data Modificação</th>
                                        <th>Valor</th>
                                        <th>Visualizar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listasAntigas as $listaAntiga)
                                        <?php 
                                            if ($listaAntiga->status == "Cancelado") {
                                                $badge = 'badge-danger';
                                            } else if ($listaAntiga->status == "Comprado") {
                                                $badge = 'badge-success';
                                            }
                                        ?>
                                        <tr>
                                            <th>{{$listaAntiga->id}} </th>
                                            <td><span class="badge {{$badge}} px-2">{{$listaAntiga->status}}</span></td>
                                            <td>{{$listaAntiga->updated_at}} </td>
                                            <td>R$ {{$listaAntiga->valor}} </td>
                                            <td><button type="button" class="btn btn-sm btn-rounded btn-primary" data-toggle="modal" data-target="#visualizarLista{{$listaAntiga->id}}"><i class="fa fa-edit"></i></button></td>
                                        </tr>

                                            <!-- Modal Visualiza Itens-->
                                            <div class="modal fade" id="visualizarLista{{$listaAntiga->id}}">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Lista # {{$listaAntiga->id}} </h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php $i=0;?>
                                                            @foreach ($listaAntiga->itens as $item)
                                                            <?php 
                                                                $i++;

                                                                if ($item->status == "Não Avaliado"){
                                                                    $badge = 'badge-light';
                                                                } else if ($item->status == "Indisponivel") {
                                                                    $badge = 'badge-danger';
                                                                } else if ($item->status == "Disponivel") {
                                                                    $badge = 'badge-success';
                                                                }
                                                            ?>
                                                                <p>{{ $i }} :
                                                                <span class="badge {{$badge}} px-2">{{ $item->status }}</span>
                                                                {{ $item->produto }},
                                                                {{ $item->quantidade }} 
                                                                {{ $item->unidade }},
                                                                {{ $item->observacao }}
                                                                </p>
                                                                <hr>
                                                            @endforeach
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./ Modal Visualiza Itens-->

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /# column -->
    
    </div>
    <!-- /# row -->


</div>
<!-- #/ container -->

@endsection