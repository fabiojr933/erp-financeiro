<?php

namespace App\Controllers;

use App\Models\baixaContasPagar;
use App\Models\baixaContasReceber;
use App\Models\caixa as ModelsCaixa;
use App\Models\contasPagar;
use App\Models\contasReceber;
use App\Models\lancamento;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Caixa extends Controller
{
    private $session;
    private $db;
    private $dbUsuario;
    private $dbLancamento;
    private $dbReceber;
    private $dbPagar;

    function __construct()
    {
        $this->session = session();
        $this->db = new ModelsCaixa();
        $this->dbUsuario = new UsuarioModel();
        $this->dbLancamento = new lancamento();
        $this->dbReceber = new baixaContasReceber();
        $this->dbPagar = new baixaContasPagar();
    }

    public function index()
    {
        $dados['caixa'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        echo View('templates/header', $perfil);
        echo View('caixa/index', $dados);
        echo View('templates/footer');
    }

    public function novo()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        echo View('templates/header', $perfil);
        echo View('caixa/formulario');
        echo View('templates/footer');
    }

    public function store()
    {
        $request = request();
        $id_caixa = $request->getPost('id_caixa');
        $saldo = $request->getPost('saldo');
        // $saldo = str_replace(',', '.', preg_replace('/[^\d,]/', '', $saldo));       

        $dados = [
            'nome'       => $request->getPost('nome'),
            'saldo'      => floatval($saldo),
            'id_usuario' => $this->session->get('id_usuario'),
        ];

        //Update
        if (isset($id_caixa)) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Caixa alterada com sucesso!'
                ]
            );
            $this->db->where(['id_caixa' => $id_caixa, 'id_usuario' => $this->session->get('id_usuario')])->set($dados)->update();
        } else {
            //insert  
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Caixa cadastrada com sucesso!'
                ]
            );
            $this->db->insert($dados);
        }
        return redirect()->to('caixa');
    }

    public function visualizar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['caixa'] = $this->db->where(['id_caixa' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('caixa/visualizar', $data);
        echo View('templates/footer');
    }

    public function editar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['caixa'] = $this->db->where(['id_caixa' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('caixa/formulario', $data);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();
        $lanc = $this->dbLancamento->where(['id_caixa' => $request->getPost('id_caixa'), 'id_usuario' => $this->session->get('id_usuario')])->countAllResults('lancamento');
        $pagar = $this->dbPagar->where(['id_caixa' => $request->getPost('id_caixa'), 'id_usuario' => $this->session->get('id_usuario')])->countAllResults('baixa_conta_pagar');
        $receber = $this->dbReceber->where(['id_caixa' => $request->getPost('id_caixa'), 'id_usuario' => $this->session->get('id_usuario')])->countAllResults('baixa_conta_receber');
       
        if ($lanc > 0 || $pagar > 0 || $receber > 0) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'danger',
                    'titulo' => 'Não é possivel excluir, ja existe lançamento vinculado a esse caixa!'
                ]
            );
            return redirect()->to('/caixa');
        }
        $this->db->where(['id_caixa' => $request->getPost('id_caixa'), 'id_usuario' => $this->session->get('id_usuario')])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Caixa excluída com sucesso!'
            ]
        );
        return redirect()->to('/caixa');
    }
}

//selectCount