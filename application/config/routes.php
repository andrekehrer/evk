<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'painel';

// $route['carrinho'] = 'site/carrinho';
// $route['add_carrinho'] = 'site/add_carrinho';
// $route['edit_carrinho'] = 'site/edit_carrinho';
// $route['salva_compra'] = 'site/salva_compra';

// $route['retorno_pedido'] = 'site/retorno_pedido';

// $route['cadastro'] = 'cadastro';
// $route['cadastro/salvar_cadastro'] = 'cadastro/salvar_cadastro';

// $route['customers'] = 'customers/login';
// $route['customers_carrinho'] = 'customers/Login/login_carrinho';
// $route['Login/log'] = 'customers/Login/log';
// $route['logout'] = 'customers/Login/logout';

// $route['customers/dashboard'] = 'customers/dashboard';
// $route['customers/viagens'] = 'customers/viagens';
// $route['customers/add_viagens'] = 'customers/viagens/add_viagens';
// $route['customers/add_viagem_gravar'] = 'customers/viagens/add_viagem_gravar';
// $route['customers/edit_viagem_gravar'] = 'customers/viagens/edit_viagem_gravar';
// $route['customers/edit_viagem/(:any)'] = 'customers/viagens/edit_viagem/$1';

// $route['customers/add_bag'] = 'customers/viagens/add_bag';
// $route['customers/edit_bag'] = 'customers/viagens/edit_bag';
// $route['customers/edit_bag_gravar'] = 'customers/viagens/edit_bag_gravar';
// $route['customers/gerar_pdf/(:num)/(:num)'] = 'customers/viagens/gerar_pdf/$1/$2';

// $route['cadastro/buy/'] = 'cadastro/buy';

// $route['paypal/cancel'] = 'paypal/cancel';


// $route['customers/activeuser/(:any)'] = 'customers/usuario/active_user/$1';


/////////////////////////////////// ADMIN ////////////////////////////////////////
$route['admin'] = 'admin/login';
$route['admin/Login/log'] = 'admin/Login/log';
$route['admin/logout'] = 'admin/Login/logout';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/clientes'] = 'admin/clientes';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
