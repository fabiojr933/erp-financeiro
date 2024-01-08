<?php

namespace App\Controllers;

use App\Models\contasPagar;
use App\Models\Fornecedor as ModelsFornecedor;
use App\Models\lancamento;
use App\Models\UsuarioModel;

class Fornecedor extends BaseController
{
    private $session;
    private $db;
    private $dbUsuario;
    private $dbLancamento;
    private $dbPagar;

    function __construct()
    {
        $this->session = session();
        $this->db = new ModelsFornecedor();
        $this->dbUsuario = new UsuarioModel();
        $this->dbLancamento = new lancamento();
        $this->dbPagar = new contasPagar();
    }

    public function index()
    {

        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['fornecedor'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header', $perfil);
        echo View('fornecedor/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {

        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        echo View('templates/header', $perfil);
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

        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['fornecedor'] = $this->db->where(['id_fornecedor' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('fornecedor/visualizar', $data);
        echo View('templates/footer');
    }

    public function editar($id)
    {

        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['fornecedor'] = $this->db->where(['id_fornecedor' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('fornecedor/formulario', $data);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();

        $lanc = $this->dbLancamento->where(['id_fornecedor' => $request->getPost('id_fornecedor'), 'id_usuario' => $this->session->get('id_usuario')])->countAllResults('lancamento');
        $receber = $this->dbPagar->where(['id_fornecedor' => $request->getPost('id_fornecedor'), 'id_usuario' => $this->session->get('id_usuario')])->countAllResults('baixa_conta_pagar');
       
        if ($lanc > 0 || $receber > 0) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'danger',
                    'titulo' => 'Não é possivel excluir, ja existe lançamento vinculado a esse FORNECEDOR!'
                ]
            );
            return redirect()->to('/fornecedor');
        }

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
