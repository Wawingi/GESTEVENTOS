<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Consumo;
use Illuminate\Support\Facades\DB;

class ConsumoController extends Controller
{
    public function inserirProduto(Request $request){
        $info=null;
        $consumo = new Consumo;
        $consumo->designacao = $request->designacao;
        $consumo->categoria = $request->categoria;
        $consumo->quantidade_registada = $request->quantidade;
        $consumo->quantidade_consumida = 0;
        $consumo->id_evento = $request->idEvento;
        
        if($consumo->save()){
            $info='Sucesso';
        }else{
            $info='Erro';
        }
        echo $info;
    }

    public function pegaConsumos($idEvento)
    {
        $consumos = DB::table('consumo')->where('id_evento',$idEvento)->orderBy('categoria')->get();
        return view('tableConsumo',compact('consumos'));
    }

    public function eliminarConsumo($id){
        if(Consumo::where('id', $id)->delete()){
            echo 'Sucesso';
        }else{
            echo 'Error';
        }
    }
}
