<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LancDespesa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_lancDespesa'              => [
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
            'id_contasPagar'                  => [
                'type'              => 'INT',
                'constraint'        => 128,
                'null'              => true,
            ],  
            'id_contaFluxo'                  => [
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
        $this->forge->addKey('id_lancDespesa', true);
        $this->forge->addForeignKey('id_lancamento', 'lancamento', 'id_lancamento');
        $this->forge->addForeignKey('id_contasPagar', 'contaspagar', 'id_contasPagar');
        $this->forge->addForeignKey('id_contaFluxo', 'contafluxo', 'id_contaFluxo');
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id_usuario');
        $this->forge->createTable('LancDespesa');
    }

    public function down()
    {
        $this->forge->dropTable('LancDespesa');
    }
}
