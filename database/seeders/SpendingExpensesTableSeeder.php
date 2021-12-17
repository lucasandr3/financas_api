<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpendingExpensesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('spending_expenses')->delete();
        
        \DB::table('spending_expenses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'spending' => 1,
                'category' => 7,
                'title' => 'Pastel',
                'description' => 'pastel na praia',
                'value' => 15.5,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => NULL,
                'date_spending_expense' => '2021-12-06',
            ),
            1 => 
            array (
                'id' => 2,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'spending' => 1,
                'category' => 8,
                'title' => 'biquini',
                'description' => 'compra de biquini para viagem',
                'value' => 60.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => NULL,
                'date_spending_expense' => '2021-12-06',
            ),
            2 => 
            array (
                'id' => 3,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'spending' => 1,
                'category' => 10,
                'title' => 'Viagem para Captólio',
                'description' => 'pagamento agência de viagens',
                'value' => 900.0,
                'installments' => 1,
                'quantity_installments' => 2,
                'photo' => NULL,
                'date_spending_expense' => '2021-12-06',
            ),
            3 => 
            array (
                'id' => 4,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'spending' => 2,
                'category' => 6,
                'title' => 'Blusa de Frio',
                'description' => 'blusa de frio na rener',
                'value' => 199.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => 'oZyye2oSQ45iYdxpIyvVYwYU5hFEluEJF6P77A9p.png',
                'date_spending_expense' => '2021-12-25',
            ),
            4 => 
            array (
                'id' => 5,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'spending' => 2,
                'category' => 6,
                'title' => 'Carro ',
                'description' => 'aluguel de carro',
                'value' => 500.0,
                'installments' => 1,
                'quantity_installments' => 3,
                'photo' => 'OgCffR8pIn5AbwQluhml5r70zmupmmvYBeBqkvfk.png',
                'date_spending_expense' => '2021-12-25',
            ),
        ));
        
        
    }
}