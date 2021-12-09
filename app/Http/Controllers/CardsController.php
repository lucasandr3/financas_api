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
       return $this->service->allCards();
    }

    public function cardById(Request $request, int $card)
    {
        return $this->service->getCard($card);
    }

    public function cardExpenses(Request $request, int $card)
    {
        return $this->service->getExpenses($card);
    }

    public function newCard(Request $request)
    {
        return $this->service->newCard($request);
    }
}
