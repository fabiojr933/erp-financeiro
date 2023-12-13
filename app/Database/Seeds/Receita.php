<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Receita extends Seeder
{
    public function run()
    {
        $this->db->table('receita')->insert([
            'nome'          => 'Salario',
            'ativo'         => 'S'
        ]);
    }
}
