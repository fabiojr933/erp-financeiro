<?php

namespace App\Models;

use CodeIgniter\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedor';
    protected $primaryKey = 'id_fornecedor';
    protected $allowedFields = [
        'id_fornecedor',
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

    public function inserirFornecedor($id)
    {
        $data = [
            'tipo' => 'fisica',
            'nome'         => 'Fornecedor padrão',
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
