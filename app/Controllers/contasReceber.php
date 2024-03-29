<?php

namespace App\Controllers;

use App\Models\baixaContasReceber;
use App\Models\Caixa;
use App\Models\CartaoModel;
use App\Models\Cliente;
use App\Models\contaFluxo;
use App\Models\contasReceber as ModelsContasReceber;
use App\Models\lancReceitaModel;
use App\Models\ReceitaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class contasReceber extends Controller
{
    private $session;
    private $db;
    private $dbCliente;
    private $dbUsuario;
    private $dbCartao;
    private $dbCaixa;
    private $dbFluxo;
    private $dbReceita;
    private $dbBaixaReceber;
    private $dbLancReceita;

    function __construct()
    {
        $this->session = session();
        $this->db = new ModelsContasReceber();
        $this->dbCliente = new Cliente();
        $this->dbUsuario = new UsuarioModel();
        $this->dbCartao = new CartaoModel();
        $this->dbCaixa = new Caixa();
        $this->dbFluxo = new contaFluxo();
        $this->dbReceita = new ReceitaModel();
        $this->dbBaixaReceber = new baixaContasReceber();
        $this->dbLancReceita = new lancReceitaModel();
    }

    public function index()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contasReceber'] = $this->db->where(['contasReceber.id_usuario' => $this->session->get('id_usuario'), 'contasReceber.status' => 'Aberta'])
            ->select('
            contasReceber.id_contasreceber,
            cliente.nome,
            contasReceber.vencimento,
            contasReceber.valor,
            contasReceber.status
        ')
            ->join('cliente', 'contasReceber.id_cliente = cliente.id_cliente')
            ->findAll();

        $dados2['contasReceberPagos'] = $this->db->where(['contasReceber.id_usuario' => $this->session->get('id_usuario'), 'contasReceber.status' => 'Baixado'])
            ->select('
            contasReceber.id_contasreceber,
            cliente.nome,
            contasReceber.vencimento,
            contasReceber.valor,
            contasReceber.status
        ')
            ->join('cliente', 'contasReceber.id_cliente = cliente.id_cliente')
            ->findAll();

        $mergedData = array_merge($dados, $dados2);
        echo View('templates/header', $perfil);
        echo View('contasReceber/index', $mergedData);
        echo View('templates/footer');
    }

    public function novo()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['cliente'] = $this->dbCliente->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header', $perfil);
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

        $this->db->insert($dados);
        return redirect()->to('contasReceber');
    }

    public function visualizar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
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
        echo View('templates/header', $perfil);
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


    public function recebimento()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $dados['contasReceber'] = $this->db->where(['contasReceber.id_usuario' => $this->session->get('id_usuario'), 'contasReceber.status' => 'Aberta'])
            ->select('
            contasReceber.id_contasReceber,
            cliente.nome,
            cliente.razao_social,
            contasReceber.vencimento,
            contasReceber.valor,
            contasReceber.status
        ')
            ->join('cliente', 'contasReceber.id_cliente = cliente.id_cliente')
            ->findAll();

        $fluxo['fluxo'] = $this->dbFluxo->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $receita['receita'] = $this->dbReceita->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $cartao['cartao'] = $this->dbCartao->where(['id_usuario' => $this->session->get('id_usuario'), 'tipo' => 'debito'])->findAll();
        $caixa['caixa'] = $this->dbCaixa->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $mergedData = array_merge($dados, $fluxo, $receita, $cartao, $caixa);
        echo View('templates/header', $perfil);
        echo View('contasReceber/recebimento', $mergedData);
        echo View('templates/footer');
    }

    public function pagamento()
    {
        $request = request();

        $id_pagamento = $request->getPost('id_pagamento');
        $id_caixa = $request->getPost('id_caixa');
        $id_cartao = $request->getPost('id_cartao');
        $id_contasReceber = $request->getPost('id_contasReceber');
        $id_usuario = $this->session->get('id_usuario');
        $valor = $request->getPost('valor_contasReceber');
        $data = date('Y-m-d');


        if ($id_pagamento == '1') {
            $id_cartao = null;
        } else {
            $id_caixa = null;
        }

        $dadosUpdate = [
            'status'         => 'Baixado',
            'valor_pendente' => 0.00,
            'data_pagamento' => $data
        ];
        $this->db->where(['id_contasReceber' => $id_contasReceber, 'id_usuario' => $id_usuario])->set($dadosUpdate)->update();

        $dadosInsert = [
            'origem'           =>  'Contas a Pagar',
            'id_pagamento'     => $id_pagamento,
            'data_pagamento'   => $data,
            'valor'            => $valor,
            'id_receita'       => $request->getPost('id_receita'),
            'id_usuario'       => $id_usuario,
            'id_contasReceber' => $id_contasReceber,
            'id_caixa'         => $id_caixa,
            'id_cartao'        => $id_cartao
        ];

        //alimentando a tabela de baixa 
        $id_rec =  $this->dbBaixaReceber->insert($dadosInsert);

        $receitaLan = [
            'id_receita' => $request->getPost('id_receita'),
            'id_contasReceber' => $id_contasReceber,
            'valor' => $valor,
            'id_usuario'  => $id_usuario
        ];
        $this->dbLancReceita->insert($receitaLan);

        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Conta PAGA com sucesso'
            ]
        );
        return redirect()->to('contasReceber/recebimento');
    }


    public function cancelamento()
    {
        $request = request();

        $id_contasreceber = $request->getPost('id_contasreceber2');
        $id_usuario   = $this->session->get('id_usuario');

        $dadosCancelamento = $this->db->where(['id_contasReceber' => $id_contasreceber, 'id_usuario' => $id_usuario])->first();

        $dadosUpdate = [
            'status'         => 'Aberta',
            'valor_pendente' => $dadosCancelamento['valor']
        ];
        $this->dbBaixaReceber->where(['id_contasReceber' => $id_contasreceber, 'id_usuario' => $id_usuario])->delete();
        $this->db->where(['id_contasReceber' => $id_contasreceber, 'id_usuario' => $id_usuario])->set($dadosUpdate)->update();
        $this->dbLancReceita->where(['id_usuario' => $this->session->get('id_usuario'), 'id_lancamento' => $id_contasreceber])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Conta a receber foi reaberto'
            ]
        );
        return redirect()->to('contasReceber');
    }
}
