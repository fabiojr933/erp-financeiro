<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cliente extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cliente'         => [
                'type'              => 'INT',
                'constraint'        => 9,
                'usigned'           => true,
                'auto_increment'    => true
            ],
            'tipo'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 128
            ],
            'nome'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
                'null'              => true,
            ],
            'ativo'                 => [
                'type'              => 'VARCHAR',
                'constraint'        => 10,
                'null'              => true,
            ],
            'cpf'                   => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'razao_social'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
                'null'              => true,
            ],
            'cnpj'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
                'null'              => true,
            ],
            'isento'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'ie'                    => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'cep'                   => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'logradouro'            => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
                'null'              => true,
            ],
            'numero'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
                'null'              => true,
            ],
            'complemento'           => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
                'null'              => true,
            ],
            'bairro'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'estado'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'cidade'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
                'null'              => true,
            ],
            'fixo'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'celular_1'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'celular_2'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
                'null'              => true,
            ],
            'email'                 => [
                'type'              => 'VARCHAR',
                'constraint'        => 128,
                'null'              => true,
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
        $this->forge->addKey('id_cliente', true);
        $this->forge->addForeignKey('id_usuario', 'usuario', 'id_usuario');
        $this->forge->createTable('cliente');
    }

    public function down()
    {
        $this->forge->dropTable('cliente');
    }
}
