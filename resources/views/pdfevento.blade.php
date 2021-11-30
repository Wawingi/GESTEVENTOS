<!DOCTYPE html>
<html>
    <head>
        <title>GESTEVENTO</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    </head>
    <body style="background:white">
        <div class="container-fluid">
               
                <div style="height:115px;border:solid 1px black" class="card-box widget-user">    
                    <div class="row">
                        <div class="col-6">
                            <h3 style="font-size:16px">Entidade</h3>
                            <h3 style="font-size:16px">Local</h3>
                            <h3 style="font-size:16px">Tipo</h3>
                            <h3 style="font-size:16px">Data</h3>
                            <h3 style="font-size:16px">Hora</h3>
                        </div>
                        <div class="col-6">
                            <h3 style="font-size:15px;margin-left:150px">: <?php echo $evento[0]->entidade ?></h3>
                            <h3 style="font-size:15px;margin-left:150px">: <?php echo $evento[0]->local ?></h3>
                            <h3 style="font-size:15px;margin-left:150px">: <?php echo $evento[0]->tipo ?></h3>
                            <h3 style="font-size:15px;margin-left:150px">: <?php echo $evento[0]->data ?></h3>
                            <h3 style="font-size:15px;margin-left:150px">: <?php echo $evento[0]->hora ?></h3>
                        </div>
                    </div>
                </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    
                    <table style="font-size:15px;font-family:times new roman" class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Assento</th>
                                <th scope="col">Acompanhante(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($convidados as $convidado)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$convidado->nome}}</td>
                                <td>{{$convidado->designacao}}</td>
                                <td>
                                    <?php 
                                        $acompanhantes = App\Model\Acompanhante::where('id_convidado', '=',$convidado->id)->get(); 
                                        foreach($acompanhantes as $acompanhante):
                                    ?>
                                        <li>{{ $acompanhante->nome }}</li>
                                    <?php endforeach ?> 
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>