<?php

namespace App\Models;

use CodeIgniter\Model;

class lancDespesaModel extends Model
{
    protected $table = 'lancDespesa';
    protected $primaryKey = 'id_lancReceita';
    protected $allowedFields = [
        'id_lancDespesa',
        'id_lancamento',
        'id_contasPagar',
        'id_contaFluxo',
        'id_usuario',
        'valor',
        'data_pagamento'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
  
}
