<?php

namespace App\Models;

use CodeIgniter\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    protected $allowedFields = [
        'id_cliente',
        'tipo',
        'nome',
        'cpf',
        'cnpj',
        'razao_social',
        'isento',
        'ie',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'estado',
        'cidade',
        'fixo',
        'celular_1',
        'celular_2',
        'email',
        'ativo',
        'id_usuario',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function inserirCliente($id)
    {
        $data = [
            'tipo' => 'fisica',
            'nome'         => 'Cliente padrão',
            'cpf'          =>  '88888888888',
            'isento'       =>  'S',
            'cep'          =>  '7852000',
            'logradouro'   =>  'Sem endereço',
            'numero'       =>  '99',
            'complemento'  =>  'sem',
            'bairro'       =>  'centro',
            'estado'       =>  'MT',
            'cidade'       =>  'gta',
            'id_usuario'   => $id,
        ];
        $this->insert($data);
    }
}
