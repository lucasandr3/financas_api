<?php

namespace App\Http\Interfaces\Services;

interface CardsServiceInterface
{
    public function allCards();

    public function getCard(int $card);

    public function getExpenses(int $card);

    public function newCard(object $resquest);
}
