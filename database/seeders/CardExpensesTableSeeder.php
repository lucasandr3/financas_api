<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CardExpensesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('card_expenses')->delete();
        
        \DB::table('card_expenses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'card' => 1,
                'category' => 12,
                'title' => 'camisa',
                'description' => 'compra camisa villa lucato',
                'value' => 150.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => NULL,
                'date_pay' => '2022-01-25',
            ),
            1 => 
            array (
                'id' => 2,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'card' => 2,
                'category' => 12,
                'title' => 'Curso B7WEB',
                'description' => 'compra curso freelance da b7web',
                'value' => 279.0,
                'installments' => 1,
                'quantity_installments' => 3,
                'photo' => NULL,
                'date_pay' => '2022-01-15',
            ),
            2 => 
            array (
                'id' => 3,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'card' => 1,
                'category' => 13,
                'title' => 'ifood',
                'description' => 'comida ifood',
                'value' => 15.5,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => NULL,
                'date_pay' => '2021-12-10',
            ),
        ));
        
        
    }
}