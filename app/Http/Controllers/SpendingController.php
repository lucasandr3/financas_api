<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\SpendingServiceInterface;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    private $service;

    public function __construct
    (
        SpendingServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function spendings()
    {
       return $this->service->allSpendings();
    }

    public function spendingById(Request $request, int $spending)
    {
        return $this->service->getSpending($spending);
    }

    public function expenses(Request $request, int $spending)
    {
        return $this->service->getExpenses($spending);
    }

    public function newSpending(Request $request)
    {
        return $this->service->newSpending($request->all());
    }
}
