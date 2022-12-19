<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboard extends Model
{
    use HasFactory, SoftDeletes;


    static public function home(){

        $events = \App\Models\Events::selectRaw("
                id, name, DATE_FORMAT(data, '%d/%m/%Y') as data , horario,
                CASE 
                    WHEN finished = TRUE THEN 'success'
                    WHEN finished = FALSE THEN 'primary'
                    else 'warning'
                END as status,
                CASE 
                    WHEN finished = TRUE THEN 'Realizado'
                    WHEN finished = FALSE THEN 'Confirmado'
                    else 'Agendado'
                END as badge,            
                finished
            ")
            ->get();

        $categories = \App\Models\Categories::selectRaw("id,name,descricao")
            ->get();

        foreach($categories as $c ){
            
            $drivers ["driveBy".$c->name] = \App\Models\Drivers::selectRaw("
                    drivers.id, drivers.name, 
                    ifnull(
                        sum(points.pontos)
                    ,0) as pontos
                    ")
                ->leftjoin("team_drivers","team_drivers.driver_id","=","drivers.id")
                ->leftjoin("teams","team_drivers.team_id","=","teams.id")
                ->leftjoin("results","results.driver_id","=","drivers.id")
                ->leftjoin("points","points.posicao","=","results.posicao")

                ->wherenull("team_drivers.deleted_at")
                ->where([
                    ["teams.categoria_id", $c->id],
                ])
                ->wherenull("drivers.deleted_at")
                ->groupBy("drivers.id")
                ->groupBy("drivers.name")
                ->orderBy("pontos", "DESC")
                ->get(); 

            

        }
// dd($drivers);
        $inscritosEtapa = \App\Models\Events::selectRaw("id, name,
            replace(name,' ','') as nameHash"
            )
            ->where("finished", false)
            ->get();

        $clear = array("-", " ");
        $inscritos = [];

        foreach($inscritosEtapa as $c ){
            
            $inscritos ["Etapa".$c->nameHash]["drivers"] = \App\Models\Finances::selectRaw("
                    drivers.id, drivers.name, finances.id as finance_id
                ")
                ->join("drivers","finances.driver_id","=","drivers.id")
                ->where([
                    ["finances.event_id", $c->id],
                    ["finances.value_pay", null]
                ])
                ->wherenull("drivers.deleted_at")
                ->orderBy("drivers.name")
                ->get();
            $inscritos ["Etapa".$c->nameHash]["dados"] = $c;

            $inscritos ["Etapa".$c->nameHash]["draw"] = \App\Models\Finances::selectRaw("
                    sum(finances.value) as total,
                    sum(finances.value_pay) as pay,
                    IFNULL(
                        round( 
                            ( sum(finances.value_pay) / sum(finances.value)*100 
                        ),2) 
                    , 0) as percent

                ")
                ->join("drivers","finances.driver_id","=","drivers.id")
                ->where([
                    ["finances.event_id", $c->id],
                //     ["finances.value_pay", ">", 0 ]
                ])
                ->first();

        }

// $teamDrivers = \App\Models\Categories::selectRaw("id,name,descricao")
// ->get();

        foreach($categories as $c ){
            $teams ["teamBy".$c->name] = \App\Models\Drivers::selectRaw("
                    teams.id, teams.name, teams.categoria_id,
                    ifnull(
                        sum(points.pontos)
                    ,0) as pontos,
                    GROUP_CONCAT(
                        distinct drivers.name
                    ) AS 'drivers_name'
                    ")
                ->leftjoin("team_drivers","team_drivers.driver_id","=","drivers.id")
                ->leftjoin("teams","team_drivers.team_id","=","teams.id")
                ->leftjoin("results","results.driver_id","=","drivers.id")
                ->leftjoin("points","points.posicao","=","results.posicao")

                ->where([
                    ["teams.categoria_id", $c->id],
                ])
                ->wherenull("teams.deleted_at")
                ->groupBy("teams.id")
                ->groupBy("teams.name")
                ->groupBy("teams.categoria_id")
                ->orderBy("pontos", "DESC")
                ->get(); 
            
        }
// dd($teams);
        $n = 0 ;
        $driverTeams = \App\Models\Drivers::select("id","name");

        foreach($teams as $f){
            $teams[$n]["drivers"] = 1;

        }

        return [
            "events"        => $events,
            "categories"    => $categories,
            "drivers"       => $drivers,
            "inscritosEtapa"=> $inscritosEtapa,
            "inscritos"     => $inscritos,
            "teams"         => $teams,
        ];

    }

    
}
