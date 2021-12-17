<?php

namespace App\Http\Interfaces\Repositories;

interface CategoriesRepositoryInterface
{
    public function getTotalsExpensesCategories();

    public function getTotalsRevenuesCategories();
}
