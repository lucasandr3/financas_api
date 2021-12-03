<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\ExpenseServiceInterface;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    private $service;

    public function __construct
    (
        ExpenseServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function expenses()
    {
       return $this->service->allExpenses();
    }

    public function expenseById(Request $request, int $expense)
    {
        return $this->service->getExpense($expense);
    }

    public function installments(Request $request, int $expense)
    {
        return $this->service->getInstallments($expense);
    }

    public function newExpense(Request $request)
    {
        return $this->service->newExpense($request->all());
    }
}
