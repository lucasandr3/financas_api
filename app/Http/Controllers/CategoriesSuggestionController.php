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

    public function categoryById(Request $request, int $category)
    {
        return $this->service->getCategory($category);
    }

    public function newCategory(Request $request)
    {
        return $this->service->newCategory($request);
    }
}
