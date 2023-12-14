<?php

namespace App\Models;

use CodeIgniter\Model;

class contaDre extends Model
{
    protected $table = 'contadre';
    protected $primaryKey = 'id_contaDre';
    protected $allowedFields = [
        'id_contaDre',
        'nome',
        'data_cadastro',
        'ativo',
        'id_usuario',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';


    public function inserirContaDre($id)
    {
        $data = [
            [
                'nome'       => 'Despesas com vendas',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Despesas fixa',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Despesa variavel',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Despesas com fornecedores',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Despesas com pro labore',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Despesas com imposto',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ],
            [
                'nome'      => 'Despesas financeiras',
                'ativo'      => 'S',
                'id_usuario' => $id,
            ]
        ];


        foreach ($data as $dados) {
            $db = new contaDre();
            $db2 = new contaFluxo();

            if ($dados['nome'] == 'Despesas com vendas') {
                $idFluxo = $db->insert($dados);

                $data2 = [
                    [
                        'nome'       => 'Despesas com viagens',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Publicidade e propaganda',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Doações e patrocinios',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Brindes',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Comissões sobre venda',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Frete sobre compra',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ]
                ];

                foreach ($data2 as $dados2) {
                    $db2->insert($dados2);
                }
            }


            //Despesas fixas
            if ($dados['nome'] == 'Despesas fixa') {
                $idFluxo = $db->insert($dados);

                $data2 = [
                    [
                        'nome'       => 'Aluguel',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Energia',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Agua',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Internet',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Mensalidade de sistema',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Segurança',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Seguro',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Honorarios profissionais',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Associações',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ]
                ];

                foreach ($data2 as $dados2) {
                    $db2->insert($dados2);
                }
            }

            //Despesa variavel
            if ($dados['nome'] == 'Despesa variavel') {
                $idFluxo = $db->insert($dados);

                $data2 = [
                    [
                        'nome'       => 'Cartorio',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Correios',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Energia Elétrica',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Material de Escritório',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Gastos com Viagens e Estadias',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Despesas Bancárias',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Impressos e formularios',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Manutenção casa',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Manutenção maquina e equipamento',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Manutenção de veiculo',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Combustivel moto',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Combustivel carro',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Roupas e vestuarios',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Eventos diversos',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Refeições e lanches',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Custos de Manutenção de Sites de E-commerce',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ]
                ];

                foreach ($data2 as $dados2) {
                    $db2->insert($dados2);
                }
            }




            //Despesas com fornecedores
            if ($dados['nome'] == 'Despesas com fornecedores') {
                $idFluxo = $db->insert($dados);

                $data2 = [
                    [
                        'nome'       => 'Fornecedores de mercadorias externos',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Fornecedores de mercadoria interno',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Fornecedores outros',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Fornecedores parceiros',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Desconto obtidos fornecedores',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Juros e multas pagas fornecedores',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ]
                ];

                foreach ($data2 as $dados2) {
                    $db2->insert($dados2);
                }
            }


            //Despesas com imposto
            if ($dados['nome'] == 'Despesas com imposto') {
                $idFluxo = $db->insert($dados);

                $data2 = [
                    [
                        'nome'       => 'Simples',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Fgts',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Icms',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Iptu',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Alvara',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Ipva e seguro obrigatorios',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Contribuição sindical',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Irpj',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Irpf',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Issqn',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ]
                ];

                foreach ($data2 as $dados2) {
                    $db2->insert($dados2);
                }
            }



            //Despesas financeiras
            if ($dados['nome'] == 'Despesas financeiras') {
                $idFluxo = $db->insert($dados);

                $data2 = [
                    [
                        'nome'       => 'Pagamento de emprestimo bancario',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Financiamento',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Juros bancarios',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Perda e danos',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Tarifas bancarias',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ],
                    [
                        'nome'       => 'Taxas de custadias',
                        'ativo'      => 'S',
                        'id_usuario' => $id,
                        'id_contaDre' => $idFluxo,
                    ]
                ];

                foreach ($data2 as $dados2) {
                    $db2->insert($dados2);
                }
            }
        }
    }
}
