<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(ChampionshipsTableSeeder::class);
        $this->call(TracksTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(PointsTableSeeder::class);
        $this->call(DriversTableSeeder::class);
        $this->call(DriversconfigsTableSeeder::class);
        $this->call(BanksTableSeeder::class);        
        $this->call(TeamDriversTableSeeder::class);        
        
    }
}
