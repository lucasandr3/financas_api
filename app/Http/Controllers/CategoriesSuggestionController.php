<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\CategoriesSuggestionServiceInterface;
use Illuminate\Http\Request;

class CategoriesSuggestionController extends Controller
{
    private $service;

    public function __construct
    (
        CategoriesSuggestionServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function categories()
    {
       return $this->service->allCategories();
    }

    public function cardById(Request $request, int $card)
    {
        return $this->service->getCard($card);
    }

    public function cardExpenses(Request $request, int $card)
    {
        return $this->service->getExpenses($card);
    }

    public function newCategory(Request $request)
    {
        return $this->service->newCategory($request);
    }
}
