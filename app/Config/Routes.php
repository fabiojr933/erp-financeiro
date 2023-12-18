<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Inicio::index');

$routes->get('/inicio', 'Inicio::index');

$routes->get('/receita', 'Receita::index');
$routes->get('/receita/novo', 'Receita::novo');
$routes->get('/receita/editar/(:num)', 'Receita::editar/$1');
$routes->post('/receita/store', 'Receita::store');
$routes->post('/receita/excluir', 'Receita::excluir');
$routes->get('/receita/visualizar/(:num)', 'Receita::visualizar/$1');;

// usuario
$routes->get('/login', 'Usuario::index');
$routes->get('/registrar', 'usuario::registrar');
$routes->post('/usuario/autenticar', 'usuario::autenticar');
$routes->post('/usuario/store', 'usuario::store');
$routes->post('/usuario/mudarSenha', 'usuario::mudarSenha');
$routes->get('/usuario/sair', 'usuario::sair');
$routes->get('/usuario/trocar_senha', 'usuario::trocaSenha');
$routes->get('/usuario/perfil', 'usuario::perfil');
$routes->post('/usuario/atualizar_perfil', 'usuario::atualizarPerfil');

//cartao
$routes->get('/cartao', 'cartao::index');
$routes->get('/cartao/novo', 'cartao::novo');
$routes->post('/cartao/store', 'cartao::store');
$routes->get('/cartao/visualizar/(:num)', 'cartao::visualizar/$1');
$routes->get('/cartao/editar/(:num)', 'cartao::editar/$1');
$routes->post('/cartao/excluir', 'cartao::excluir');


//contaDre
$routes->get('/contaDre', 'contaDre::index');
$routes->get('/contaDre/novo', 'contaDre::novo');
$routes->post('/contaDre/store', 'contaDre::store');
$routes->get('/contaDre/visualizar/(:num)', 'contaDre::visualizar/$1');
$routes->get('/contaDre/editar/(:num)', 'contaDre::editar/$1');
$routes->post('/contaDre/excluir', 'contaDre::excluir');


//contaFluxo
$routes->get('/contaFluxo', 'contaFluxo::index');
$routes->get('/contaFluxo/novo', 'contaFluxo::novo');
$routes->post('/contaFluxo/store', 'contaFluxo::store');
$routes->get('/contaFluxo/visualizar/(:num)', 'contaFluxo::visualizar/$1');
$routes->get('/contaFluxo/editar/(:num)', 'contaFluxo::editar/$1');
$routes->post('/contaFluxo/excluir', 'contaFluxo::excluir');


//cliente
$routes->get('/cliente', 'cliente::index');
$routes->get('/cliente/novo', 'cliente::novo');
$routes->post('/cliente/store', 'cliente::store');
$routes->get('/cliente/visualizar/(:num)', 'cliente::visualizar/$1');
$routes->get('/cliente/editar/(:num)', 'cliente::editar/$1');
$routes->post('/cliente/excluir', 'cliente::excluir');

//fornecedor
$routes->get('/fornecedor', 'fornecedor::index');
$routes->get('/fornecedor/novo', 'fornecedor::novo');
$routes->post('/fornecedor/store', 'fornecedor::store');
$routes->get('/fornecedor/visualizar/(:num)', 'fornecedor::visualizar/$1');
$routes->get('/fornecedor/editar/(:num)', 'fornecedor::editar/$1');
$routes->post('/fornecedor/excluir', 'fornecedor::excluir');


//contas receber
$routes->get('/contasReceber', 'contasReceber::index');
$routes->get('/contasReceber/novo', 'contasReceber::novo');
$routes->post('/contasReceber/store', 'contasReceber::store');
$routes->get('/contasReceber/visualizar/(:num)', 'contasReceber::visualizar/$1');
$routes->post('/contasReceber/excluir', 'contasReceber::excluir');

//contas pagar
$routes->get('/contasPagar', 'contasPagar::index');
$routes->get('/contasPagar/novo', 'contasPagar::novo');
$routes->post('/contasPagar/store', 'contasPagar::store');
$routes->get('/contasPagar/visualizar/(:num)', 'contasPagar::visualizar/$1');
$routes->post('/contasPagar/excluir', 'contasPagar::excluir');