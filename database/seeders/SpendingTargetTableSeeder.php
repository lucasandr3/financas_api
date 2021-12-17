<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpendingTargetTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('spending_target')->delete();
        
        \DB::table('spending_target')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'category_target' => 6,
                'value_target' => 2500.0,
                'limit_target_alert' => 80,
                'final_date' => '2021-01-22',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'category_target' => 7,
                'value_target' => 5000.0,
                'limit_target_alert' => 60,
                'final_date' => '2021-03-22',
            ),
        ));
        
        
    }
}