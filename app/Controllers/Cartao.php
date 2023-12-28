<?php

namespace App\Controllers;

use App\Models\Caixa;
use App\Models\CartaoModel;
use App\Models\lancamentoCredito;
use App\Models\UsuarioModel;

class Cartao extends BaseController
{
    private $session;
    private $db;
    private $dbUsuario;
    private $dbCartaoCredito;
    private $dbcaixa;

    function __construct()
    {
        $this->session = session();
        $this->db = new CartaoModel();
        $this->dbUsuario = new UsuarioModel();
        $this->dbCartaoCredito = new lancamentoCredito();
        $this->dbcaixa = new Caixa();
    }

    public function index()
    {
        $credito['credito'] = $this->db->where(['cartao.id_usuario' => $this->session->get('id_usuario'), 'cartao.tipo' => 'credito', 'lancamentocredito.status' => 'Pendente'])
            ->select('
            lancamentocredito.id_credito,
            lancamentocredito.id_cartao,
            cartao.nome,
            lancamentocredito.valor,
            lancamentocredito.data
        ')
            ->join('lancamentocredito', 'cartao.id_cartao = lancamentocredito.id_cartao')
            ->findAll();

        $dados['cartao'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $cartaoCredito['cartaoCredito'] = $this->db->where(['id_usuario' => $this->session->get('id_usuario'), 'tipo' => 'debito'])->findAll();
        $caixa['caixa'] = $this->dbcaixa->where('id_usuario', $this->session->get('id_usuario'))->findAll();

        $arrayDados = array_merge($credito, $dados, $cartaoCredito, $caixa);
        echo View('templates/header', $perfil);
        echo View('cartao/index', $arrayDados);
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
        //   $saldo = str_replace(',', '.', preg_replace('/[^\d,]/', '', $saldo));
        //   $limite = str_replace(',', '.', preg_replace('/[^\d,]/', '', $limite));

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

    public function pagamentoCredito()
    {
        $request = request();
        $id_pagamento       = $request->getPost('id_pagamento');
        $id_caixa           = $request->getPost('id_caixa');
        $id_cartao          = $request->getPost('id_cartao2');
        $id_credito          = $request->getPost('id_credito');



        if ($id_pagamento == '1') {
            $id_cartao = null;
        } else {
            $id_caixa = null;
        }

        $dadosCredito = $this->dbCartaoCredito->where(['id_usuario' => $this->session->get('id_usuario'), 'id_credito' => $id_credito])->first();

        if ($id_caixa) {
            $caixaSaldo = $this->dbcaixa->where(['id_caixa' => $id_caixa, 'id_usuario' => $this->session->get('id_usuario')])->first();

            if (floatval($dadosCredito['valor']) > floatval($caixaSaldo['saldo'])) {
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
                $dataSaldo = floatval($caixaSaldo['saldo']) - floatval($dadosCredito['valor']);
                $this->dbcaixa->where(['id_usuario' => $this->session->get('id_usuario'), 'id_caixa' => $id_caixa])->set('saldo', $dataSaldo)->update();
            }
        }

        // verifica se for cartao // verifica se ha saldo
        if ($id_cartao) {
            $cartaoSaldo = $this->db->where(['id_cartao' => $id_cartao, 'id_usuario' => $this->session->get('id_usuario')])->first();
            if (floatval($dadosCredito['valor']) > floatval($cartaoSaldo['saldo'])) {
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
                $dataCartaoSaldo = floatval($cartaoSaldo['saldo']) - floatval($dadosCredito['valor']);
                $this->db->where(['id_cartao' => $id_cartao, 'id_usuario' => $this->session->get('id_usuario')])->set('saldo', $dataCartaoSaldo)->update();
            }
        }

        $dadosUpdate = [
            'status'         => 'Pago'
        ];
        $this->dbCartaoCredito->where(['id_credito' => $id_credito, 'id_usuario' => $this->session->get('id_usuario')])->set($dadosUpdate)->update();

        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Documento pago com sucesso'
            ]
        );
        return redirect()->to('cartao');
    }
}
