<?php

namespace App\Models;

use CodeIgniter\Model;

class baixaContasPagar extends Model
{
    protected $table = 'baixa_conta_pagar';
    protected $primaryKey = 'id_baixa_conta_pagar';
    protected $allowedFields = [
        'id_baixa_conta_pagar',
        'origem',
        'data_pagamento',
        'valor',
        'id_usuario',
        'id_receita',        
        'id_despesa',
        'id_contasPagar',  
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
