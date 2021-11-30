<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Assento;
use App\Model\Convidado;
use App\Model\Acompanhante;
use Validator;


class AssentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function inserirAssento(Request $request){
        $this->validate($request,[
            'tipo'=>'required',
            'designacao'=>'required',
            'idEvento'=>'required',
        ]);
 
        $assento = new Assento;
        $assento->id_evento = $request->idEvento;
        $assento->tipo = $request->tipo;
        $id=$request->idEvento;
        if($request->tipo=='Cadeira'){
            $assento->capacidade = 1;
        }else{
            $assento->capacidade = $request->capacidade;
        }
        $assento->designacao = strtoupper($request->designacao);

        //Verificar se um assento ja existe na BD
        $designacao = DB::table('assento')
            ->where('designacao',$request->designacao)
            ->where('id_evento',$request->idEvento)
            ->exists();
        if($designacao==1){
            return redirect()->action(
                'EventoController@ver', ['id' => $id]
            )->with('warning','UPS!!! Este assento já foi cadastrado, por favor escolha outra nomenclatura');
        } 

        $assento->save();
        
        return redirect()->action(
            'EventoController@ver', ['id' => $id]
        )->with('info','Inserido com sucesso');
    }

    public function eliminar($id,$id1) {
        Assento::where('id', $id)->delete();
        
        return redirect()->action(
            'EventoController@ver', ['id' => $id1]
        )->with('info','Eliminado com sucesso');
    }

    public function ver($id,$id_Evento,$entidade){
        $pasta=$entidade."_".$id_Evento;
        $assento = Assento::find($id);
        $cont_convidado = Convidado::where('id_assento', $id)->count();
        $cont_acompanhante = count(DB::select('select * from acompanhante ac,convidado c where c.id=ac.id_convidado AND c.id_assento = :id_assento',['id_assento' => $id]));
        $cont_elementos_mesa = $cont_convidado+$cont_acompanhante;
        return view('verassento',compact('assento','cont_elementos_mesa','pasta'));
    }

    public function editarAssento(Request $request){
        if(DB::table('assento')          
            ->where('id','=',$request->id_assento)
            ->update(['designacao' => $request->designacao])){
            return back()->with('info','Actualizado com sucesso');  
        } else {
            return back()->with('info','Erro ao actualizar');  
        } 
    }
}
