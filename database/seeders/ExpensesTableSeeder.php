<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExpensesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('expenses')->delete();
        
        \DB::table('expenses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'id_category_expense' => 4,
                'card' => NULL,
                'title' => 'Cemig',
                'description' => 'conta de energia',
                'value' => 143.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => NULL,
                'date_expense' => '2021-12-16 13:40:56',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'id_category_expense' => 6,
                'card' => NULL,
                'title' => 'Notebook',
                'description' => 'compra notebook',
                'value' => 3500.0,
                'installments' => 1,
                'quantity_installments' => 5,
                'photo' => NULL,
                'date_expense' => '2021-12-16 13:40:56',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'id_category_expense' => 6,
                'card' => 1,
                'title' => 'ifood',
                'description' => 'janta ifood',
                'value' => 15.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => NULL,
                'date_expense' => '2021-12-16 13:40:56',
            ),
            3 => 
            array (
                'id' => 20,
                'user_id' => 1,
                'id_category_expense' => 6,
                'card' => NULL,
                'title' => 'teclado e mouse',
                'description' => 'teclado e mouse para a empresa',
                'value' => 530.0,
                'installments' => 1,
                'quantity_installments' => 2,
                'photo' => NULL,
                'date_expense' => '2021-12-16 13:40:56',
            ),
            4 => 
            array (
                'id' => 21,
                'user_id' => 1,
                'id_category_expense' => 6,
                'card' => NULL,
                'title' => 'teclado e mouse',
                'description' => 'teclado e mouse para a empresa',
                'value' => 530.0,
                'installments' => 1,
                'quantity_installments' => 2,
                'photo' => NULL,
                'date_expense' => '2021-12-16 13:40:56',
            ),
            5 => 
            array (
                'id' => 22,
                'user_id' => 1,
                'id_category_expense' => 6,
                'card' => NULL,
                'title' => 'teclado e mouse',
                'description' => 'teclado e mouse para a empresa',
                'value' => 530.0,
                'installments' => 1,
                'quantity_installments' => 2,
                'photo' => NULL,
                'date_expense' => '2021-12-16 13:40:56',
            ),
            6 => 
            array (
                'id' => 23,
                'user_id' => 1,
                'id_category_expense' => 6,
                'card' => NULL,
                'title' => 'teclado e mouse',
                'description' => 'teclado e mouse para a empresa',
                'value' => 530.0,
                'installments' => 1,
                'quantity_installments' => 2,
                'photo' => NULL,
                'date_expense' => '2021-12-16 13:40:56',
            ),
            7 => 
            array (
                'id' => 24,
                'user_id' => 1,
                'id_category_expense' => 6,
                'card' => 2,
                'title' => 'gitahead',
                'description' => 'compra de software',
                'value' => 100.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => 'W3c9f397GPWFxPbJwCpfTiFd3mm9DXwRTLGV7FMi.png',
                'date_expense' => '2021-12-16 13:40:56',
            ),
            8 => 
            array (
                'id' => 25,
                'user_id' => 1,
                'id_category_expense' => 6,
                'card' => 1,
                'title' => 'marmita',
                'description' => 'marmita serviço',
                'value' => 5.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => NULL,
                'date_expense' => '2021-12-16 13:40:56',
            ),
            9 => 
            array (
                'id' => 29,
                'user_id' => 1,
                'id_category_expense' => 6,
                'card' => NULL,
                'title' => 'Compra TV Bahia',
                'description' => 'Compra Tv para escritorio',
                'value' => 2000.0,
                'installments' => 1,
                'quantity_installments' => 12,
                'photo' => '1',
                'date_expense' => '2021-12-16 13:40:56',
            ),
        ));
        
        
    }
}