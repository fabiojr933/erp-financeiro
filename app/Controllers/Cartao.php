<?php

namespace App\Controllers;

use App\Models\CartaoModel;
use App\Models\UsuarioModel;

class Cartao extends BaseController
{
    private $session;
    private $db;
    private $dbUsuario;
    function __construct()
    {
        $this->session = session();
        $this->db = new CartaoModel();
        $this->dbUsuario = new UsuarioModel();
    }

    public function index()
    {
        $dados['cartao'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        echo View('templates/header', $perfil);
        echo View('cartao/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        echo View('templates/header', $perfil);
        echo View('cartao/formulario');
        echo View('templates/footer');
    }

    public function store()
    {
        $request = request();
        $ativo = $request->getPost('ativo') == 'on' ? 'S' : 'N';
        $id_cartao = $request->getPost('id_cartao');
        $saldo = $request->getPost('saldo');
        $limite = $request->getPost('limite');
        $saldo = str_replace(',', '.', preg_replace('/[^\d,]/', '', $saldo));
        $limite = str_replace(',', '.', preg_replace('/[^\d,]/', '', $limite));

        $dados = [
            'nome'       => $request->getPost('nome'),
            'agencia'    => $request->getPost('agencia'),
            'conta'      => $request->getPost('conta'),
            'vencimento' => $request->getPost('vencimento'),
            'ativo'      => $ativo,
            'tipo'       => $request->getPost('tipo'),
            'limite'     => floatval($limite),
            'saldo'      => floatval($saldo),
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
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['cartao'] = $this->db->where(['id_cartao' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('cartao/visualizar', $data);
        echo View('templates/footer');
    }

    public function editar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['cartao'] = $this->db->where(['id_cartao' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
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
