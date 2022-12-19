<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChampionshipsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->set = [
            "title"     => "Cadastro de Pistas / Kartodromo",
            "prefix"    => 'Championships',
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

            $dados = \App\Models\Championships::selectRaw("
                id, name, status
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
            'id'        => 'required',
            'name'      => 'required',
        ], [
            'id.required'       => 'Revise.',
            'name.required'     => 'Revise apelido do Piloto.',
        ]);

        $clear = array("(", ")", "-", ".", "-");
        $ret = \App\Models\Championships::updateOrCreate([
                "id"   => $request->id,
            ],[
                'id'       => $request->id,
                'name'     => $request->name,
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
            $dados = \App\Models\Championships::findOrFail($id);
            
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
            $dados = \App\Models\Championships::findOrFail($id);
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

            $dados = \App\Models\Championships::findOrFail($id)->delete();            
            
            return response()->json(["data"=>$dados],Response::HTTP_OK) ;

        }
        return abort(403);  

    }

}
