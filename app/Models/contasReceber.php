<?php

namespace App\Models;

use CodeIgniter\Model;

class contasReceber extends Model
{
    protected $table = 'contasreceber';
    protected $primaryKey = 'id_contasReceber';
    protected $allowedFields = [
        'id_contasReceber',
        'status',
        'descricao',
        'vencimento',
        'valor',
        'valor_pendente',
        'id_cliente',
        'observacao',
        'id_usuario',  
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
