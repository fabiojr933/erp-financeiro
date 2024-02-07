<?php

namespace App\Controllers;

use App\Models\baixaContasPagar;
use App\Models\contasPagar;
use App\Models\contasReceber;
use App\Models\lancamento;
use App\Models\lancamentoCredito;
use App\Models\lancDespesaModel;
use App\Models\lancReceitaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use DateTime;

class Inicio extends Controller
{
    private $session;
    private $dbUsuario;
    private $dbReceber;
    private $dbPagar;
    private $dbLancamento;
    private $dbLancReceita;
    private $dbLancDespesa;

    function __construct()
    {
        $this->session = session();
        $this->dbUsuario = new UsuarioModel();
        $this->dbReceber = new contasReceber();
        $this->dbPagar = new contasPagar();
        $this->dbLancamento = new lancamento();
        $this->dbLancDespesa = new lancDespesaModel();
        $this->dbLancReceita = new lancReceitaModel();
    }
    public function index()
    {
        $request = request();
        $data_inicio = $request->getGet('data_inicio');
        $data_final = $request->getGet('data_final');

        $dataAtual = new DateTime();
        $ano = $dataAtual->format('Y');
        $mes = $dataAtual->format('m');
        $datasMes = self::obterDatasMes($ano, $mes);

        if ($data_inicio == null || $data_final == null) {
            $data_inicio =  $datasMes['inicial'];
            $data_final =  $datasMes['final'];
        } else {
            $data_inicio =  $data_inicio;
            $data_final =  $data_final;
        }

        $data['data'] = [
            'data_inicio' => $data_inicio,
            'data_final'  => $data_final,
        ];

        $id_usuario = $this->session->get('id_usuario');
        $data['perfil'] = $this->dbUsuario->where('id_usuario', $id_usuario)->first();

        $contasReceber['contasReceber'] = $this->dbReceber
            ->where(['id_usuario' => $id_usuario, 'status' => 'Aberta', 'vencimento >=' => $data_inicio, 'vencimento <=' => $data_final])
            ->selectSum('valor', 'totalReceber')->get()->getRow()->totalReceber;

        $contasRecebido['contasRecebido'] = $this->dbReceber
            ->where(['id_usuario' => $id_usuario, 'status' => 'Baixado', 'data_pagamento >=' => $data_inicio, 'data_pagamento <=' => $data_final])
            ->selectSum('valor', 'totalRecebido')->get()->getRow()->totalRecebido;

        $contasPagas['contasPagas'] = $this->dbPagar
            ->where(['id_usuario' => $id_usuario, 'status' => 'Baixado', 'data_pagamento >=' => $data_inicio, 'data_pagamento <=' => $data_final])
            ->selectSum('valor', 'totalPago')->get()->getRow()->totalPago;

        $contasPagar['contasPagar'] = $this->dbPagar
            ->where(['id_usuario' => $id_usuario, 'status' => 'Aberta', 'vencimento >=' => $data_inicio, 'vencimento <=' => $data_final])
            ->selectSum('valor', 'totalPagar')->get()->getRow()->totalPagar;

        $Receita01 = $this->dbReceber
            ->where(['id_usuario' => $id_usuario, 'status' => 'Baixado', 'vencimento >=' => $data_inicio, 'vencimento <=' => $data_final])
            ->selectSum('valor', 'Receita01')->get()->getRow()->Receita01;

        $Receita02 = $this->dbLancamento
            ->where(['tipo' => 'receita', 'id_usuario' => $id_usuario, 'data_pagamento >=' => $data_inicio, 'data_pagamento <=' => $data_final])
            ->selectSum('valor', 'Receita02')->get()->getRow()->Receita02;

        $totalReceita['totalReceita'] = $Receita02 + $Receita01;

        $despesa01 = $this->dbPagar
            ->where(['id_usuario' => $id_usuario, 'status' => 'Baixado', 'vencimento >=' => $data_inicio, 'vencimento <=' => $data_final])
            ->selectSum('valor', 'despesa01')->get()->getRow()->despesa01;

        $despesa02 = $this->dbLancamento
            ->where(['tipo' => 'despesa', 'id_usuario' => $id_usuario, 'data_pagamento >=' => $data_inicio, 'data_pagamento <=' => $data_final])
            ->selectSum('valor', 'despesa02')->get()->getRow()->despesa02;

        $totalDespesa['totalDespesa'] = $despesa01 + $despesa02;



        $sql = "SELECT 
        r.nome,
        a.valor,
        a.data_pagamento
        FROM lancreceita a 
        LEFT join receita r on r.id_receita = a.id_receita
        where a.data_pagamento BETWEEN '$data_inicio' and '$data_final'
        and a.id_usuario = $id_usuario
        ORDER BY A.id_lancReceita DESC 
        LIMIT 5";

        $valoresReceita['valoresReceita'] =  $this->dbLancReceita->query($sql)->getResultArray();



        $sql2 = "SELECT          
        r.nome,
        a.valor,
        a.data_pagamento
        FROM lancdespesa a 
        LEFT join contafluxo r on r.id_contaFluxo = a.id_contaFluxo
        where a.data_pagamento BETWEEN '$data_inicio' and '$data_final'
        and a.id_usuario = $id_usuario
        ORDER BY A.id_lancdespesa DESC 
        LIMIT 5";

        $valoresDespesas['valoresDespesas'] =  $this->dbLancReceita->query($sql2)->getResultArray();


        $sql3 = "SELECT 
        r.nome,
        a.valor_pendente,
        a.vencimento
        FROM contasreceber a 
        join cliente r on r.id_cliente = A.id_cliente
        where a.valor_pendente > 0
        and a.id_usuario = $id_usuario
        ORDER BY A.vencimento asc 
        LIMIT 5";

        $ContasPendenteCliente['ContasPendenteCliente'] =  $this->dbReceber->query($sql3)->getResultArray();

        $sql4 = "SELECT 
        r.nome,
        a.valor_pendente,
        a.vencimento
        FROM contaspagar a 
        join fornecedor r on r.id_fornecedor = A.id_fornecedor
        where a.valor_pendente > 0
        and a.id_usuario =  $id_usuario
        ORDER BY A.vencimento asc 
        LIMIT 5";

        $ContasPendenteFornecedor['ContasPendenteFornecedor'] =  $this->dbReceber->query($sql4)->getResultArray();




        $sql5 = "SELECT 
        sum(a.valor_pendente) AS valor,
        'pendente' as tipo
        FROM contaspagar a 
        join fornecedor r on r.id_fornecedor = A.id_fornecedor
        where a.vencimento  BETWEEN '$data_inicio' and '$data_final'
        and a.valor_pendente > 0
        and a.id_usuario = $id_usuario
        GROUP by 2
UNION

SELECT 
        SUM(a.valor) as valor,
        'pagas' as tipo
        FROM baixa_conta_pagar a 
        join contaspagar p on a.id_contasPagar = p.id_contasPagar
        join fornecedor r on r.id_fornecedor = p.id_fornecedor
        WHERE a.data_pagamento BETWEEN '$data_inicio' and '$data_final'
        and a.id_usuario = $id_usuario
          GROUP by 2";

        $graficoPagar['graficoPagar'] =  $this->dbLancamento->query($sql5)->getResultArray();



        $sql6 = "SELECT 
        sum(a.valor_pendente) AS valor,
        'pendente' as tipo
        FROM contasreceber a 
        join cliente r on r.id_cliente = A.id_cliente
        where a.vencimento  BETWEEN '$data_inicio' and '$data_final'
        and a.valor_pendente > 0
        and a.id_usuario = $id_usuario
        GROUP by 2
UNION

SELECT 
        SUM(a.valor) as valor,
        'pagas' as tipo
        FROM baixa_conta_receber a 
        join contasreceber p on a.id_baixa_conta_receber = p.id_contasReceber
        join cliente r on r.id_cliente = p.id_cliente
        WHERE a.data_pagamento BETWEEN '$data_inicio' and '$data_final'
        and a.id_usuario = $id_usuario
          GROUP by 2";

        $graficoReceber['graficoReceber'] =  $this->dbLancamento->query($sql6)->getResultArray();

 
        $arrayDados = array_merge(
            $contasReceber,
            $contasPagar,
            $totalReceita,
            $totalDespesa,
            $graficoPagar,
            $graficoReceber,
            $contasRecebido,
            $contasPagas,
            $valoresReceita,
            $valoresDespesas,
            $ContasPendenteCliente,
            $ContasPendenteFornecedor,
            $data
        );
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
