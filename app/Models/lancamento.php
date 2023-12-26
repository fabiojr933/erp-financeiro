<?php

namespace App\Models;

use CodeIgniter\Model;

class lancamento extends Model
{
    protected $table = 'lancamento';
    protected $primaryKey = 'id_lancamento';
    protected $allowedFields = [
        'id_lancamento',
        'tipo',
        'descricao',
        'data_pagamento',
        'valor',
        'pagamento',
        'observacao',
        'id_caixa',
        'id_cartao',  
        'id_fornecedor',  
        'id_cliente',  
        'id_receita',  
        'id_fluxo',  
        'id_usuario', 
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
