<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpendingInstallmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('spending_installments')->delete();
        
        \DB::table('spending_installments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'spending_limit' => 1,
                'spending_expense' => 3,
                'installment' => 1,
                'value_installment' => 450.0,
                'pay' => '2022-01-10',
            ),
            1 => 
            array (
                'id' => 2,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'spending_limit' => 1,
                'spending_expense' => 3,
                'installment' => 2,
                'value_installment' => 450.0,
                'pay' => '2022-02-10',
            ),
        ));
        
        
    }
}