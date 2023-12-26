<?php

namespace App\Controllers;

use App\Models\baixaContasPagar;
use App\Models\Caixa;
use App\Models\CartaoModel;
use App\Models\contaFluxo;
use App\Models\fornecedor;
use App\Models\contasPagar as ModelscontasPagar;
use App\Models\ReceitaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class contasPagar extends Controller
{
    private $session;
    private $db;
    private $dbfornecedor;
    private $dbUsuario;
    private $dbFluxo;
    private $dbReceita;
    private $dbBaixaPagar;
    private $dbCartao;
    private $dbCaixa;

    function __construct()
    {
        $this->session = session();
        $this->db = new ModelscontasPagar();
        $this->dbfornecedor = new fornecedor();
        $this->dbUsuario = new UsuarioModel();
        $this->dbFluxo = new contaFluxo();
        $this->dbReceita = new ReceitaModel();
        $this->dbBaixaPagar = new baixaContasPagar();
        $this->dbCartao = new CartaoModel();
        $this->dbCaixa = new Caixa();
    }

    public function index()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contasPagar'] = $this->db->where(['contasPagar.id_usuario' => $this->session->get('id_usuario'), 'contasPagar.status' => 'Aberta'])
            ->select('
            contasPagar.id_contasPagar,
            fornecedor.nome,
            fornecedor.razao_social,
            contasPagar.vencimento,
            contasPagar.valor,
            contasPagar.status
        ')
            ->join('fornecedor', 'contasPagar.id_fornecedor = fornecedor.id_fornecedor')
            ->findAll();


        $dados2['contasPagarPagos'] = $this->db->where(['contasPagar.id_usuario' => $this->session->get('id_usuario'), 'contasPagar.status' => 'Baixado'])
            ->select('
            contasPagar.id_contasPagar,
            fornecedor.nome,
            fornecedor.razao_social,
            contasPagar.vencimento,
            contasPagar.valor,
            contasPagar.status
        ')
            ->join('fornecedor', 'contasPagar.id_fornecedor = fornecedor.id_fornecedor')
            ->findAll();

        $mergedData = array_merge($dados, $dados2);

        echo View('templates/header', $perfil);
        echo View('contasPagar/index', $mergedData);
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
                'titulo' => 'Contas a pagar cadastrada com sucesso!'
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
            fornecedor.razao_social,
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
                'titulo' => 'Contas pagar excluída com sucesso!'
            ]
        );
        return redirect()->to('/contasPagar');
    }

    public function recebimento()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contasPagar'] = $this->db->where(['contasPagar.id_usuario' => $this->session->get('id_usuario'), 'contasPagar.status' => 'Aberta'])
            ->select('
            contasPagar.id_contasPagar,
            fornecedor.nome,
            fornecedor.razao_social,
            contasPagar.vencimento,
            contasPagar.valor,
            contasPagar.status
        ')
            ->join('fornecedor', 'contasPagar.id_fornecedor = fornecedor.id_fornecedor')
            ->findAll();

        $fluxo['fluxo'] = $this->dbFluxo->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $receita['receita'] = $this->dbReceita->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $cartao['cartao'] = $this->dbCartao->where(['id_usuario' => $this->session->get('id_usuario'), 'tipo' => 'debito'])->findAll();
        $caixa['caixa'] = $this->dbCaixa->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $mergedData = array_merge($dados, $fluxo, $receita, $cartao, $caixa);
        echo View('templates/header', $perfil);
        echo View('contasPagar/recebimento', $mergedData);
        echo View('templates/footer');
    }

    public function pagamento()
    {
        $request = request();
        $id_pagamento       = $request->getPost('id_pagamento');
        $id_caixa           = $request->getPost('id_caixa');
        $id_cartao          = $request->getPost('id_cartao');
        $id_contasPagar     = $request->getPost('id_contasPagar');
        $id_usuario         = $this->session->get('id_usuario');
        $valor              = $request->getPost('valor_contasPagar');
        $data               = date('Y-m-d');
        $ip_tipo            = $request->getPost('ip_tipo');


        if ($id_pagamento == '1') {
            $id_cartao = null;
        } else {
            $id_caixa = null;
        }

        // verifica se for dinheiro // verifica se ha saldo
        if ($id_caixa) {
            $caixaSaldo = $this->dbCaixa->where(['id_caixa' => $id_caixa, 'id_usuario' => $this->session->get('id_usuario')])->first();

            if (floatval($valor) > floatval($caixaSaldo['saldo'])) {
                $this->session->setFlashdata(
                    'alert',
                    [
                        'tipo'  => 'sucesso',
                        'cor'   => 'danger',
                        'titulo' => 'Não foi possivel fazer o pagamento, SALDO insuficiente no caixa!'
                    ]
                );
                return redirect()->to('contasPagar/recebimento');
            } else {
                $dataSaldo = floatval($caixaSaldo['saldo']) - floatval($valor);
                $this->dbCaixa->where(['id_usuario' => $id_usuario, 'id_caixa' => $id_caixa])->set('saldo', $dataSaldo)->update();
            }
        }

        // verifica se for cartao // verifica se ha saldo
        if ($id_cartao) {
            $cartaoSaldo = $this->dbCartao->where(['id_cartao' => $id_cartao, 'id_usuario' => $this->session->get('id_usuario')])->first();
            if (floatval($valor) > floatval($cartaoSaldo['saldo'])) {
                $this->session->setFlashdata(
                    'alert',
                    [
                        'tipo'  => 'sucesso',
                        'cor'   => 'danger',
                        'titulo' => 'Não foi possivel fazer o pagamento, SALDO insuficiente no cartão!'
                    ]
                );
                return redirect()->to('contasPagar/recebimento');
            } else {
                $dataCartaoSaldo = floatval($cartaoSaldo['saldo']) - floatval($valor);
                $this->dbCartao->where(['id_cartao' => $id_cartao, 'id_usuario' => $id_usuario])->set('saldo', $dataCartaoSaldo)->update();
            }
        }

        $dadosUpdate = [
            'status'         => 'Baixado',
            'valor_pendente' => 0.00
        ];
        $this->db->where(['id_contasPagar' => $id_contasPagar, 'id_usuario' => $id_usuario])->set($dadosUpdate)->update();

        $dadosInsert = [
            'origem'         =>  'Contas a Pagar',
            'id_pagamento'   => $id_pagamento,
            'data_pagamento' => $data,
            'valor'          => $valor,
            'id_despesa'     => $request->getPost('id_fluxo'),
            'id_usuario'     => $id_usuario,
            'id_contasPagar' => $id_contasPagar,
            'id_caixa'       => $id_caixa,
            'id_cartao'      => $id_cartao
        ];

        //alimentando a tabela de baixa     

        $this->dbBaixaPagar->insert($dadosInsert);

        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Conta PAGA com sucesso'
            ]
        );
        return redirect()->to('contasPagar/recebimento');
    }

    public function cancelamento()
    {

       
        $request = request();

        $id_contasPagar = $request->getPost('id_contasPagar2');
        $id_usuario   = $this->session->get('id_usuario');
     
        $dadosCancelamento = $this->dbBaixaPagar->where(['id_contasPagar' => $id_contasPagar, 'id_usuario' => $id_usuario])->first();

    


        if ($dadosCancelamento['id_caixa']) {
            $caixaSaldo = $this->dbCaixa->where(['id_caixa' => $dadosCancelamento['id_caixa'], 'id_usuario' => $id_usuario])->first();
            $dataSaldo = floatval($caixaSaldo['saldo']) + floatval($dadosCancelamento['valor']);

            $this->dbCaixa->where(['id_usuario' => $id_usuario, 'id_caixa' => $dadosCancelamento['id_caixa']])->set('saldo', $dataSaldo)->update();
        }
        if ($dadosCancelamento['id_cartao']) {
            $cartaoSaldo = $this->dbCartao->where(['id_cartao' => $dadosCancelamento['id_cartao'], 'id_usuario' => $id_usuario])->first();
            $dataCartaoSaldo = floatval($cartaoSaldo['saldo']) + floatval($dadosCancelamento['valor']);
            $this->dbCartao->where(['id_cartao' => $dadosCancelamento['id_cartao'], 'id_usuario' => $id_usuario])->set('saldo', $dataCartaoSaldo)->update();
        }

        $dadosUpdate = [
            'status'         => 'Aberta',
            'valor_pendente' => $dadosCancelamento['valor']
        ];
        $this->db->where(['id_contasPagar' => $id_contasPagar, 'id_usuario' => $id_usuario])->set($dadosUpdate)->update();
        $this->dbBaixaPagar->where(['id_contasPagar' => $id_contasPagar, 'id_usuario' => $id_usuario])->delete();

        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Conta a pagar foi reaberto'
            ]
        );
        return redirect()->to('contasPagar');
    }
}
