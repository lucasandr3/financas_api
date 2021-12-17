<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call(UsersTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(CardExpensesTableSeeder::class);
        $this->call(CardInstallmentsTableSeeder::class);
        $this->call(CategoriesSuggestionTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CustomersTagsTableSeeder::class);
        $this->call(ExpensesTableSeeder::class);
        $this->call(ExpenseInstallmentsTableSeeder::class);
        $this->call(FinancialCategoriesTableSeeder::class);
        $this->call(LendingsTableSeeder::class);
        $this->call(LendingInstallmentsTableSeeder::class);
        $this->call(RevenuesTableSeeder::class);
        $this->call(RevenueInstallmentsTableSeeder::class);
        $this->call(SpendingTableSeeder::class);
        $this->call(SpendingInstallmentsTableSeeder::class);
        $this->call(SpendingTargetTableSeeder::class);
        $this->call(SuggestionsTableSeeder::class);
        $this->call(SpendingExpensesTableSeeder::class);
    }
}
