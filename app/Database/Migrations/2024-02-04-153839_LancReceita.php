<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LancReceita extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_lancReceita'              => [
                'type'              => 'INT',
                'constraint'        => 9,
                'usigned'           => true,
                'auto_increment'    => true
            ],
            'id_lancamento'                  => [
                'type'              => 'INT',
                'constraint'        => 128,
                'null'              => true,
            ],  
            'id_contasReceber'                  => [
                'type'              => 'INT',
                'constraint'        => 128,
                'null'              => true,
            ],  
            'id_receita'                  => [
                'type'              => 'INT',
                'constraint'        => 128,
                'null'              => true,
            ],       
            'id_usuario'            => [
                'type'              => 'INT',
                'constraint'        => 9,
            ],
            'valor'                 => [
                'type'              => 'DECIMAL',
                'constraint'        => '10,2',
                'default'           => 0.00
            ],
            'data_pagamento'         => [
                'type'              => 'DATE',
                'default'           => date('Y-m-d'),
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
        $this->forge->addKey('id_lancReceita', true);
        $this->forge->addForeignKey('id_lancamento', 'lancamento', 'id_lancamento');
        $this->forge->addForeignKey('id_contasReceber', 'contasreceber', 'id_contasReceber');
        $this->forge->addForeignKey('id_receita', 'receita', 'id_receita');
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id_usuario');
        $this->forge->createTable('LancReceita');
    }

    public function down()
    {
        $this->forge->dropTable('LancReceita');
    }
}
