<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LancamentoCredito extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_credito' => [
                'type'              => 'INT',
                'constraint'        => 9,
                'usigned'           => true,
                'auto_increment'    => true
            ],
            'id_cartao'             => [
                'type'              => 'INT',
                'constraint'        => 9,
            ],
            'data'                  => [
                'type'              => 'DATE',
                'default'           => date('Y-m-d'),
            ],
            'id_lancamento'         => [
                'type'              => 'INT',
                'constraint'        => 9,
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
            'status'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 128
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
        $this->forge->addKey('id_credito', true);
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id_usuario');
        $this->forge->addForeignKey('id_cartao', 'cartao', 'id_cartao');
        $this->forge->addForeignKey('id_lancamento', 'lancamento', 'id_lancamento');
        $this->forge->createTable('lancamentoCredito');
    }

    public function down()
    {
        $this->forge->dropTable('lancamentoCredito');
    }
}
