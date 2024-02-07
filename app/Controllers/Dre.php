<?php

namespace App\Controllers;

use App\Models\contaDre;
use App\Models\contaFluxo;
use App\Models\lancamento;
use App\Models\ReceitaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use DateTime;

class Dre extends Controller
{
    private $session;
    private $dbUsuario;
    private $dbReceita;
    private $dbContaDre;
    private $contaFluxo;
    private $dbLancamento;

    function __construct()
    {
        $this->session = session();
        $this->dbUsuario = new UsuarioModel();
        $this->dbReceita = new ReceitaModel();
        $this->dbContaDre = new contaDre();
        $this->contaFluxo = new contaFluxo();
        $this->dbLancamento = new lancamento();
    }

    public function sintetico()
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

        $receita['receita'] = $this->dbReceita->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $contaDre['contaDre'] = $this->dbContaDre->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();

        $sql = "SELECT
        rec.id_receita,
        rec.nome,
        COALESCE(SUM(lanc.valor), '00.00') as total
    FROM
        receita rec
    LEFT JOIN lancreceita lanc ON lanc.id_receita = rec.id_receita
        AND lanc.data_pagamento BETWEEN '$data_inicio' and '$data_final'
        AND lanc.id_usuario = '$id_usuario'
    GROUP BY
        rec.id_receita, rec.nome;";

        $valoresReceita['valoresReceita'] =  $this->dbLancamento->query($sql)->getResultArray();

        $sql2 = "SELECT
        dre.id_contaDre,
        dre.nome,
        COALESCE(SUM(lanc.valor), '00.00') as total
    FROM
       contadre dre       
    LEFT JOIN contafluxo f ON dre.id_contaDre = f.id_contaDre    
    LEFT JOIN lancdespesa lanc ON lanc.id_contaFluxo = f.id_contaFluxo    
         AND lanc.data_pagamento BETWEEN '2020.01.01' and '2025.01.01'
         AND lanc.id_usuario = 1
    GROUP BY
        dre.id_contaDre,  dre.nome";

        $valoresDespesa['valoresDespesa'] =  $this->dbContaDre->query($sql2)->getResultArray();

        $arrayData = array_merge($receita, $contaDre, $valoresReceita, $valoresDespesa, $data);
        echo View('templates/header', $perfil);
        echo View('dre/sintetico', $arrayData);
        echo View('templates/footer');
    }
    public function analitico()
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


        $receita['receita'] = $this->dbReceita->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $contaDre['contaDre'] = $this->dbContaDre->where('id_usuario', $this->session->get('id_usuario'))->findAll();
        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();

        $sql = "SELECT
        rec.id_receita,
        rec.nome,
        COALESCE(SUM(lanc.valor), '00.00') as total
    FROM
        receita rec
    LEFT JOIN lancreceita lanc ON lanc.id_receita = rec.id_receita
        AND lanc.data_pagamento BETWEEN '$data_inicio' and '$data_final'
        AND lanc.id_usuario = '$id_usuario'
    GROUP BY
        rec.id_receita, rec.nome;";

        $valoresReceita['valoresReceita'] =  $this->dbReceita->query($sql)->getResultArray();


        $sqlFluxo = "SELECT
        rec.id_contaFluxo,
        rec.nome,
        COALESCE(SUM(lanc.valor), '00.00') as total
    FROM
       contafluxo rec
    LEFT JOIN lancdespesa lanc ON lanc.id_contaFluxo = rec.id_contaFluxo
         AND lanc.data_pagamento BETWEEN '$data_inicio' and '$data_final'
         AND lanc.id_usuario = '$id_usuario'
    GROUP BY
        rec.id_contaFluxo, rec.nome";

        $valoresContaFluxo['valoresContaFluxo'] =  $this->dbReceita->query($sqlFluxo)->getResultArray();

        $contaFluxo['contaFluxo'] = $this->contaFluxo->where('id_usuario', $this->session->get('id_usuario'))->findAll();


        $arrayData = array_merge($receita, $contaDre, $valoresReceita, $contaFluxo, $valoresContaFluxo, $data);
        echo View('templates/header', $perfil);
        echo View('dre/analitico', $arrayData);
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
