<?php

namespace App\Controllers;

use App\Models\baixaContasPagar;
use App\Models\contasPagar;
use App\Models\contasReceber;
use App\Models\lancamento;
use App\Models\lancamentoCredito;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use DateTime;

class Inicio extends Controller
{
    private $session;
    private $dbUsuario;
    private $dbReceber;
    private $dbPagar;
    private $dbCredito;
    private $dbLancamento;
    private $dbContasPagas;

    function __construct()
    {
        $this->session = session();
        $this->dbUsuario = new UsuarioModel();
        $this->dbReceber = new contasReceber();
        $this->dbPagar = new contasPagar();
        $this->dbCredito = new lancamentoCredito();
        $this->dbLancamento = new lancamento();
        $this->dbContasPagas = new baixaContasPagar();
    }
    public function index()
    {
        $dataAtual = new DateTime();
        $ano = $dataAtual->format('Y');
        $mes = $dataAtual->format('m');
        $datasMes = self::obterDatasMes($ano, $mes);

        $data_inicial = $datasMes['inicial'];
        $data_final = $datasMes['final'];

        $id_usuario = $this->session->get('id_usuario');
        $data['perfil'] = $this->dbUsuario->where('id_usuario', $id_usuario)->first();

        $contasReceber['contasReceber'] = $this->dbReceber
            ->where(['id_usuario' => $id_usuario, 'status' => 'Aberta', 'vencimento >=' => $data_inicial, 'vencimento <=' => $data_final])
            ->selectSum('valor', 'totalReceber')->get()->getRow()->totalReceber;

        $contasPagar['contasPagar'] = $this->dbPagar
            ->where(['id_usuario' => $id_usuario, 'status' => 'Aberta', 'vencimento >=' => $data_inicial, 'vencimento <=' => $data_final])
            ->selectSum('valor', 'totalPagar')->get()->getRow()->totalPagar;

        $contasCredito['contasCredito'] = $this->dbCredito
            ->where(['id_usuario' => $id_usuario, 'status' => 'Pendente', 'data >=' => $data_inicial, 'data <=' => $data_final])
            ->selectSum('valor', 'totalCreditoPagar')->get()->getRow()->totalCreditoPagar;

        $Receita01 = $this->dbReceber
            ->where(['id_usuario' => $id_usuario, 'status' => 'Baixado', 'vencimento >=' => $data_inicial, 'vencimento <=' => $data_final])
            ->selectSum('valor', 'Receita01')->get()->getRow()->Receita01;

        $Receita02 = $this->dbLancamento
            ->where(['tipo' => 'receita', 'id_usuario' => $id_usuario, 'data_pagamento >=' => $data_inicial, 'data_pagamento <=' => $data_final])
            ->selectSum('valor', 'Receita02')->get()->getRow()->Receita02;

        $totalReceita['totalReceita'] = $Receita02 + $Receita01;

        $despesa01 = $this->dbPagar
            ->where(['id_usuario' => $id_usuario, 'status' => 'Baixado', 'vencimento >=' => $data_inicial, 'vencimento <=' => $data_final])
            ->selectSum('valor', 'despesa01')->get()->getRow()->despesa01;

        $despesa02 = $this->dbLancamento
            ->where(['tipo' => 'despesa', 'id_usuario' => $id_usuario, 'data_pagamento >=' => $data_inicial, 'data_pagamento <=' => $data_final])
            ->selectSum('valor', 'despesa02')->get()->getRow()->despesa02;

        $totalDespesa['totalDespesa'] = $despesa01 + $despesa02;

        $contasPagas['contasPagas'] = $this->dbContasPagas
            ->where(['id_usuario' => $id_usuario, 'data_pagamento >=' => $data_inicial, 'data_pagamento <=' => $data_final])
            ->selectSum('valor', 'contasPagas')->get()->getRow()->contasPagas;
  
        $arrayDados = array_merge($contasReceber, $contasPagar, $contasCredito, $totalReceita, $totalDespesa, $contasPagas);
        echo View('templates/header', $data);
        echo View('inicio/index', $arrayDados);
        echo View('templates/footer');
    }

    function obterDatasMes($ano, $mes)
    {
        $dataInicial = new DateTime("$ano-$mes-01");
        $ultimoDia = $dataInicial->format('t');
        $dataFinal = new DateTime("$ano-$mes-$ultimoDia");
        return [
            'inicial' => $dataInicial->format('Y-m-d'),
            'final' => $dataFinal->format('Y-m-d'),
        ];
    }
}
