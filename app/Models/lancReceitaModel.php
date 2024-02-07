<?php

namespace App\Models;

use CodeIgniter\Model;

class lancReceitaModel extends Model
{
    protected $table = 'LancReceita';
    protected $primaryKey = 'id_lancReceita';
    protected $allowedFields = [
        'id_lancReceita',
        'id_lancamento',
        'id_contasReceber',
        'id_receita',
        'id_usuario',
        'valor',
        'data_pagamento'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
  
}
