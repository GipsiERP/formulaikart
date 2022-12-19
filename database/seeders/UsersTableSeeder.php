<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'name'      => 'Admin',
                'email'     => 'admin@gipsi.com.br',
                'password'  => bcrypt('lala@123'),
            ],
            [
                'name'      => 'Reginaldo Cruz',
                'email'     => 'reginaldo@gipsi.com.br',
                'password'  => bcrypt('lala@123'),
            ],
            [
                'name'      => 'Talita',
                'email'     => 'talita@formulaikart.com.br',
                'password'  => bcrypt('123456'),
            ]
        ];
        foreach($ins as $i){

            \App\Models\User::updateOrCreate(
                $i, 
                $i,
            );
        }

    }
}
