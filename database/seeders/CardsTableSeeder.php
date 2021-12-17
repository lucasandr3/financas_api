<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cards')->delete();
        
        \DB::table('cards')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'institution' => 'Nubank',
                'title' => 'Cartão Débito',
                'limit_card' => 600.0,
                'annuity' => 50.0,
                'percent_alert' => 80,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'institution' => 'Itaú',
                'title' => 'Cartão Crédito Itaú',
                'limit_card' => 2400.0,
                'annuity' => NULL,
                'percent_alert' => 60,
            ),
            2 => 
            array (
                'id' => 4,
                'user_id' => 2,
                'institution' => 'Santander',
                'title' => 'Cartão Crédito',
                'limit_card' => 1200.0,
                'annuity' => 2.1,
                'percent_alert' => 50,
            ),
            3 => 
            array (
                'id' => 7,
                'user_id' => 2,
                'institution' => 'Bradesco',
                'title' => 'Cartão de Crédito',
                'limit_card' => 4000.0,
                'annuity' => 100.0,
                'percent_alert' => 50,
            ),
        ));
        
        
    }
}