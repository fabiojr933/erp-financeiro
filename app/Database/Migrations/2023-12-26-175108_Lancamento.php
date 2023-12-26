<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lancamento extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_lancamento'             => [
                'type'              => 'INT',
                'constraint'        => 9,
                'usigned'           => true,
                'auto_increment'    => true
            ],
            'tipo'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 20
            ],
            'descricao'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 150
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
            'pagamento'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 20
            ],
            'observacao'            => [
                'type'              => 'VARCHAR',
                'constraint'        => 255
            ],            
            'id_caixa'              => [
                'type'              => 'INT',
                'constraint'        => 9,
                'null'              => true,
            ],
            'id_cartao'             => [
                'type'              => 'INT',
                'constraint'        => 9,
                'null'              => true,
            ],
            'id_fornecedor'         => [
                'type'              => 'INT',
                'constraint'        => 9,
                'null'              => true,
            ],
            'id_cliente'            => [
                'type'              => 'INT',
                'constraint'        => 9,
                'null'              => true,
            ],
            'id_receita'            => [
                'type'              => 'INT',
                'constraint'        => 9,
                'null'              => true,
            ],
            'id_fluxo'              => [
                'type'              => 'INT',
                'constraint'        => 9,
                'null'              => true,
            ],
            'id_usuario'            => [
                'type'              => 'INT',
                'constraint'        => 9,
                'null'              => true,
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
        $this->forge->addKey('id_lancamento', true);
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id_usuario');
        $this->forge->addForeignKey('id_cliente', 'cliente', 'id_cliente');
        $this->forge->addForeignKey('id_fluxo', 'contaFluxo', 'id_contaFluxo');
        $this->forge->addForeignKey('id_receita', 'receita', 'id_receita');
        $this->forge->addForeignKey('id_fornecedor', 'fornecedor', 'id_fornecedor');
        $this->forge->addForeignKey('id_cartao', 'cartao', 'id_cartao');
        $this->forge->addForeignKey('id_caixa', 'caixa', 'id_caixa');
        $this->forge->createTable('lancamento');
    }

    public function down()
    {
        //
    }
}
