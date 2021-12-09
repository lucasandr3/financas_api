<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\CardsServiceInterface;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    private $service;

    public function __construct
    (
        CardsServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function myCards()
    {
       return $this->service->allSpendings();
    }

    public function cardById(Request $request, int $spending)
    {
        return $this->service->getSpending($spending);
    }

    public function cardExpenses(Request $request, int $spending)
    {
        return $this->service->getExpenses($spending);
    }

    public function newCard(Request $request)
    {
        return $this->service->newSpending($request->all());
    }

    public function newExpenseCard(Request $request)
    {
        return $this->service->newExpenseSpending($request);
    }
}
