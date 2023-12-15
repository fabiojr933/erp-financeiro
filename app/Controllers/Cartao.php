<?php

namespace App\Controllers;

use App\Models\CartaoModel;

class Cartao extends BaseController
{
    private $session;
    private $db;
    function __construct()
    {
        $this->session = session();
        $this->db = new CartaoModel();
    }

    public function index()
    {
        $dados['cartao'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header');
        echo View('cartao/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {
        echo View('templates/header');
        echo View('cartao/formulario');
        echo View('templates/footer');
    }

    public function store()
    {
        $request = request();
        $ativo = $request->getPost('ativo') == 'on' ? 'S' : 'N';
        $id_cartao = $request->getPost('id_cartao');
        $dados = [
            'nome'       => $request->getPost('nome'),
            'agencia'    => $request->getPost('agencia'),
            'conta'      => $request->getPost('conta'),
            'vencimento' => $request->getPost('vencimento'),
            'ativo'      => $ativo,
            'tipo'       => $request->getPost('tipo'),
            'id_usuario' => $this->session->get('id_usuario'),
        ];

        if (intval($dados['vencimento']) > 30) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'danger',
                    'titulo' => 'Vencimento invalido!'
                ]
            );
            return redirect()->to('cartao');
        }
        //Update
        if (isset($id_cartao)) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Cartão alterada com sucesso!'
                ]
            );
            $this->db->where(['id_cartao' => $id_cartao, 'id_usuario' => $this->session->get('id_usuario')])->set($dados)->update();
        } else {
            //insert  
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Receita cadastrada com sucesso!'
                ]
            );
            $this->db->insert($dados);
        }
        return redirect()->to('cartao');
    }

    public function visualizar($id)
    {
        $data['cartao'] = $this->db->where(['id_cartao' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header');
        echo View('cartao/visualizar', $data);
        echo View('templates/footer');
    }

    public function editar($id)
    {
        $data['cartao'] = $this->db->where(['id_cartao' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header');
        echo View('cartao/formulario', $data);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();
        $this->db->where(['id_cartao' => $request->getPost('id_cartao'), 'id_usuario' => $this->session->get('id_usuario')])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Receita excluída com sucesso!'
            ]
        );
        return redirect()->to('/cartao');
    }
}