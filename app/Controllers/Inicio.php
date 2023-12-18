<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Inicio extends Controller
{
    private $session;
    private $db;

    function __construct()
    {
        $this->session = session();
        $this->db = new UsuarioModel();
    }
    public function index()
    {
        $data['perfil'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->first();
        echo View('templates/header',$data);
        echo View('inicio/index');
        echo View('templates/footer');
    }
}
