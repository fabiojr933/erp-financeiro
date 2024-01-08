<?php

namespace App\Controllers;

use App\Models\contaFluxo;
use App\Models\ReceitaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use DateTime;

class Grafico extends Controller
{

    private $session;
    private $dbUsuario;
    private $dbReceita;
    private $dbDespesa;


    function __construct()
    {
        $this->session = session();
        $this->dbUsuario = new UsuarioModel();
        $this->dbReceita = new ReceitaModel();
        $this->dbDespesa = new contaFluxo();
    }

    public function receita()
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

        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();

        $sql = "WITH dados as (
            select
            rec.id_receita,
            rec.nome,
    		IFNULL(SUM(bxa.valor), '00.00') as total
            from baixa_conta_receber bxa
            RIGHT join receita rec on bxa.id_receita = rec.id_receita
             where bxa.id_receita is NOT null
            and bxa.data_pagamento BETWEEN '$data_inicio' and '$data_final'
            group by 1,2
            UNION
            select 
            rec.id_receita,
            rec.nome,
      		IFNULL(SUM(lan.valor), '00.00') as total          
            from lancamento lan
            RIGHT join receita rec on lan.id_receita = rec.id_receita
            where lan.id_receita is NOT null
            and lan.data_pagamento BETWEEN '$data_inicio' and '$data_final'
            group by 1,2)
            select 
          --  dados.id_receita,
            dados.nome,
            CAST(sum(dados.total)AS DECIMAL(10,2)) as total
            from dados
            group by 1";

        $valoresReceita['valoresReceita'] =  $this->dbReceita->query($sql)->getResultArray();
        /*    
        $dataReceita['dataReceita'] = [];

        foreach ($valoresReceita as $value) {           
            $dataReceita[] = [$value['nome'], ($value['total'])];
        }
        */
        // print_r(json_encode($dataReceita)); exit;
        $arrayData = array_merge($valoresReceita, $data);


        echo View('templates/header', $perfil);
        echo View('grafico/receita', $arrayData);
        echo View('templates/footer');
    }


    public function despesa()
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

        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();

        $sql = "WITH dados as (
            select
            f.id_contaFluxo,
            f.nome,
    		IFNULL(SUM(bxa.valor), '00.00') as total
            from baixa_conta_pagar bxa
            RIGHT join contafluxo f on bxa.id_despesa = f.id_contaFluxo          
             where bxa.id_despesa is NOT null
            and bxa.data_pagamento BETWEEN '$data_inicio' and '$data_final'
            group by 1,2 
            UNION
            select 
            f.id_contaFluxo,
            f.nome,
    		IFNULL(SUM(lan.valor), '00.00') as total
            from lancamento lan
            RIGHT join contafluxo f on lan.id_fluxo = f.id_contaFluxo          
            where lan.id_fluxo is NOT null
            and lan.data_pagamento BETWEEN '$data_inicio' and '$data_final'
            group by 1,2)
            select 
            --dados.id_contaFluxo,
            dados.nome,
            cast(sum(dados.total) as decimal(10,2)) as total
            from dados
            group by 1";

        $valoresDespesa['valoresDespesa'] =  $this->dbDespesa->query($sql)->getResultArray();      
     
        $arrayData = array_merge($valoresDespesa, $data);


        echo View('templates/header', $perfil);
        echo View('grafico/despesa', $arrayData);
        echo View('templates/footer');
    }
    function obterDatasMes($ano, $mes)
    {
        // Criar objeto DateTime para o primeiro dia do mês
        $dataInicial = new DateTime("$ano-$mes-01");

        // Obter o último dia do mês
        $ultimoDia = $dataInicial->format('t');

        // Criar objeto DateTime para o último dia do mês
        $dataFinal = new DateTime("$ano-$mes-$ultimoDia");

        // Retornar um array com as datas inicial e final
        return [
            'inicial' => $dataInicial->format('Y-m-d'),
            'final' => $dataFinal->format('Y-m-d'),
        ];
    }
}
