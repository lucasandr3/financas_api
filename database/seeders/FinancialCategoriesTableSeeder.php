<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FinancialCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('financial_categories')->delete();
        
        \DB::table('financial_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Salário',
            ),
            1 => 
            array (
                'id' => 2,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Investimento',
            ),
            2 => 
            array (
                'id' => 3,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Freelance',
            ),
            3 => 
            array (
                'id' => 4,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Energia',
            ),
            4 => 
            array (
                'id' => 5,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Aluguel',
            ),
            5 => 
            array (
                'id' => 6,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Compras',
            ),
            6 => 
            array (
                'id' => 7,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Alimentação',
            ),
            7 => 
            array (
                'id' => 8,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Roupas de Banho',
            ),
            8 => 
            array (
                'id' => 9,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Ingressos',
            ),
            9 => 
            array (
                'id' => 10,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Viagem',
            ),
            10 => 
            array (
                'id' => 11,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Empréstimo',
            ),
            11 => 
            array (
                'id' => 12,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Cartão Crédito',
            ),
            12 => 
            array (
                'id' => 13,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'name' => 'Cartão Débito',
            ),
        ));
        
        
    }
}