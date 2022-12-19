<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
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
                'name' => "Clara Cloud - KGV",
                'data' => "2022/03/26",
                'horario' => "18:30",
                'fee_value' => 160,
                'track_id' => 1,
                'championships_id' => 1,
            ],[ 
                'name' => "Osasluz - KGV",
                'data' => "2022/04/09",
                'horario' => "17:00",
                'fee_value' => 160,
                'track_id' => 1,
                'championships_id' => 1,
            ],[ 
                'name' => "Leo Multimarcas - KGV",
                'data' => "2022/05/14",
                'horario' => "18:30",
                'fee_value' => 160,
                'track_id' => 1,
                'championships_id' => 1,
            ],[ 
                'name' => "Rodrigo Mota - Interlagos",
                'data' => "2022/06/25",
                'horario' => "16:00",
                'track_id' => 2,
                'championships_id' => 1,
            ],[ 
                'name' => "MS Assessoria - Arena Itu",
                'data' => "2022/07/16",
                'horario' => "13:00",
                'track_id' => 4,
                'championships_id' => 1,
            ],[ 
                'name' => "BNI OESP - KNO",
                'data' => "2022/08/20",
                'horario' => "15:30",
                'track_id' => 3,
                'championships_id' => 1,
            ],[ 
                'name' => "Santander Marmores - KGV",
                'data' => "2022/09/10",
                'horario' => "19:30",
                'track_id' => 1,
                'championships_id' => 1,
            ],[ 
                'name' => "Samir Estofados - KGV",
                'data' => "2022/10/08",
                'horario' => "19:00",
                'track_id' => 1,
                'championships_id' => 1,
            ],[ 
                'name' => "Fogazza Cosmetics - KGV",
                'data' => "2022/11/05",
                'horario' => "18:00",
                'track_id' => 1,
                'championships_id' => 1,
            ],[ 
                'name' => "Final Clara Cloud - KGV",
                'data' => "2022/12/03",
                'horario' => "19:00",
                'track_id' => 1,
                'championships_id' => 1,
            ]
        ];        

        foreach($ins as $i){

            \App\Models\Events::updateOrCreate(
                $i,
                $i
            );
        }
    }
}
