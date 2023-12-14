<?php

namespace App\Models;

use CodeIgniter\Model;

class contaFluxo extends Model
{
    protected $table = 'contaFluxo';
    protected $primaryKey = 'id_contaFluxo';
    protected $allowedFields = [
        'id_contaFluxo',
        'nome',
        'data_cadastro',
        'ativo',
        'id_usuario',
        'id_contaDre',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

}
