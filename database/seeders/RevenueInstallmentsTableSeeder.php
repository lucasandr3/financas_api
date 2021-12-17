<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RevenueInstallmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('revenue_installments')->delete();
        
        \DB::table('revenue_installments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'revenue' => 2,
                'installment' => 1,
                'value_installment' => 400.0,
                'pay' => '2021-09-10',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'revenue' => 2,
                'installment' => 2,
                'value_installment' => 400.0,
                'pay' => '2021-10-10',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'revenue' => 2,
                'installment' => 3,
                'value_installment' => 400.0,
                'pay' => '2021-11-10',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'revenue' => 19,
                'installment' => 1,
                'value_installment' => 200.0,
                'pay' => '2022-01-16',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'revenue' => 19,
                'installment' => 2,
                'value_installment' => 200.0,
                'pay' => '2022-02-16',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'revenue' => 19,
                'installment' => 3,
                'value_installment' => 200.0,
                'pay' => '2022-03-16',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 1,
                'revenue' => 19,
                'installment' => 4,
                'value_installment' => 200.0,
                'pay' => '2022-04-16',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 1,
                'revenue' => 19,
                'installment' => 5,
                'value_installment' => 200.0,
                'pay' => '2022-05-16',
            ),
            8 => 
            array (
                'id' => 17,
                'user_id' => 1,
                'revenue' => 22,
                'installment' => 1,
                'value_installment' => 275.0,
                'pay' => '2022-01-16',
            ),
            9 => 
            array (
                'id' => 18,
                'user_id' => 1,
                'revenue' => 22,
                'installment' => 2,
                'value_installment' => 275.0,
                'pay' => '2022-02-16',
            ),
        ));
        
        
    }
}