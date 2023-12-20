<?php

namespace App\Models;

use CodeIgniter\Model;

class baixaContasReceber extends Model
{
    protected $table = 'baixa_conta_receber';
    protected $primaryKey = 'id_baixa_conta_receber';
    protected $allowedFields = [
        'id_baixa_conta_receber',
        'origem',
        'data_pagamento',
        'valor',
        'id_usuario',
        'id_receita',        
        'id_despesa',
        'id_contasReceber', 
        'id_cartao',
        'id_caixa',
        'tipo_pagamento' 
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
