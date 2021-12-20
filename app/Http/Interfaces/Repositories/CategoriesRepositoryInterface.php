<?php

namespace App\Http\Interfaces\Repositories;

interface CategoriesRepositoryInterface
{
    public function getTotalsExpensesCategories();

    public function getTotalsRevenuesCategories();

    public function getTotalsSpendingsCategories();

    public function getTotalsCardsCategories();
}
