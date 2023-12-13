<?php

namespace App\Models;

use CodeIgniter\Model;

class ReceitaModel extends Model
{
    protected $table = 'receita';
    protected $primaryKey = 'id_receita';
    protected $allowedFields = [
        'id_receita',
        'nome',
        'ativo',
        'id_usuario',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function inserirReceita($id)
    {
        $data = [
            [
                'nome'       => 'Vendas a vista',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Entrada de venda a prazo',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Recebimento de duplicata',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Recebimento de juros e multa',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Outras entrada',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Salario',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Decimo 13°',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Pagamento de Serviços Prestados',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Aluguel de Propriedades',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Venda de Ativos',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Subsídios e Doações',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Comissões',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
        ];
        foreach ($data as $dados) {
            $db = new ReceitaModel();
            $db->insert($dados);
        }
    }
}
