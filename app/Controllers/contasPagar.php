<?php

namespace App\Controllers;

use App\Models\fornecedor;
use App\Models\contasPagar as ModelscontasPagar;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class contasPagar extends Controller
{
    private $session;
    private $db;
    private $dbfornecedor;
    private $dbUsuario;

    function __construct()
    {
        $this->session = session();
        $this->db = new ModelscontasPagar();
        $this->dbfornecedor = new fornecedor();
        $this->dbUsuario = new UsuarioModel();
    }

    public function index()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contasPagar'] = $this->db->where('contasPagar.id_usuario', $this->session->get('id_usuario'))
            ->select('
            contasPagar.id_contasPagar,
            fornecedor.nome,
            contasPagar.vencimento,
            contasPagar.valor,
            contasPagar.status
        ')
            ->join('fornecedor', 'contasPagar.id_fornecedor = fornecedor.id_fornecedor')
            ->findAll();

        echo View('templates/header', $perfil);
        echo View('contasPagar/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['fornecedor'] = $this->dbfornecedor->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header', $perfil);
        echo View('contasPagar/formulario', $dados);
        echo View('templates/footer');
    }

    public function store()
    {
        $request = request();

        $valor = $request->getPost('valor');
        $valor = str_replace(',', '.', preg_replace('/[^\d,]/', '',  $valor));


        $dados = [
            'status'          => $request->getPost('status'),
            'descricao'       => $request->getPost('descricao'),
            'vencimento'      => $request->getPost('vencimento'),
            'valor'           => floatval($valor),
            'valor_pendente'  => floatval($valor),
            'id_fornecedor'      => intval($request->getPost('id_fornecedor')),
            'id_usuario'      => intval($this->session->get('id_usuario')),
            'observacao'     => $request->getPost('observacao'),
        ];
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Contas a receber cadastrada com sucesso!'
            ]
        );
        // var_dump($dados); exit;
        $this->db->insert($dados);
        return redirect()->to('contasPagar');
    }

    public function visualizar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contasPagar'] = $this->db->where(['contasPagar.id_usuario' => $this->session->get('id_usuario'), 'id_contasPagar' => $id])
            ->select('
            contasPagar.id_contasPagar,
            fornecedor.nome,
            fornecedor.id_fornecedor,
            contasPagar.vencimento,
            contasPagar.valor,
            contasPagar.status,
            contasPagar.observacao,
            contasPagar.descricao,
        ')
            ->join('fornecedor', 'contasPagar.id_fornecedor = fornecedor.id_fornecedor')
            ->first();
        echo View('templates/header', $perfil);
        echo View('contasPagar/visualizar', $dados);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();
        $this->db->where(['id_contasPagar' => $request->getPost('id_contasPagar'), 'id_usuario' => $this->session->get('id_usuario')])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Contas receber excluída com sucesso!'
            ]
        );
        return redirect()->to('/contasPagar');
    }
}
