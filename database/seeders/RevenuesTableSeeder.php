<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RevenuesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('revenues')->delete();
        
        \DB::table('revenues')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'id_category' => 1,
                'card' => NULL,
                'title' => 'Licitanet',
                'description' => 'Prestação de serviço licitanet',
                'value' => 3786.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => NULL,
                'date_revenue' => '2021-12-16 13:40:34',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'id_category' => 3,
                'card' => NULL,
                'title' => 'Villa Lucato',
                'description' => 'ecommerce villa lucato',
                'value' => 1200.0,
                'installments' => 1,
                'quantity_installments' => 3,
                'photo' => NULL,
                'date_revenue' => '2021-12-16 13:40:34',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'id_category' => 2,
                'card' => NULL,
                'title' => 'investimento',
                'description' => 'investimento nubank',
                'value' => 500.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => 'dF0BZYAPTejWNQtxzm6JOhT9IZXFDYJWbjpMYqfE.png',
                'date_revenue' => '2021-12-16 13:40:34',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'id_category' => 2,
                'card' => NULL,
                'title' => 'Nubank',
                'description' => 'investimento nubank',
                'value' => 120.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => '0',
                'date_revenue' => '2021-12-16 13:40:34',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'id_category' => 2,
                'card' => NULL,
                'title' => 'Licitanet',
                'description' => 'Salário licitanet',
                'value' => 3784.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'photo' => '0',
                'date_revenue' => '2021-12-16 13:40:34',
            ),
            5 => 
            array (
                'id' => 19,
                'user_id' => 1,
                'id_category' => 3,
                'card' => NULL,
                'title' => 'Grupo Unity',
                'description' => 'site para o grupo unity',
                'value' => 1000.0,
                'installments' => 1,
                'quantity_installments' => 5,
                'photo' => '1',
                'date_revenue' => '2021-12-16 13:40:34',
            ),
            6 => 
            array (
                'id' => 22,
                'user_id' => 1,
                'id_category' => 3,
                'card' => NULL,
                'title' => 'Afsol - Energia Solar',
                'description' => 'Site Afsol energia solar',
                'value' => 550.0,
                'installments' => 1,
                'quantity_installments' => 2,
                'photo' => '1',
                'date_revenue' => '2021-12-16 13:40:34',
            ),
        ));
        
        
    }
}