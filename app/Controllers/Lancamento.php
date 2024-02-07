<?php

namespace App\Controllers;

use App\Models\Caixa;
use App\Models\CartaoModel;
use App\Models\Cliente;
use App\Models\contaFluxo;
use App\Models\Fornecedor;
use App\Models\lancamento as ModelsLancamento;
use App\Models\lancamentoCredito;
use App\Models\lancDespesaModel;
use App\Models\lancReceitaModel;
use App\Models\ReceitaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Lancamento extends Controller
{

    private $session;
    private $dbLancamento;
    private $dbUsuario;
    private $dbFornecedor;
    private $dbCartao;
    private $dbCaixa;
    private $dbCliente;
    private $dbReceita;
    private $dbDespesa;
    private $dbLancReceita;
    private $dbLancDespesa;

    function __construct()
    {
        $this->session = session();
        $this->dbLancamento = new ModelsLancamento();
        $this->dbUsuario = new UsuarioModel();
        $this->dbFornecedor = new Fornecedor();
        $this->dbCartao = new CartaoModel();
        $this->dbCaixa = new Caixa();
        $this->dbCliente = new Cliente();
        $this->dbReceita = new ReceitaModel();
        $this->dbDespesa = new contaFluxo();
        $this->dbLancDespesa = new lancDespesaModel();
        $this->dbLancReceita = new lancReceitaModel();
    }

    public function index()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $lancamento['lancamento'] = $this->dbLancamento->where('lancamento.id_usuario', $this->session->get('id_usuario'))
            ->select('
        lancamento.id_lancamento,       
        lancamento.tipo,
        lancamento.descricao,
        lancamento.valor,
        lancamento.data_pagamento
    ')->findAll();

        echo View('templates/header', $perfil);
        echo View('lancamento/index', $lancamento);
        echo View('templates/footer');
    }

    public function novo()
    {
        $perfil['perfil']         = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $fornecedor['fornecedor'] = $this->dbFornecedor->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $cartao['cartao']         = $this->dbCartao->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $caixa['caixa']           = $this->dbCaixa->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $cliente['cliente']       = $this->dbCliente->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $receita['receita']       = $this->dbReceita->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $despesa['despesa']       = $this->dbDespesa->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $arrayDados = array_merge($fornecedor, $cartao, $caixa, $cliente, $receita, $despesa);
        echo View('templates/header', $perfil);
        echo View('lancamento/formulario', $arrayDados);
        echo View('templates/footer');
    }
    public function store()
    {
        $request = request();

        $tipo = $request->getPost('tipo');
        $id_receita  = $request->getPost('id_receita');
        $id_fluxo = $request->getPost('id_despesa');

        $pagamento = $request->getPost('pagamento');
        $id_caixa = $request->getPost('dinheiro');
        $id_cartao = $request->getPost('outros');

        $tipo_cli_for = $request->getPost('tipo_cli_for');
        $id_fornecedor = $request->getPost('id_fornecedor');
        $id_cliente = $request->getPost('id_cliente');

        $id_usuario = $this->session->get('id_usuario');
        $valor  = $request->getPost('valor');
        $valor = str_replace(',', '.', preg_replace('/[^\d,]/', '',  $valor));

        if ($tipo == 'despesa') {
            $id_receita = null;
        }
        if ($tipo == 'receita') {
            $id_fluxo = null;
        }
        if ($pagamento == 'dinheiro') {
            $id_cartao = null;
        }
        if ($pagamento == 'outros') {
            $id_caixa = null;
        }
        if ($tipo_cli_for == 'cliente') {
            $id_fornecedor = null;
        }
        if ($tipo_cli_for == 'fornecedor') {
            $id_cliente = null;
        }

        $data = [
            'tipo' => $request->getPost('tipo'),
            'descricao' => $request->getPost('descricao'),
            'data_pagamento' => $request->getPost('data_pagamento'),
            'valor' => $valor,
            'tipo' => $tipo,
            'id_caixa' => $id_caixa,
            'id_cartao' => $id_cartao,
            'id_fornecedor' => $id_fornecedor,
            'id_cliente' => $id_cliente,
            'id_receita' => $id_receita,
            'id_fluxo'  => $id_fluxo,
            'observacao' => $request->getPost('observacao'),
            'id_usuario'    => $id_usuario,
        ];




        $id = $this->dbLancamento->insert($data);

        if ($tipo == 'despesa') {
            $despesaLan = [
                'id_contaFluxo' => $id_fluxo,
                'id_lancamento' => $id,
                'valor' => $valor,
                'id_usuario'  => $id_usuario
            ];
            $this->dbLancDespesa->insert($despesaLan);
        } else {
            $receitaLan = [
                'id_receita' => $id_receita,
                'id_lancamento' => $id,
                'valor' => $valor,
                'id_usuario'  => $id_usuario
            ];
            $this->dbLancReceita->insert($receitaLan);
        }

        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Lançamento feito com sucesso com sucesso!'
            ]
        );
        return redirect()->to('lancamento');
    }


    public function excluir()
    {
        $request = request();
        $id_lancamento = $request->getPost('id_lancamento');
        $tipo = $this->dbLancamento->where(['id_usuario' => $this->session->get('id_usuario'), 'id_lancamento' => $id_lancamento])->first();
        if ($tipo['tipo'] == 'despesa') {
            $this->dbLancDespesa->where(['id_usuario' => $this->session->get('id_usuario'), 'id_lancamento' => $id_lancamento])->delete();
        } else {
            $this->dbLancReceita->where(['id_usuario' => $this->session->get('id_usuario'), 'id_lancamento' => $id_lancamento])->delete();
        }
        $this->dbLancamento->where(['id_usuario' => $this->session->get('id_usuario'), 'id_lancamento' => $id_lancamento])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Lançamento excluido com sucesso'
            ]
        );
        return redirect()->to('lancamento');
    }
}
