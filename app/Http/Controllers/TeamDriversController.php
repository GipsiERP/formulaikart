<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamDriversController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->set = [
            "title"     => "Equipe de pilotos",
            "prefix"    => 'TeamDrivers',
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

            $dados = \App\Models\Teams::selectRaw("teams.id, teams.name, teams.status, count(teams.categoria_id) as qtde,
                    championships.name as championship_name , 
                    categories.name as categoria_name                    
                ")
                ->join("championships", "championships.id", "=", "teams.championship_id")
                ->join("categories", "categories.id", "=", "teams.categoria_id")

                ->join("team_drivers", "team_drivers.team_id", "=", "teams.id")
                ->groupBy("teams.id")
                ->groupBy("teams.name")
                ->groupBy("teams.status")
                ->groupBy("championships.name")
                ->groupBy("categories.name")
                ->whereNull("team_drivers.deleted_at")
                ->whereNull("teams.deleted_at")
                ->get();

            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
            
        } 

        $set = $this->set;
        $dados = \App\Models\TeamDrivers::GetOptions();
        
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
                'driver_id.*'       => 'exists:drivers,id',
                'championship_id'   => 'exists:championships,id',
                'team_id'           => 'exists:teams,id',
                // 'categoria_id'      => 'exists:categories,id',
            ], [
                'team_id.required'          => 'Revisar',
                'driver_id.*.id.required'   => 'Piloto não localizado. #:position.',
                'championship_id.required'  => 'Selecione o campeonato',
                // 'categoria_id.required'     => 'Selecione a categoria',
            ]);
        
            \App\Models\TeamDrivers::select("id")
                ->where([
                    ["team_id", $request->id]
                ])
                ->forceDelete();

        if( isset( $request->driver_id ) ){
            foreach($request->driver_id as $d){

                \App\Models\TeamDrivers::updateOrCreate([
                        "championships_id"   => $request->championship_id,
                        // "categoria_id"      => $request->categoria_id,
                        "driver_id"         => $d,
                        "team_id"           => $request->id
                    ],[
                        "championships_id" => $request->championship_id,
                        // "categoria_id"      => $request->categoria_id,
                        "driver_id"         => $d,
                        "team_id"           => $request->id,
                    ]);

            }
        }
        return response()->json(["Success"=>"Salvo com sucesso"],Response::HTTP_OK) ;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request, $id)
    {
        //
        if($request->ajax()){                 
            $dados = \App\Models\TeamDrivers::GetTeamDrivers($id);
            
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
            $dados = \App\Models\Teams::findOrFail($id)->delete();
            
            return response()->json(["data"=>$dados],Response::HTTP_OK) ;
        }
        return abort(403);

    }
}
