<?php

namespace App\Http\Controllers;

use \App\Models\Banks;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BanksController extends Controller
{
    public function __construct()
    {

        //
        $this->middleware('auth');

        $this->set = [
            "title"         => "Cadastro de Bancos",
            "prefix"        => 'Banks',
            "module"        => 'cpt',
         ];


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
             
            $dados = \App\Models\Banks::select('id', 'name', 'agencia', 'conta', 'contato_name','contato_telefone', 'contato_celular',
            'contato_email', 'codigo', 'status')            
            ->get();
            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
            
        } 

        $set = $this->set;
        return View($set['module'].".".$set['prefix'].'.index', compact('set' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            "id"                => 'required',
            "name"              => 'required',
            "agencia"           => 'required',
            "conta"             => 'required',
            "codigo"            => 'required',
            "contato_name"      => 'required',
            "contato_telefone"  => 'required|telefone_com_ddd',
            "contato_celular"   => 'required|celular_com_ddd',
            "contato_email"     => 'required|email',
            "bank_principal"    => 'required|boolean',
        ], [
            'id.required'        => 'Revise.',
            'name.required'      => 'Revise do banco.',
            'agencia.required'   => 'Revise a agência.',
            'conta.required'     => 'Revise a conta.',
            'codigo.required'    => 'Revise a código do banco.',
            'contato_nome.required'     => 'Revise o nome do gerente.',
            'contato_telefone.required' => 'Revise o telefone do gerente.',
            'contato_celular.required'  => 'Revise o celular do gerente.',
            'contato_email.required'    => 'Revise o email do gerente',
            'bank_principal.required'   => 'Revise o banco principal.',
        ]);

        $clear = array("(", ")", "-", ".", "-");

        $ret = \App\Models\Banks::updateOrCreate([
                "id"   => $request->id,
            ],[
                "id"                => $request->id,
                "name"              => $request->name,
                "agencia"           => $request->agencia,
                "conta"             => $request->conta,
                "codigo"            => $request->codigo,
                "contato_name"      => $request->contato_name,
                "contato_telefone"  => str_replace($clear, "", $request->contato_telefone ),
                "contato_celular"   => str_replace($clear, "", $request->contato_celular ),
                "contato_email"     => $request->contato_email,
                "bank_principal"    => $request->bank_principal,
            ]);
        
        if($ret) return response()->json(["Success"=>"Salvo com sucesso"],Response::HTTP_OK) ;

        return response()->json(['errors' => $ret], 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request, $id )
    {
        //
        if($request->ajax()){                 
            $dados = \App\Models\Banks::findOrFail($id);
            
            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
        }
        return abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        return abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->ajax()){                 
            $dados = \App\Models\Banks::findOrFail($id);
            $upt = $dados->update(
                    ["status"=> $dados->status ?  false : true]
                );
            
            return response()->json(["Success"=>"Alterado status com sucesso."],Response::HTTP_OK) ;
        }
        return abort(403);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->ajax()){                 

            $dados = \App\Models\Banks::findOrFail($id)->delete();            
            return response()->json(["Success"=>"Registro apagado"],Response::HTTP_OK) ;

        }
        return abort(403);  
    }
}
