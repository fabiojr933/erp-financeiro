<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BaixaContasReceber extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_baixa_conta_receber'  => [
                'type'              => 'INT',
                'constraint'        => 9,
                'usigned'           => true,
                'auto_increment'    => true
            ],
            'origem'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 20
            ],
            'data_pagamento'        => [
                'type'              => 'DATE',
                'default'           => date('Y-m-d'),
            ],
            'valor'                 => [
                'type'              => 'DECIMAL',
                'constraint'        => '10,2',
                'default'           => 0.00
            ],
            'id_usuario'            => [
                'type'              => 'INT',
                'constraint'        => 9,
            ],
            'id_receita'            => [
                'type'              => 'INT',
                'constraint'        => 9,
                'null'              => true,
            ],
            'id_despesa'            => [
                'type'              => 'INT',
                'constraint'        => 9,
                'null'              => true,
            ],
            'id_contasReceber'      => [
                'type'              => 'INT',
                'constraint'        => 9,
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
        $this->forge->addKey('id_baixa_conta_receber', true);
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id_usuario');
        $this->forge->addForeignKey('id_receita', 'receita', 'id_receita');
        $this->forge->addForeignKey('id_despesa', 'contaFluxo', 'id_contaFluxo');
        $this->forge->addForeignKey('id_contasReceber', 'contasReceber', 'id_contasReceber');
        $this->forge->createTable('baixa_conta_receber');
    }

    public function down()
    {
        $this->forge->dropTable('baixa_conta_receber');
    }
}
