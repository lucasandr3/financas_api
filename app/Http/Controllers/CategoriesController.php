<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\CategoriesServiceInterface;

class CategoriesController extends Controller
{
    private $service;

    public function __construct
    (
        CategoriesServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function totals()
    {
        return $this->service->totalsCategories();
    }
}
