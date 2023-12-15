<?php

namespace App\Controllers;

use App\Models\Cliente as ModelsCliente;
use App\Models\contaDre;

class Cliente extends BaseController
{
    private $session;
    private $db;
    function __construct()
    {
        $this->session = session();
        $this->db = new ModelsCliente();
    }

    public function index()
    {
        $dados['cliente'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header');
        echo View('cliente/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {
        echo View('templates/header');
        echo View('cliente/formulario');
        echo View('templates/footer');
    }

    public function store()
    {
        $request = request();
        $ativo = $request->getPost('ativo') == 'on' ? 'S' : 'N';
        $id_cliente = $request->getPost('id_cliente');
        $dados = [
            'nome'          => $request->getPost('nome'),
            'ativo'         => $ativo,
            'tipo'          => $request->getPost('tipo'),
            'cpf'           => $request->getPost('cpf'),
            'cnpj'           => $request->getPost('cnpj'),
            'razao_social'  => $request->getPost('razao_social'),
            'isento'        => $request->getPost('isento'),
            'ie'            => $request->getPost('ie'),
            'cep'           => $request->getPost('cep'),
            'logradouro'    => $request->getPost('logradouro'),
            'numero'        => $request->getPost('numero'),
            'complemento'   => $request->getPost('complemento'),
            'bairro'        => $request->getPost('bairro'),
            'estado'        => $request->getPost('estado'),
            'cidade'        => $request->getPost('cidade'),
            'fixo'          => $request->getPost('fixo'),
            'celular_1'     => $request->getPost('celular_1'),
            'celular_2'     => $request->getPost('celular_2'),
            'email'         => $request->getPost('email'),
            'id_usuario'    => $this->session->get('id_usuario'),
        ];

        //Update
        if (isset($id_cliente)) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Cliente alterada com sucesso!'
                ]
            );
            $this->db->where(['id_cliente' => $id_cliente, 'id_usuario' => $this->session->get('id_usuario')])->set($dados)->update();
        } else {

            //insert  
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Cliente cadastrada com sucesso!'
                ]
            );
           
            $this->db->insert($dados);            
        }
        return redirect()->to('cliente');
    }

    public function visualizar($id)
    {
        $data['cliente'] = $this->db->where(['id_cliente' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header');
        echo View('cliente/visualizar', $data);
        echo View('templates/footer');
    }

    public function editar($id)
    {
        $data['cliente'] = $this->db->where(['id_cliente' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header');
        echo View('cliente/formulario', $data);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();
        $this->db->where(['id_cliente' => $request->getPost('id_cliente'), 'id_usuario' => $this->session->get('id_usuario')])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Conta Dre excluída com sucesso!'
            ]
        );
        return redirect()->to('/cliente');
    }
}
