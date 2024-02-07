<?php

namespace App\Controllers;

use App\Models\baixaContasPagar;
use App\Models\baixaContasReceber;
use App\Models\Caixa;
use App\Models\CartaoModel;
use App\Models\lancamento;
use App\Models\lancamentoCredito;
use App\Models\UsuarioModel;

class Cartao extends BaseController
{
    private $session;
    private $db;
    private $dbUsuario; 
    private $dbLancamento;    

    function __construct()
    {
        $this->session = session();
        $this->db = new CartaoModel();
        $this->dbUsuario = new UsuarioModel();
        $this->dbLancamento = new lancamento();   
    }

    public function index()
    {     

        $dados['cartao'] = $this->db->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();
        $arrayDados = array_merge($dados);
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
        //   $saldo = str_replace(',', '.', preg_replace('/[^\d,]/', '', $saldo));
        //   $limite = str_replace(',', '.', preg_replace('/[^\d,]/', '', $limite));

        $dados = [
            'nome'       => $request->getPost('nome'),
            'ativo'      => $ativo,
            'tipo'       => $request->getPost('tipo'),
            'id_usuario' => $this->session->get('id_usuario'),
        ];
       
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
        $lanc = $this->dbLancamento->where(['id_cartao' => $request->getPost('id_cartao'), 'id_usuario' => $this->session->get('id_usuario')])->countAllResults('lancamento');
        
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
}
