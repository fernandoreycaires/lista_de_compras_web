@extends('sistema/layout/index')

@section('conteudo')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
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
                                    <th>Data</th>
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
                                        <td><button type="button" class="btn btn-sm btn-rounded btn-primary" data-toggle="modal" data-target="#visualizarLista{{$listaAntiga->id}}"><i class="fa fa-eye"></i></button></td>
                                    </tr>

                                    <!-- Modal Listar itens-->
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
                                    <!-- ./ Modal Listar itens-->

                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>

</div>
<!-- #/ container -->

@endsection