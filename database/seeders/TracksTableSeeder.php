<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TracksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ins = [ 
            [ 
                "name" => "KGV - Granja Viana", 
                "cidade" => "Cotia - SP"
            ],[ 
                "name" => "Interlagos", 
                "cidade" => "São Paulo - SP"
            ],[ 
                "name" => "Arena Itu Schincariol", 
                "cidade" => "Itu - SP"
            ],[ 
                "name" => "KNO - Nova Odessa",
                "cidade" => "Nova Odessa - SP"
            ],
        ];
        

        foreach($ins as $i){

            \App\Models\Tracks::updateOrCreate(
                $i,
                $i
            );
        }
    }
}
