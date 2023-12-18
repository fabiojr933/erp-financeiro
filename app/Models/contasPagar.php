<?php

namespace App\Models;

use CodeIgniter\Model;

class contasPagar extends Model
{
    protected $table = 'contaspagar';
    protected $primaryKey = 'id_contasPagar';
    protected $allowedFields = [
        'id_contasPagar',
        'status',
        'descricao',
        'vencimento',
        'valor',
        'valor_pendente',
        'id_fornecedor',
        'observacao',
        'id_usuario',  
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
