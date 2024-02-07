<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Caixa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_caixa'              => [
                'type'              => 'INT',
                'constraint'        => 9,
                'usigned'           => true,
                'auto_increment'    => true
            ],
            'nome'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 128
            ],           
            'id_usuario'            => [
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
        $this->forge->addKey('id_caixa', true);
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id_usuario');
        $this->forge->createTable('caixa');
    }

    public function down()
    {
        $this->forge->dropTable('caixa');
    }
}
