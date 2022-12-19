<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriversconfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sql = "
        INSERT INTO team_configs
            (id, name, nameFull, pu, color_rgb, color_hex, logo_team, created_at, updated_at)
        VALUES        
        (1, 'Red Bull', 'Red Bull Racing Honda', 'Honda', '6,0,	239', '#443ff3', 'redbull_logo.png', NULL, NULL),
        (2, 'Mercedes', 'Mercedes-AMG Petronas F1 Team', 'Mercedes', '0,210,190', '#00d2be', 'mercedes_logo.png', NULL, NULL),
        (3, 'McLaren', 'McLaren F1 Team', 'Mercedes', '255,152,0', '#ff9800', 'mclaren_logo.png', NULL, NULL),
        (4, 'Ferrari', 'Scuderia Ferrari Mission Winnow', 'Ferrari', '220,0,0', '#dc0000', 'ferrari_logo.png', NULL, NULL),
        (5, 'AlphaTauri', 'Scuderia AlphaTauri Honda', 'Honda', '43,69,98', '#2b4562', 'alphatauri_logo.png', NULL, NULL),
        (6, 'Aston Martin', 'Aston Martin Cognizant F1 Team', 'Mercedes', '0,111,98', '#006f62', 'astonmartin_logo', NULL, NULL),
        (7, 'Aston Martin', 'Alpine F1 Team', 'Renault', '0,144,255', '#0090ff', 'alpine_logo.png', NULL, NULL),
        (8, 'Alfa Romeo', 'Alfa Romeo Racing ORLEN', 'Ferrari', '144,0,0', '#900000', 'alfaromeo_logo.png', NULL, NULL),
        (9, 'Williams', 'Williams Racing', 'Mercedes', '0,90,255', '#005aff', 'williams_logo.png', NULL, NULL),
        (10, 'Haas', 'Uralkali Haas F1 Team', 'Ferrari', '255,255,255', '#ffffff', 'haas_logo.png', NULL, NULL)
        ;
        ";
                
        \DB::Insert($sql);
    }
}
