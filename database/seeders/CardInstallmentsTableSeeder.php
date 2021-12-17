<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CardInstallmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('card_installments')->delete();
        
        \DB::table('card_installments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'card' => 2,
                'card_expense' => 2,
                'installment' => 1,
                'value_installment' => 93.0,
                'pay' => '2022-01-15',
            ),
            1 => 
            array (
                'id' => 2,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'card' => 2,
                'card_expense' => 2,
                'installment' => 2,
                'value_installment' => 93.0,
                'pay' => '2022-02-15',
            ),
            2 => 
            array (
                'id' => 3,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'card' => 2,
                'card_expense' => 2,
                'installment' => 3,
                'value_installment' => 93.0,
                'pay' => '2022-03-15',
            ),
        ));
        
        
    }
}