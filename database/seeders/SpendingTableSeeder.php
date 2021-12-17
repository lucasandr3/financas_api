<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpendingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('spending')->delete();
        
        \DB::table('spending')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'title' => 'Viagem para Capitólio',
                'limit_value' => 2000.0,
                'percent_alert' => 80,
                'final_date_spending' => '2021-12-20',
            ),
            1 => 
            array (
                'id' => 2,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'title' => 'Caldas Novas',
                'limit_value' => 1500.0,
                'percent_alert' => 60,
                'final_date_spending' => '2021-12-25',
            ),
        ));
        
        
    }
}