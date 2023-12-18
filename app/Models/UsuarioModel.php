<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = [
        'id_usuario',
        'senha',
        'nome',
        'email',
        'administrador',
        'data_nascimento',
        'data_cadastro',
        'foto',
        'endereço',
        'cep',
        'bairro',
        'fone',
        'numero',
        'dia_pagamento',
        'ativo',
        'logo',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
