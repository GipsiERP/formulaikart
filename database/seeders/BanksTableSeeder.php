<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
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
        INSERT INTO banks
        (id, name, agencia, conta, contato_name, contato_telefone, contato_celular, contato_email, codigo, bank_principal, status, created_at, updated_at, deleted_at)
        VALUES(1, 'Banco Itau', 'Agencia', 'Conta', 'Gerente', '1111111111', '11999999999', 'gerente@banco.com.br', '341', 0, 1, '2022-04-01 19:00:00.000', '2022-04-01 19:00:00.000', NULL);
        ";
                
        \DB::Insert($sql);
    }
}
