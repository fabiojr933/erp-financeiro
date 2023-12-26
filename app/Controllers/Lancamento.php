<?php

namespace App\Controllers;

use App\Models\Caixa;
use App\Models\CartaoModel;
use App\Models\Cliente;
use App\Models\contaFluxo;
use App\Models\Fornecedor;
use App\Models\lancamento as ModelsLancamento;
use App\Models\lancamentoCredito;
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
    private $dbLancCredito;

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
        $this->dbLancCredito = new lancamentoCredito();
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

        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Lançamento feito com sucesso com sucesso!'
            ]
        );


        if ($id_caixa) {
            $caixaSaldo = $this->dbCaixa->where(['id_caixa' => $id_caixa, 'id_usuario' => $id_usuario])->first();

            if (floatval($valor) > floatval($caixaSaldo['saldo'])) {
                $this->session->setFlashdata(
                    'alert',
                    [
                        'tipo'  => 'sucesso',
                        'cor'   => 'danger',
                        'titulo' => 'Não foi possivel fazer esse lançamento, SALDO insuficiente no caixa!'
                    ]
                );
                return redirect()->to('lancamento');
            } else {
                $id = $this->dbLancamento->insert($data);
                $dataSaldo = floatval($caixaSaldo['saldo']) - floatval($valor);
                $this->dbCaixa->where(['id_usuario' => $id_usuario, 'id_caixa' => $id_caixa])->set('saldo', $dataSaldo)->update();
            }
        }
        if ($id_cartao) {
            $cartaoSaldo = $this->dbCartao->where(['id_cartao' => $id_cartao, 'id_usuario' => $id_usuario])->first();
            if ($cartaoSaldo['tipo'] == 'credito') {
                if (floatval($valor) > floatval($cartaoSaldo['limite'])) {
                    $this->session->setFlashdata(
                        'alert',
                        [
                            'tipo'  => 'sucesso',
                            'cor'   => 'danger',
                            'titulo' => 'Não foi possivel fazer esse lançamento, LIMITE insuficiente no cartão!'
                        ]
                    );
                    return redirect()->to('lancamento');
                } else {
                    $dataCartaoSaldo = floatval($cartaoSaldo['limite']) - floatval($valor);
                    $id = $this->dbLancamento->insert($data);
                    $credito = [
                        'id_lancamento'         => $id,
                        'id_cartao'             => $id_cartao,
                        'valor'                 => $valor,
                        'id_usuario'            => $id_usuario,
                        'status'                => 'Pendente'
                    ];
                    $this->dbCartao->where(['id_cartao' => $id_cartao, 'id_usuario' => $id_usuario])->set('saldo', $dataCartaoSaldo)->update();
                    $this->dbLancCredito->insert($credito);
                }
            } else {
                if (floatval($valor) > floatval($cartaoSaldo['saldo'])) {
                    $this->session->setFlashdata(
                        'alert',
                        [
                            'tipo'  => 'sucesso',
                            'cor'   => 'danger',
                            'titulo' => 'Não foi possivel fazer esse lançamento, SALDO insuficiente no cartão!'
                        ]
                    );
                    return redirect()->to('lancamento');
                } else {
                    $dataCartaoSaldo = floatval($cartaoSaldo['saldo']) - floatval($valor);
                    $id = $this->dbLancamento->insert($data);
                    $this->dbCartao->where(['id_cartao' => $id_cartao, 'id_usuario' => $id_usuario])->set('saldo', $dataCartaoSaldo)->update();
                }
            }
        }

        return redirect()->to('lancamento');
    }
    public function excluir()
    {
        $request = request();
        $id_lancamento = $request->getPost('id_lancamento');
        $lancamento = $this->dbLancamento->where(['id_usuario' => $this->session->get('id_usuario'), 'id_lancamento' => $id_lancamento])->first();

        if ($lancamento['id_cartao']) {
            $cartaoSaldo = $this->dbCartao->where(['id_cartao' => $lancamento['id_cartao'], 'id_usuario' => $this->session->get('id_usuario')])->first();
            if ($cartaoSaldo['tipo'] == 'debito') {
                $dataCartaoSaldo = floatval($cartaoSaldo['saldo']) + floatval($lancamento['valor']);
                $this->dbCartao->where(['id_cartao' => $lancamento['id_cartao'], 'id_usuario' => $this->session->get('id_usuario')])->set('saldo', $dataCartaoSaldo)->update();
            } else {
                $dataCartaoSaldo = floatval($cartaoSaldo['limite']) + floatval($lancamento['valor']);
                $this->dbCartao->where(['id_cartao' => $lancamento['id_cartao'], 'id_usuario' => $this->session->get('id_usuario')])->set('limite', $dataCartaoSaldo)->update();
            }
            $this->dbLancCredito->where(['id_usuario' => $this->session->get('id_usuario'), 'id_lancamento' => $id_lancamento])->delete();
        }

        if ($lancamento['id_caixa']) {
            $caixaSaldo = $this->dbCaixa->where(['id_caixa' => $lancamento['id_caixa'], 'id_usuario' => $this->session->get('id_usuario')])->first();
            $dataSaldo = floatval($caixaSaldo['saldo']) + floatval($lancamento['valor']);

            $this->dbCaixa->where(['id_usuario' => $this->session->get('id_usuario'), 'id_caixa' => $lancamento['id_caixa']])->set('saldo', $dataSaldo)->update();
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
