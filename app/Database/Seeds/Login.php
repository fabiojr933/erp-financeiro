<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Login extends Seeder
{
    public function run()
    {
        $this->db->table('usuario')->insert([
            'senha'          => md5('admin'),
            'nome'           => 'admin',
            'email'          => 'admin@gmail.com',
            'administrador'  => 'S',
            'ativo'          => 'S'
        ]);
    }
}
