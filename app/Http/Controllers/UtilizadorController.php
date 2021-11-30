<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Utilizador;
use Illuminate\Support\Facades\DB;
use App\http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UtilizadorController extends Controller
{
    public function listarutilizador(){
        $utilizadores = DB::table('users')          
                        ->select('id','name','email','tipo')
                        ->get();
        return view('auth.listarutilizador',compact('utilizadores'));
    }

    public function registarutilizador(Request $request){
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tipo' => ['required','integer','max:2'],
        ],[
            //Mensagens de validação de erros
            'nome.required'=>'O nome deve ser fornecido',
            'email.required'=>'O email deve ser fornecido',
            'email.email'=>'O email deve ser fornecido correctamente',

        ]);

        $utilizador = new Utilizador;
        $utilizador->name = $request->nome;
        $utilizador->email = $request->email;
        $utilizador->tipo = $request->tipo;
        $utilizador->password = Hash::make('gdwGDW');

        if($utilizador->save()){
            return back()->with('info','Inserido com sucesso');
        }
    }

    public function eliminarUtilizador($id){
        if(Utilizador::where('id', $id)->delete()){
            echo 'Eliminado com sucesso';
        }
    }

    public function editarutilizador(Request $request){
        if(DB::table('users')          
            ->where('id','=',$request->id)
            ->update(['name' => $request->nome,'email' => $request->email,'tipo' => $request->tipo])){
            return back()->with('info','Actualizado com sucesso');  
        } else {
            return back()->with('info','Erro ao actualizar');  
        }  
    }

    public function alterarSenhaUtilizador(Request $request){
        $validatedData = $request->validate([
            'senhaactual' => ['required', 'string','min:6'],
            'novasenha' => ['required', 'string','min:6'],
            'confirmasenha' => ['required', 'string','min:6','same:novasenha'],
        ],[
            //Mensagens de validação de erros
            'senhaactual.required'=>'A senha actual deve ser fornecida.',
            'novasenha.required'=>'A nova senha deve ser fornecida',
            'confirmasenha.required'=>'Este campo deve ser preenchido.',
            'senhaactual.min'=>'A senha deve possuir no mínimo 6 dígitos',
            'novasenha.min'=>'A senha deve possuir no mínimo 6 dígitos',
            'confirmasenha.min'=>'A senha de confirmação deve possuir no mínimo 6 dígitos',
            'confirmasenha.same'=>'As senhas fornecidas não coincidem, por favor forneça senhas iguais'
        ]);
        
        if (Hash::check($request->senhaactual,Auth::user()->password) && $request->novasenha == $request->confirmasenha) {
            if(DB::table('users')         
                ->where('id','=',Auth::user()->id)
                ->update(['password' => Hash::make($request->novasenha)]))
            {
                return back()->with('info','Alterado com sucesso');  
            }else{
                return back()->with('error','Erro ao alterar');  
            }
        }else{
            return back()->with('error','Erro ao alterar');  
        }
    }
}
