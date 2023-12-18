<?php

namespace App\Controllers;

use App\Models\contaDre as ModelsContaDre;
use App\Models\UsuarioModel;
use DateTime;

class contaDre extends BaseController
{
    private $session;
    private $db;
    private $dbUsuario; 

    function __construct()
    {
        $this->session = session();
        $this->db = new ModelsContaDre();
        $this->dbUsuario = new UsuarioModel();
    }

    public function index()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contaDre'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header', $perfil);
        echo View('contaDre/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        echo View('templates/header', $perfil);
        echo View('contaDre/formulario');
        echo View('templates/footer');
    }

    public function store()
    {
        $request = request();
        $ativo = $request->getPost('ativo') == 'on' ? 'S' : 'N';
        $id_contaDre = $request->getPost('id_contaDre');
        $dados = [
            'nome'          => $request->getPost('nome'),
            'ativo'         => $ativo,
            'id_usuario'    => $this->session->get('id_usuario'),
        ];

        //Update
        if (isset($id_contaDre)) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Conta Dre alterada com sucesso!'
                ]
            );
            $this->db->where(['id_contaDre' => $id_contaDre, 'id_usuario' => $this->session->get('id_usuario')])->set($dados)->update();
        } else {
            //insert  
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Conta Dre cadastrada com sucesso!'
                ]
            );
            $this->db->insert($dados);
        }
        return redirect()->to('contaDre');
    }

    public function visualizar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['contaDre'] = $this->db->where(['id_contaDre' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('contaDre/visualizar', $data);
        echo View('templates/footer');
    }

    public function editar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['contaDre'] = $this->db->where(['id_contaDre' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('contaDre/formulario', $data);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();
        $this->db->where(['id_contaDre' => $request->getPost('id_contaDre'), 'id_usuario' => $this->session->get('id_usuario')])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Conta Dre excluída com sucesso!'
            ]
        );
        return redirect()->to('/contaDre');
    }
}
