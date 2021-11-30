<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Convidado;
use File;

class ConvidadoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function gerarQRCODE($id,$nome,$pasta){  
        $novonome=Str_replace(' ','_',$nome);
		
		$novonome = $novonome.'_'.$id;
		
        $file=public_path('images/qrcodes/'.$pasta.'/'.$novonome.'.png');
        return \QRCode::text($id)->setOutfile($file)->setSize(5)->png();   
    }
    
    public function inserirConvidado(Request $request){
        $this->validate($request,[
            'nome'=>'required',
            'idAssento'=>'required',
        ]);
        
        $acompanhantes = $request->nome_acompanhante;
               
        $idConvidado = DB::table('convidado')->insertGetId(
            ['nome' => $request->nome,'genero'=>$request->genero,'estado'=>'Ausente','id_assento'=> $request->idAssento,'id_evento'=>null]
        );
		
        //Chamar o método que gerá o QR do convidado inserido
        $this->gerarQRCODE($idConvidado,$request->nome,$request->pasta);

        //entrar neste método se o convidado possuir acompanhante
        if($idConvidado>0 && $acompanhantes[0]!=null){
            for($cont=0;$cont<count($acompanhantes);$cont++){
                DB::table('acompanhante')->insert(
                    ['nome' => $acompanhantes[$cont], 'id_convidado' => $idConvidado]
                );
            }
			return back()->with('info','Inserido com sucesso');
            //Chamar o método que gerá o QR do convidado inserido
            //$this->gerarQRCODE($idConvidado,$request->nome);
        }
		return back()->with('info','Inserido com sucesso');
    }

	public function gerarQRCodeRandomico($pasta,$novonome,$idConvidado){  		
        $file=public_path('images/qrcodes/'.$pasta.'/'.$novonome.'.png');
        return \QRCode::text($idConvidado)->setOutfile($file)->setSize(5)->png();   
    }
	
	public function gerarConvite(Request $request){
		$entidade = $request->entidade;
		$id_evento = $request->id_evento;
		$quantidade = $request->quantidade;
		$pasta = $entidade.'_'.$id_evento;
		//dd($pasta);
		//Conta os convites já gerados
		$cont = DB::table('convidado')->where('id_evento',$id_evento)->count('id');
		
		if($quantidade<=20){
			for($i=1;$i<=$quantidade;$i++){
				++$cont;
				$novonome = $entidade.'_'.$id_evento.'_'.$cont;
				$idConvidado = DB::table('convidado')->insertGetId(
					['nome' => $novonome, 'genero' => 'U', 'estado' => 'Ausente', 'id_assento' => null, 'id_evento' => $id_evento]
				);
				$this->gerarQRCodeRandomico($pasta,$novonome,$idConvidado);	
			}
			echo 'Sucesso';
		}else{
			echo 'Houve um erro ao Gerar';
		}
    }
	
	public function pegaConvitesGerados($id,$entidade){
		$convidados = DB::table('convidado')
                ->select('id','nome')
                ->where('id_evento',$id)
                ->get();
				//list($pasta,$id) = explode("_",$convidados[0]->nome);
				$pasta=$entidade.'_'.$id;
		return view('tableConvitesGerados',compact('convidados','pasta'));
	}
	
    public function verQRCODE($nome,$id,$pasta){
        $novonome=Str_replace(' ','_',$nome);
		$novonome = $novonome.'_'.$id;
        return view('verqrcode',compact('novonome','pasta'));
    }
	
	public function eliminar($nome,$id,$pasta){
		$novonome=Str_replace(' ','_',$nome);
		$novonome = $novonome.'_'.$id;
		$path = public_path('images/qrcodes/'.$pasta.'/'.$novonome.'.png');
		
		if(DB::table('convidado')->where('id',$id)->delete()){
			if(File::exists($path)){
				File::delete($path);
				echo 'Sucesso';
			}
		}else{
			echo 'Error';
		}
	}
   
}