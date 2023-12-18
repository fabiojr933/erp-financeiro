<?php

namespace App\Models;

use CodeIgniter\Model;

class CartaoModel extends Model
{
    protected $table = 'cartao';
    protected $primaryKey = 'id_cartao';
    protected $allowedFields = [
        'id_cartao',
        'nome',
        'agencia',
        'conta',
        'vencimento',
        'ativo',
        'tipo',
        'saldo',
        'limite',
        'id_usuario',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
