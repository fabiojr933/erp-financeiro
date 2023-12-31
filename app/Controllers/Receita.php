<?php

namespace App\Controllers;

use App\Models\baixaContasReceber;
use App\Models\lancamento;
use App\Models\ReceitaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Receita extends Controller
{
    private $session;
    private $db;
    private $dbUsuario;
    private $dbLancamento;
    private $dbReceber;

    function __construct()
    {
        $this->session = session();
        $this->db = new ReceitaModel();
        $this->dbUsuario = new UsuarioModel();
        $this->dbLancamento = new lancamento();
        $this->dbReceber = new baixaContasReceber();
    }

    public function index()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['receita'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        echo View('templates/header', $perfil);
        echo View('Receita/index', $data);
        echo View('templates/footer');
    }

    public function novo()
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        echo View('templates/header', $perfil);
        echo View('Receita/novo');
        echo View('templates/footer');
    }

    public function store()
    {
        $request = request();
        $ativo = $request->getPost('ativo') == 'on' ? 'S' : 'N';
        $id_receita = $request->getPost('id_receita');
        $dados = [
            'nome'  => $request->getPost('nome'),
            'ativo' => $ativo,
            'id_usuario' => $this->session->get('id_usuario')
        ];

        //Update
        if (isset($id_receita)) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'primary',
                    'titulo' => 'Receita alterada com sucesso!'
                ]
            );
            $this->db->where(['id_receita' => $id_receita, 'id_usuario' => $this->session->get('id_usuario')])->set($dados)->update();
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
        return redirect()->to('receita');
    }

    public function editar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['receita'] = $this->db->where(['id_receita' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('Receita/novo', $data);
        echo View('templates/footer');
    }

    public function excluir()
    {
        $request = request();
        $id = $request->getPost('id_receita');

        $lanc = $this->dbLancamento->where(['id_caixa' => $id, 'id_usuario' => $this->session->get('id_usuario')])->countAllResults('lancamento');       
        $receber = $this->dbReceber->where(['id_caixa' => $id, 'id_usuario' => $this->session->get('id_usuario')])->countAllResults('baixa_conta_receber');
       
        if ($lanc > 0 || $receber > 0) {
            $this->session->setFlashdata(
                'alert',
                [
                    'tipo'  => 'sucesso',
                    'cor'   => 'danger',
                    'titulo' => 'Não é possivel excluir, ja existe lançamento vinculado a essa receita!'
                ]
            );
            return redirect()->to('/receita');
        }
        $this->db->where(['id_receita' => $id, 'id_usuario' => $this->session->get('id_usuario')])->delete();
        $this->session->setFlashdata(
            'alert',
            [
                'tipo'  => 'sucesso',
                'cor'   => 'primary',
                'titulo' => 'Receita excluída com sucesso!'
            ]
        );
        return redirect()->to('/receita');
    }

    public function visualizar($id)
    {
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $data['receita'] = $this->db->where(['id_receita' => $id, 'id_usuario' => $this->session->get('id_usuario')])->first();
        echo View('templates/header', $perfil);
        echo View('Receita/visualizar', $data);
        echo View('templates/footer');
    }
}
