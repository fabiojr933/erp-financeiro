<?php

namespace App\Controllers;

use App\Models\contaDre;
use App\Models\contaFluxo as ModelsContaFluxo;
use App\Models\UsuarioModel;

class contaFluxo extends BaseController
{
    private $session;
    private $db;
    private $db2;
    private $dbUsuario;  

    function __construct()
    {
        $this->session = session();
        $this->db = new ModelsContaFluxo();
        $this->db2 = new contaDre();
        $this->dbUsuario = new UsuarioModel();
    }

    public function index()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contaFluxo'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header', $perfil);
        echo View('contaFluxo/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contaDre'] = $this->db2->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header', $perfil);
        echo View('contaFluxo/formulario', $dados);
        echo View('templates/footer');
    }

    public function store()
    {
        $request = request();
        $ativo = $request->getPost('ativo') == 'on' ? 'S' : 'N';
        $id_contaFluxo = $request->getPost('id_contaFluxo');
        $dados = [
            'nome'          => $request->getPost('nome'),
            'ativo'         => $ativo,
            'id_usuario'    => $this->session->get('id_usuario'),
            'id_contaDre'   => $request->getPost('id_contaDre'),
        ];

        //Update
        if (isset($id_contaFluxo)) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Conta Dre alterada com sucesso!'
                ]
            );
            $this->db->where(['id_contaFluxo' => $id_contaFluxo, 'id_usuario' => $this->session->get('id_usuario')])->set($dados)->update();
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
        return redirect()->to('contaFluxo');
    }

    public function visualizar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['contaFluxo'] = $this->db->where(['id_contaFluxo' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('contaFluxo/visualizar', $data);
        echo View('templates/footer');
    }

    public function editar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contaDre'] = $this->db2->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $data['contaFluxo'] = $this->db->where(['id_contaFluxo' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        $mergedData = array_merge($data, $dados);
        echo View('templates/header', $perfil);
        echo View('contaFluxo/formulario', $mergedData);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();
        $this->db->where(['id_contaFluxo' => $request->getPost('id_contaFluxo'), 'id_usuario' => $this->session->get('id_usuario')])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Conta Dre excluída com sucesso!'
            ]
        );
        return redirect()->to('/contaFluxo');
    }
}
