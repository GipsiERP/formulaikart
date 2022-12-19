<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TracksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->set = [
            "title"     => "Cadastro de Pistas / Kartodromo",
            "prefix"    => 'Tracks',
            "module"    => 'cpt',
         ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        //
        if($request->ajax()){                 

            $dados = \App\Models\Tracks::selectRaw("
                id, name, cidade, telefone, celular, email, status
                ")
                ->get();

            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
            
        } 

        $set = $this->set;
        $dados = [];
        
        return View($set['module'].".".$set['prefix'].'.index', compact('set', 'dados' ));
        
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
            "id"        => 'required',
            "name"      => 'required',
            "cidade"    => 'required',
            'telefone'  => 'required|telefone_com_ddd',
            'celular'   => 'required|celular_com_ddd',
            'email'     => 'required|email',
        ], [
            'id.required'       => 'Revise.',
            'name.required'     => 'Revise Nome da Pista / Kartodromo.',
            'telefone.required' => 'Revise Telefone do Kartodromo.',
            'celular.required'  => 'Revise Celular do Kartodromo.',
            'email.required'    => 'Revise Email do Kartodromo.',
        ]);

        $clear = array("(", ")", "-", ".", "-");
        $ret = \App\Models\Tracks::updateOrCreate([
                "id"   => $request->id,
            ],[
                'id'       => $request->id,
                'name'     => $request->name,
                'telefone' => str_replace($clear, "", $request->telefone),
                'celular'  => str_replace($clear, "", $request->celular),
                'email'    => $request->email,
            ]);
        
        if($ret) return response()->json(["Success"=>"Salvo com sucesso"],Response::HTTP_OK) ;

        return response()->json(['errors' => $ret], 422);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if($request->ajax()){                 
            $dados = \App\Models\Tracks::findOrFail($id);
            
            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
        }
        return abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->ajax()){                 
            $dados = \App\Models\Tracks::findOrFail($id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request, $id)
    {
        //
        if($request->ajax()){                 

            $dados = \App\Models\Tracks::findOrFail($id)->delete();            
            return response()->json(["data"=>$dados],Response::HTTP_OK) ;

        }
        return abort(403);  

    }
}
