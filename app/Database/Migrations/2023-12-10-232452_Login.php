<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Login extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usuario'            => [
                'type'              => 'INT',
                'constraint'        => 9,
                'usigned'           => true,
                'auto_increment'    => true
            ],
            'nome'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'email'                 => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'senha'                 => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],
            'administrador'         => [
                'type'              => 'CHAR',
            ],
            'data_nascimento'       => [
                'type'              => 'DATE',
                'null'              => true,
            ],
            'data_cadastro'         => [
                'type'              => 'DATE',
                'default'           => date('Y-m-d'),
            ],
            'foto'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => true,
            ],
            'endereço'              => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'cep'                   => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'bairro'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'fone'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'numero'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'dia_pagamento'         => [
                'type'              => 'smallint',
                'null'              => true,
            ],
            'ativo'                 => [
                'type'              => 'CHAR'
            ],
            'created_at'            => [
                'type'              => 'DATETIME'
            ],
            'updated_at'            => [
                'type'              => 'DATETIME'
            ],
            'deleted_at'            => [
                'type'              => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id_usuario', true);
        $this->forge->createTable('usuario');
    }

    public function down()
    {
        $this->forge->dropTable('usuario');
    }
}
