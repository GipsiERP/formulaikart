<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'name' => "STARS",
                'descricao' => "Categoria Stars",
            ],[ 
                'name' => "PRO",
                'descricao' => "Categoria PRO",
            ],[ 
                'name' => "ELITE",
                'descricao' => "Categoria ELITE",
            ],[ 
                'name' => "LIGHT",
                'descricao' => "Categoria LIGHT",
            ]
        ];

        foreach($ins as $i){

            \App\Models\Categories::updateOrCreate(
                $i,
                $i
            );
        }
    }
}
