<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// rota do front
$router->get('/', function () use ($router) {
    return 'Bem Vindo a Api!!';
});

// rota de teste
$router->get('/api/test/ping', function () use ($router) {
    return ['code' => 0, 'response' => 'pong'];
});

// rota de nao autorizado
$router->get('/404', 'AuthController@unauthorized');

// rota de login
$router->group(['prefix' => 'api/auth'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});

// rota de receitas
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/revenues'
], function () use ($router) {
    $router->get('/', 'RevenueController@revenues');
    $router->get('/{revenue}', 'RevenueController@revenueById');
    $router->get('/installments/{revenue}', 'RevenueController@installments');
    $router->post('new', 'RevenueController@newRevenue');
});

// rota de despesas
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/expenses'
], function () use ($router) {
    $router->get('/', 'ExpenseController@expenses');
    $router->get('/{expense}', 'ExpenseController@expenseById');
    $router->get('/installments/{expense}', 'ExpenseController@installments');
    $router->post('new', 'ExpenseController@newExpense');
});

// rota de eventos de receitas
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/event/revenues'
], function () use ($router) {
    $router->get('/', 'EventRevenueController@revenues');
    $router->get('/{event}', 'EventRevenueController@revenueById');
    $router->get('/installments/{event}', 'EventRevenueController@installments');
    $router->post('new', 'EventRevenueController@newRevenue');
});

// rota de limite de gastos
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/spendings'
], function () use ($router) {
    $router->get('/', 'SpendingController@spendings');
    $router->get('/{spending}', 'SpendingController@spendingById');
    $router->get('/expenses/{spending}', 'SpendingController@expenses');
    $router->post('new', 'SpendingController@newSpending');
    $router->post('new/expense', 'SpendingController@newExpenseSpending');
});

// rota de meta de gastos
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/spending_targets'
], function () use ($router) {
    $router->get('/', 'SpendingTargetController@spendingsTargets');
    $router->get('/{spending}', 'SpendingTargetController@spendingTargetById');
    $router->post('new', 'SpendingTargetController@newSpendingTarget');
});

// rota de Cartões
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/cards'
], function () use ($router) {
    $router->get('/', 'CardsController@myCards');
    $router->get('/{card}', 'CardsController@cardById');
    $router->get('/{card}/expenses', 'CardsController@cardExpenses');
    $router->post('new', 'CardsController@newCard');
});

// rota de Empréstimos
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/lendings'
], function () use ($router) {
    $router->get('/', 'LendingsController@myLendings');
    $router->get('/{lending}', 'LendingsController@lendingById');
    $router->get('/installments/{lending}', 'LendingsController@lendingInstallments');
    $router->post('new', 'LendingsController@newLending');
});

