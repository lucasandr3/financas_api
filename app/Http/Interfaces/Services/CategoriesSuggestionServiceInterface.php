<?php

namespace App\Http\Interfaces\Services;

interface CategoriesSuggestionServiceInterface
{
    public function allCategories();

    public function getCard(int $card);

    public function getExpenses(int $card);

    public function newCategory(object $resquest);
}
