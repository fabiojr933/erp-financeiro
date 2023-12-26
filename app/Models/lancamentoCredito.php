<?php

namespace App\Models;

use CodeIgniter\Model;

class lancamentoCredito extends Model
{
    protected $table = 'lancamentoCredito';
    protected $primaryKey = 'id_credito';
    protected $allowedFields = [
        'id_credito',
        'id_cartao',
        'data',
        'id_lancamento',
        'valor',
        'id_usuario',
        'status',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
