<?php

namespace App\Http\Interfaces\Repositories;

interface CategoriesSuggestionRepositoryInterface
{
    public function getAllcategories();

    public function getCategoryById(int $card);

    public function saveCategory(object $request);
}
