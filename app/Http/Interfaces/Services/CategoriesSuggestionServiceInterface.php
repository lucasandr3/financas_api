<?php

namespace App\Http\Interfaces\Services;

interface CategoriesSuggestionServiceInterface
{
    public function allCategories();

    public function getCategory(int $category);

    public function newCategory(object $resquest);
}
