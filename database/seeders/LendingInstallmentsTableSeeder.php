<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LendingInstallmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lending_installments')->delete();
        
        \DB::table('lending_installments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'lending' => 2,
                'installment' => 1,
                'value_installment' => 1060.0,
                'pay' => '2022-01-10',
            ),
            1 => 
            array (
                'id' => 2,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'lending' => 2,
                'installment' => 2,
                'value_installment' => 1060.0,
                'pay' => '2022-02-10',
            ),
            2 => 
            array (
                'id' => 3,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'lending' => 2,
                'installment' => 3,
                'value_installment' => 1060.0,
                'pay' => '2022-03-10',
            ),
            3 => 
            array (
                'id' => 4,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'lending' => 2,
                'installment' => 4,
                'value_installment' => 1060.0,
                'pay' => '2022-04-10',
            ),
            4 => 
            array (
                'id' => 5,
                'company' => '004fb5e7-0a12-4e55-bd2d-c742851ea909',
                'lending' => 2,
                'installment' => 5,
                'value_installment' => 1060.0,
                'pay' => '2022-05-10',
            ),
        ));
        
        
    }
}