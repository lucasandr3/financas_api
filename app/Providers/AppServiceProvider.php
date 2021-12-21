<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Binds Auth
        $this->app->bind(\App\Http\Interfaces\Services\AuthServiceInterface::class, \App\Http\Services\AuthService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\AuthRepositoryInterface::class, \App\Http\Repositories\AuthRepository::class);

        // Binds Revenue
        $this->app->bind(\App\Http\Interfaces\Services\RevenueServiceInterface::class, \App\Http\Services\RevenueService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\RevenueRepositoryInterface::class, \App\Http\Repositories\RevenueRepository::class);

        // Binds Expenses
        $this->app->bind(\App\Http\Interfaces\Services\ExpenseServiceInterface::class, \App\Http\Services\ExpenseService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\ExpenseRepositoryInterface::class, \App\Http\Repositories\ExpenseRepository::class);

        // Binds Event Expenses
        $this->app->bind(\App\Http\Interfaces\Services\EventRevenueServiceInterface::class, \App\Http\Services\EventRevenueService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\EventRevenueRepositoryInterface::class, \App\Http\Repositories\EventRevenueRepository::class);

        // Binds Spending Limits
        $this->app->bind(\App\Http\Interfaces\Services\SpendingServiceInterface::class, \App\Http\Services\SpendingService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\SpendingRepositoryInterface::class, \App\Http\Repositories\SpendingRepository::class);

        // Binds Spending Targets
        $this->app->bind(\App\Http\Interfaces\Services\SpendingTargetServiceInterface::class, \App\Http\Services\SpendingTargetService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\SpendingTargetRepositoryInterface::class, \App\Http\Repositories\SpendingTargetRepository::class);

        // Binds Cards
        $this->app->bind(\App\Http\Interfaces\Services\CardsServiceInterface::class, \App\Http\Services\CardsService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\CardsRepositoryInterface::class, \App\Http\Repositories\CardsRepository::class);

        // Binds Lendings
        $this->app->bind(\App\Http\Interfaces\Services\LendingsServiceInterface::class, \App\Http\Services\LendingsService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\LendingsRepositoryInterface::class, \App\Http\Repositories\LendingsRepository::class);

        // Binds Categories Suggestions
        $this->app->bind(\App\Http\Interfaces\Services\CategoriesSuggestionServiceInterface::class, \App\Http\Services\CategoriesSuggestionService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\CategoriesSuggestionRepositoryInterface::class, \App\Http\Repositories\CategoriesSuggestionRepository::class);

        // Binds Categories Suggestions
        $this->app->bind(\App\Http\Interfaces\Services\SuggestionServiceInterface::class, \App\Http\Services\SuggestionService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\SuggestionRepositoryInterface::class, \App\Http\Repositories\SuggestionRepository::class);

        // Binds Categories financeiras
        $this->app->bind(\App\Http\Interfaces\Services\CategoriesServiceInterface::class, \App\Http\Services\CategoriesService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\CategoriesRepositoryInterface::class, \App\Http\Repositories\CategoriesRepository::class);

        // Binds Clientes
        $this->app->bind(\App\Http\Interfaces\Services\CustomersServiceInterface::class, \App\Http\Services\CustomersService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\CustomersRepositoryInterface::class, \App\Http\Repositories\CustomersRepository::class);

        // Binds Receitps
        $this->app->bind(\App\Http\Interfaces\Services\Modules\Receipts\ReceiptsServiceInterface::class, \App\Http\Services\Modules\Receipts\ReceitpsService::class);
        $this->app->bind(\App\Http\Interfaces\Repositories\Modules\Receipts\ReceiptsRepositoryInterface::class, \App\Http\Repositories\Modules\Receipts\ReceiptsRepository::class);
    }
}
