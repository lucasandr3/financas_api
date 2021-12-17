<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LendingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lendings')->delete();
        
        \DB::table('lendings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category' => 11,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'title' => 'casa',
                'reason' => 'empréstimo para pagar casa',
                'value_lending' => 1500.0,
                'interest' => 0.0,
                'installments' => 0,
                'quantity_installments' => 1,
                'pay_date' => '2022-01-20',
            ),
            1 => 
            array (
                'id' => 2,
                'category' => 11,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'title' => 'compra computadores',
                'reason' => 'compra de computadores para empresa mlv',
                'value_lending' => 5000.0,
                'interest' => 1.2,
                'installments' => 1,
                'quantity_installments' => 5,
                'pay_date' => '2021-01-10',
            ),
        ));
        
        
    }
}