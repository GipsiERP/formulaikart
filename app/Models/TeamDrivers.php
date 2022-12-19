<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamDrivers extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        "team_id",
        "driver_id",
        'championships_id',
    ];
    
    public static function GetOptions(){

        $drivers = \App\Models\Drivers::selectRaw("id, name")
            ->where([
                ["status", true]
            ])
            ->get();

        $category = \App\Models\Categories::selectRaw("id, name")
            ->where([
                ["status", true]
            ])->get();

        $championship = \App\Models\Championships::selectRaw("id, name")
            ->where([
                ["status", true]
            ])->get();

        return [
            "drivers"      => $drivers,
            "category"     => $category,
            "championship" => $championship,
        ];


    }

    public static function GetTeamDrivers($dados){
        
        $team = \App\Models\Teams::selectRaw("teams.id, name, championship_id, categoria_id, status")
            ->where([
                ["id", $dados],
                ["status", true]
            ])
            ->first();

        $teamsDriver = \App\Models\TeamDrivers::selectRaw("driver_id")
            ->where([
                ["team_id", $dados],
                ["status", true]
            ])
            ->get();

        return [
            "team"         => $team,
            "TeamsDriver"  => $teamsDriver->pluck("driver_id")->toArray(),
        ];
    }

}
