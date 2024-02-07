<?php

namespace App\Models;

use CodeIgniter\Model;

class Caixa extends Model
{
    protected $table = 'caixa';
    protected $primaryKey = 'id_caixa';
    protected $allowedFields = [
        'id_caixa',
        'nome',
        'saldo',
        'id_usuario',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';


    public function inserirCaixa($id)
    {
        $data = [
            'nome' => 'Carteira',
            'ativo'      => 'S',
            'id_usuario' => $id,
        ];
        $this->insert($data);
    }
}
