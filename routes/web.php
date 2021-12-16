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

// rotas publicas de autenticação
$router->post('api/auth/register', 'AuthController@register');
$router->post('api/auth/login', 'AuthController@login');

// rota de login
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/auth'
], function () use ($router) {
    $router->post('/validate_token', 'AuthController@validateToken');
    $router->post('/logout', 'AuthController@logout');
});

// rota de receitas
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/revenues'
], function () use ($router) {
    $router->get('/', 'RevenueController@revenues');
    $router->get('/{revenue}', 'RevenueController@revenueById');
    $router->post('/edit/{revenue}', 'RevenueController@editRevenue');
    $router->get('/installments/{revenue}', 'RevenueController@installments');
    $router->post('new', 'RevenueController@newRevenue');
    $router->delete('delete/{revenue}', 'RevenueController@deleteRevenue');
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
    $router->delete('delete/{expense}', 'ExpenseController@deleteExpense');
    $router->put('edit/{expense}', 'ExpenseController@editExpense');
});

// rota de gastos relacionados
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
    $router->post('/edit/{card}', 'CardsController@editCard');
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

// rota de Categorias de Sugestoes
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/category_suggestions'
], function () use ($router) {
    $router->get('/', 'CategoriesSuggestionController@categories');
    $router->get('/{category}', 'CategoriesSuggestionController@categoryById');
    $router->post('new', 'CategoriesSuggestionController@newCategory');
});

// rota de Sugestoes
$router->group([
    'middleware' => 'auth',
    'prefix' => 'api/suggestions'
], function () use ($router) {
    $router->get('/user', 'SuggestionController@mySuggestions');
    $router->get('/{suggestion}', 'SuggestionController@suggestionById');
    $router->post('new', 'SuggestionController@newSuggestion');
});

