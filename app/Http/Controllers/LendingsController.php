<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\LendingsServiceInterface;
use Illuminate\Http\Request;

class LendingsController extends Controller
{
    private $service;

    public function __construct
    (
        LendingsServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function myLendings()
    {
       return $this->service->allSpendings();
    }

    public function lendingById(Request $request, int $spending)
    {
        return $this->service->getSpending($spending);
    }

    public function lendingInstallments(Request $request, int $spending)
    {
        return $this->service->getExpenses($spending);
    }

    public function newLending(Request $request)
    {
        return $this->service->newExpenseSpending($request);
    }
}
