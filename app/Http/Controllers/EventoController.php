<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Model\Evento;
use App\Model\EstatisticaPresenca;
use Validator;
use Response;
use App\Model\Assento;
use App\Model\Convidado;
use App\Model\Acompanhante;
use App\Model\ConvidadoAPI;
use Illuminate\Support\Facades\Input;
use App\Http\Resources\Convidado as ConvidadoResource;
use App\http\Requests;
use PDF;

class EventoController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }
   
    public function index()
    {
        return view('home');
    }

    public function pegaEventos()
    {
        $eventos = Evento::all();
        return view('tableEvento',compact('eventos'));
    }

    public function gerarQRCODE($id,$nome,$pasta){    
        $novonome=Str_replace(' ','_',$nome);
		$novonome = $novonome.'_'.$id;
        $file=public_path('images/qrcodes/'.$pasta.'/'.$novonome.'.png');
        return \QRCode::text($id)->setOutfile($file)->setSize(5)->png();   
    }

    public function registarEvento(Request $request){
        /*$this->validate($request,[
            'tipo'=>'required',
            'entidade'=>'required',
            'local'=>'required',
            'data'=>'required',
            'hora'=>'required',
        ]);*/
	
		$idEvento = DB::table('evento')->insertGetId(
			['tipo' => $request->tipo, 'modalidade' => $request->modalidade, 'entidade' => $request->entidade, 'local' => $request->local, 'data' => $request->data, 'hora' => $request->hora]
		);
        
        if($idEvento > 0){
			$path = public_path().'/images/qrcodes/'.$request->entidade.'_'.$idEvento;
            File::makeDirectory($path,$mode=0777,true,true);
            $this->gerarQRCODE($idEvento,$request->entidade,'EventosQR');
				$info = 'Sucesso';
			
        }else{
            $info = 'Erro';
        }
        echo $info;
    }

    
    public function pegaEvento($id){
        echo json_encode(Evento::find($id));
    }

    //AJAX EDIT
    public function editarEvento(Request $request){
        $evento = Evento::find($request->id_evento);
        $evento->tipo = $request->tipo;
        $evento->entidade = $request->entidade;
        $evento->local = $request->local;
        $evento->data = $request->data;
        $evento->hora = $request->hora;
        if($evento->save()){
            $info = 'Sucesso';
        }else{
            $info = 'Erro';
        }
        echo $info;
    }

    //AJAX DELETE 
    public function eliminar($id) {
        Evento::where('id', $id)->delete();  
    }


    public function ver($id){
        $evento = Evento::find($id);
        return view('verevento',compact('evento'));
    }

    public function verConsumo($id){
        $evento = Evento::find($id);
        return view('verConsumo',compact('evento'));
    }

    public function verPDF($id){
        $evento = Evento::find($id)->get();dd($evento);
        $convidados = DB::select('select c.id,c.nome,a.designacao from convidado c,assento a where c.id_assento=a.id AND a.id_evento = :id_evento ORDER BY designacao',['id_evento' => $id]);
        $pdf = PDF::loadView('pdfevento',compact('evento','convidados'));
        return $pdf->setPaper('a4')->stream('pdfevento');
    }
	
	public function verDigitalConvite(){
		//return view('pdfDigital');
	    $pdf = PDF::loadView('pdfDigital');
        return $pdf->setPaper('a4')->stream('pdfDigital');
    }

    public function getEvento(){
        //$eventos = Evento::all();
        $eventos = DB::table('evento')->where('data','>=',date('Y-m-d',strtotime('today')))->get();
        return view('apipage',compact('eventos'));
    }

    public function verEventoAPI($id){
        $evento = Evento::find($id);
        
        if($evento->modalidade==1){
            $contConvidados = DB::table('evento')
                            ->join('assento','assento.id_evento','=','evento.id')
                            ->join('convidado','convidado.id_assento','=','assento.id')
                            ->where('evento.id','=',$id)
                            ->count('evento.entidade');
        }else if($evento->modalidade==2){
            $contConvidados = DB::table('convidado')->where('id_evento','=',$id)->count('nome');
        }
        return view('vereventoapi',compact('evento','contConvidados'));
    }

    //Popula a tabela ConvidadosAPI
    public function registarAPI(Request $request){
        $id = $request->id; //Id do evento lido
        $acomp=null;

        if($request->modalidade==1){
            $convidados = DB::select('select c.id,c.nome,a.designacao from convidado c,assento a where c.id_assento=a.id AND a.id_evento = :id_evento ORDER BY designacao',['id_evento' => $id]);	
            foreach($convidados as $convidado){            
                $acompanhantes = Acompanhante::where('id_convidado', '=',$convidado->id)->get();
                
                if(count($acompanhantes)>0){
                    foreach($acompanhantes as $acompanhante){
                        $acomp = $acomp.' | '.$acompanhante->nome;
                    }
                
                    $acomp[1]=" ";
                    $acomp = trim($acomp);
                    DB::insert('insert into convidadoapi (id,nome,assento,acompanhante,id_evento,estado) values (?, ?, ?, ?, ?,?)', [$convidado->id,$convidado->nome,$convidado->designacao,$acomp,$id,"Ausente"]);
                    $acomp=null;
                }else{
                    DB::insert('insert into convidadoapi (id,nome,assento,acompanhante,id_evento,estado) values (?, ?, ?, ?, ?,?)', [$convidado->id,$convidado->nome,$convidado->designacao,$acomp,$id,"Ausente"]);
                }
            }
        }else if($request->modalidade==2){
            $convidados = DB::table('convidado')->where('id_evento',$id)->get();
            //dd($convidados);
            foreach($convidados as $convidado){
                DB::insert('insert into convidadoapi (id,nome,assento,acompanhante,id_evento,estado) values (?, ?, ?, ?, ?,?)', [$convidado->id,$convidado->nome,'Sem Assento',null,$id,"Ausente"]);
            }
        }
        return back()->with('info','Inserido com sucesso');
    }
	
	public function apagarEventoAPI($id) {
        if(DB::table('convidadoapi')->where('id_evento', '=', $id)->delete()){
			return back()->with('info','Cancelado com sucesso');
        }
    }

    public function eventosdecorrer(){
        $eventos = DB::table('convidadoapi')
                ->distinct()
                ->join('evento', 'evento.id', '=', 'convidadoapi.id_evento')
                ->select('evento.id','convidadoapi.id_evento','evento.tipo','evento.entidade','evento.local','evento.data','evento.hora')
                ->where('evento.data','=',date('Y-m-d H:i:s',strtotime('today')))
                ->get();
 
        return view('eventosdecorrer',compact('eventos'));
    }

    public function contPessoas($convidados){
        $estatistica = new EstatisticaPresenca;
        foreach($convidados as $convidado){
            if($convidado->estado=='Presente'){
                $estatistica->presentes = ++$estatistica->presentes;
            }else{
                $estatistica->ausentes = ++$estatistica->ausentes;
            }  
        }
        return $estatistica;
    }

    public function vereventodecorrer($id){
        $convidados = DB::table('convidadoapi')
                ->select('id','nome','acompanhante','assento','estado','updated_at')
                ->where('id_evento','=',$id)
				->orderBy('nome')
                ->get();
        
        $estados = DB::table('convidadoapi')
                ->select(
                    DB::raw('estado as estado'),
                    DB::raw('count(*) as quantidade'))
                ->groupBy('estado')
                ->where('id_evento',$id)
                ->get();
        return view('vereventodecorrer',compact('convidados','estados'));
    }
	
	//Editar o estado do convidado da WEB API
    public function convidadoMudarEstadoAPI($idConvidado,$chegada){
		if(DB::table('convidadoapi')          
            ->where('id','=',$idConvidado)
            ->update(['estado' => 'Presente','updated_at' => $chegada])){
            $info = 'Sucesso';
        } else {
            $info = 'Erro';
        }  
        return ConvidadoResource::collection(ConvidadoAPI::where('id','=',$idConvidado)->get());
    }

    //Retorno da WEB API CONVIDADOS
    public function convidadosAPI($id){            
        return ConvidadoResource::collection(ConvidadoAPI::where('id_evento','=',$id)->orderBy('nome')->get());
    }

    //Retorno da WEB API EVENTO DECORRER
    public function verEventoDecorrerAPI($id){  
		$ev = Evento::select('id','tipo','entidade','local','data','hora')->where('id','=',$id)->get();
        //return ConvidadoResource::collection($ev);
		echo $ev[0];
    }
    
    //Retorno da WEB API ASSENTOS DO EVENTO DECORRER
    public function verAssentoDecorrerAPI($id){           
        return ConvidadoResource::collection(Assento::where('id_evento','=',$id)->select('id','designacao','capacidade')->orderBy('designacao')->get());
    }
	
	//Retorno da WEB API Estatistica de pessoas no evento
	public function estatisticaConvidadosAPI($idEvento){    
        $estados = DB::table('convidadoapi')
                ->select(
                    DB::raw('estado as estado'),
                    DB::raw('count(*) as quantidade'))
                ->groupBy('estado')
                ->where('id_evento',$idEvento)
                ->get();
        echo $estados;
    }

}
