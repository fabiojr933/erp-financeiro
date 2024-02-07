<?php

namespace App\Controllers;

use App\Models\contaFluxo;
use App\Models\ReceitaModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use DateTime;

class Relatorio extends Controller
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

        $id_usuario = $this->session->get('id_usuario');

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

        $arrayData = array_merge($valoresReceita, $data);
        echo View('templates/header', $perfil);
        echo View('relatorio/receita', $arrayData);
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

        $id_usuario = $this->session->get('id_usuario');

        $perfil['perfil'] = $this->dbUsuario->where('id_usuario', $this->session->get('id_usuario'))->first();

        $sql = "SELECT
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

        $valoresDespesa['valoresDespesa'] =  $this->dbDespesa->query($sql)->getResultArray();

        $arrayData = array_merge($valoresDespesa, $data);
        echo View('templates/header', $perfil);
        echo View('relatorio/despesa', $arrayData);
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
