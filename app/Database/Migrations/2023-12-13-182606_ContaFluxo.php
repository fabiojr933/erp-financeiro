<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContaFluxo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_contaFluxo'         => [
                'type'              => 'INT',
                'constraint'        => 9,
                'usigned'           => true,
                'auto_increment'    => true
            ],
            'nome'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 128
            ],
            'data_cadastro'         => [
                'type'              => 'DATE',
                'default'           => date('Y-m-d'),
            ],
            'ativo'                 => [
                'type'              => 'CHAR'
            ],
            'id_usuario'            => [
                'type'              => 'INT',
                'constraint'        => 9,
            ],
            'id_contaDre'           => [
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
        $this->forge->addKey('id_contaFluxo', true);
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id_usuario');
        $this->forge->addForeignKey('id_contaDre', 'contaDre', 'id_contaDre');
        $this->forge->createTable('contaFluxo');     



    }

    public function down()
    {
        $this->forge->dropTable('contaFluxo');
    }
}
