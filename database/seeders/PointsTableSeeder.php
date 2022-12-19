<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
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
                "posicao" => 1, 
                "pontos" => 35,
                "versao" => 1,
            ],[ 
                "posicao" => 2, 
                "pontos" => 31,
                "versao" => 1,
            ],[ 
                "posicao" => 3, 
                "pontos" => 29,
                "versao" => 1,
            ],[ 
                "posicao" => 4, 
                "pontos" => 27,
                "versao" => 1,
            ],[ 
                "posicao" => 5, 
                "pontos" => 26,
                "versao" => 1,
            ],[ 
                "posicao" => 6, 
                "pontos" => 25,
                "versao" => 1,
            ],[ 
                "posicao" => 7, 
                "pontos" => 24,
                "versao" => 1,
            ],[ 
                "posicao" => 8, 
                "pontos" => 23,
                "versao" => 1,
            ],[ 
                "posicao" => 9, 
                "pontos" => 22,
                "versao" => 1,
            ],[ 
                "posicao" => 10, 
                "pontos" => 21,
                "versao" => 1,
            ],[ 
                "posicao" => 11, 
                "pontos" => 20,
                "versao" => 1,
            ],[ 
                "posicao" => 12, 
                "pontos" => 19,
                "versao" => 1,
            ],[ 
                "posicao" => 13, 
                "pontos" => 18,
                "versao" => 1,
            ],[ 
                "posicao" => 14, 
                "pontos" => 17,
                "versao" => 1,
            ],[ 
                "posicao" => 15, 
                "pontos" => 16,
                "versao" => 1,
            ],[ 
                "posicao" => 16, 
                "pontos" => 15,
                "versao" => 1,
            ],[ 
                "posicao" => 17, 
                "pontos" => 14,
                "versao" => 1,
            ],[ 
                "posicao" => 18, 
                "pontos" => 13,
                "versao" => 1,
            ],[ 
                "posicao" => 19, 
                "pontos" => 12,
                "versao" => 1,
            ],[ 
                "posicao" => 20, 
                "pontos" => 11,
                "versao" => 1,
            ],[ 
                "posicao" => 21, 
                "pontos" => 10,
                "versao" => 1,
            ],[ 
                "posicao" => 22, 
                "pontos" => 9,
                "versao" => 1,
            ],[ 
                "posicao" => 23, 
                "pontos" => 8,
                "versao" => 1,
            ],[ 
                "posicao" => 24, 
                "pontos" => 7,
                "versao" => 1,
            ],[ 
                "posicao" => 25, 
                "pontos" => 6,
                "versao" => 1,
            ],[ 
                "posicao" => 26, 
                "pontos" => 5,
                "versao" => 1,
            ],[ 
                "posicao" => 27, 
                "pontos" => 4,
                "versao" => 1,
            ],[ 
                "posicao" => 28, 
                "pontos" => 3,
                "versao" => 1,
            ],[ 
                "posicao" => 29, 
                "pontos" => 2,
                "versao" => 1,
            ],[ 
                "posicao" => 30, 
                "pontos" => 1,
                "versao" => 1,
            ]
        ];
        

        foreach($ins as $i){

            \App\Models\Points::updateOrCreate(
                $i,
                $i
            );
        }
    }
}
