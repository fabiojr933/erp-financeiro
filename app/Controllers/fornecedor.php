<?php

namespace App\Controllers;

use App\Models\Fornecedor as ModelsFornecedor;

class Fornecedor extends BaseController
{
    private $session;
    private $db;
    function __construct()
    {
        $this->session = session();
        $this->db = new ModelsFornecedor();
    }

    public function index()
    {
        $dados['fornecedor'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header');
        echo View('fornecedor/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {
        echo View('templates/header');
        echo View('fornecedor/formulario');
        echo View('templates/footer');
    }

    public function store()
    {
        $request = request();
        $ativo = $request->getPost('ativo') == 'on' ? 'S' : 'N';
        $id_fornecedor = $request->getPost('id_fornecedor');
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
        if (isset($id_fornecedor)) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'fornecedor alterada com sucesso!'
                ]
            );
            $this->db->where(['id_fornecedor' => $id_fornecedor, 'id_usuario' => $this->session->get('id_usuario')])->set($dados)->update();
        } else {

            //insert  
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'fornecedor cadastrada com sucesso!'
                ]
            );
           
            $this->db->insert($dados);            
        }
        return redirect()->to('fornecedor');
    }

    public function visualizar($id)
    {
        $data['fornecedor'] = $this->db->where(['id_fornecedor' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header');
        echo View('fornecedor/visualizar', $data);
        echo View('templates/footer');
    }

    public function editar($id)
    {
        $data['fornecedor'] = $this->db->where(['id_fornecedor' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header');
        echo View('fornecedor/formulario', $data);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();
        $this->db->where(['id_fornecedor' => $request->getPost('id_fornecedor'), 'id_usuario' => $this->session->get('id_usuario')])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Conta Dre excluída com sucesso!'
            ]
        );
        return redirect()->to('/fornecedor');
    }
}
