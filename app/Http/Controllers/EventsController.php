<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->set = [
            "title"     => "Cadastro de Etapa/Corrida",
            "prefix"    => 'Events',
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

            $dados = \App\Models\Events::selectRaw("
                events.id, events.name, events.horario, 
                DATE_FORMAT(events.data, '%d-%m-%Y') as data, 
                FORMAT(events.fee_value, 2,'de_DE') as fee_value, 
                events.track_id, events.status,
                tracks.name as track_name
                ")
                ->join("tracks","events.track_id","=","tracks.id")
                ->get();

            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
            
        } 

        $set = $this->set;
        $dados =  \App\Models\Tracks::selectRaw("id,name")->get();
        
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
            "data"      => 'required',
            "horario"   => 'required',
            "fee_value" => 'required',
            "track_id"  => 'required|exists:tracks,id',
        ], [
            'id.required'       => 'Revise.',
            'name.required'     => 'Revise apelido do Piloto.',
            'data.required'     => 'Revise a data da realização.',
            'horario.required'  => 'Revise o horário da realização',
            'fee_value.required'=> 'Revise o valor da inscrição.',
            'track_id.required' => 'Revise a Etapa / Corrida.',
        ]);

        $clear = array("(", ")", "-", ".", "-");
        $ret = \App\Models\Events::updateOrCreate([
                "id"   => $request->id,
            ],[
                'id'       => $request->id,
                'name'     => $request->name,
                'data'     => $request->data,
                'horario'  => $request->horario,
                'fee_value'=> $request->fee_value,
                'track_id' => $request->track_id,
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
            $dados = \App\Models\Events::findOrFail($id);
            
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
            $dados = \App\Models\Events::findOrFail($id);
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

            $dados = \App\Models\Events::findOrFail($id)->delete();            
            return response()->json(["data"=>$dados],Response::HTTP_OK) ;

        }
        return abort(403);  

    }
}
