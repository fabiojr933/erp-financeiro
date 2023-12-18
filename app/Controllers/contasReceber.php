<?php

namespace App\Controllers;

use App\Models\Cliente;
use App\Models\contasReceber as ModelsContasReceber;
use CodeIgniter\Controller;

class contasReceber extends Controller
{
    private $session;
    private $db;
    private $dbCliente;

    function __construct()
    {
        $this->session = session();
        $this->db = new ModelsContasReceber();
        $this->dbCliente = new Cliente();
    }

    public function index()
    {
        $dados['contasReceber'] = $this->db->where('contasReceber.id_usuario', $this->session->get('id_usuario'))
            ->select('
            contasReceber.id_contasreceber,
            cliente.nome,
            contasReceber.vencimento,
            contasReceber.valor,
            contasReceber.status
        ')
            ->join('cliente', 'contasReceber.id_cliente = cliente.id_cliente')
            ->findAll();

        echo View('templates/header');
        echo View('contasReceber/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {
        $dados['cliente'] = $this->dbCliente->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header');
        echo View('contasReceber/formulario', $dados);
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
            'id_cliente'      => intval($request->getPost('id_cliente')),
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
        return redirect()->to('contasReceber');
    }

    public function visualizar($id)
    {
        $dados['contasReceber'] = $this->db->where(['contasReceber.id_usuario' => $this->session->get('id_usuario'), 'id_contasreceber' => $id])
            ->select('
            contasReceber.id_contasreceber,
            cliente.nome,
            cliente.id_cliente,
            contasReceber.vencimento,
            contasReceber.valor,
            contasReceber.status,
            contasReceber.observacao,
            contasReceber.descricao,
        ')
            ->join('cliente', 'contasReceber.id_cliente = cliente.id_cliente')
            ->first();
        echo View('templates/header');
        echo View('contasReceber/visualizar', $dados);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();
        $this->db->where(['id_contasreceber' => $request->getPost('id_contasreceber'), 'id_usuario' => $this->session->get('id_usuario')])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Contas receber excluída com sucesso!'
            ]
        );
        return redirect()->to('/contasReceber');
    }

}
