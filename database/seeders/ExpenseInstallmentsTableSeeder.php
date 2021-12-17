<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExpenseInstallmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('expense_installments')->delete();
        
        \DB::table('expense_installments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'expense' => 2,
                'installment' => 1,
                'value_installment' => 700.0,
                'pay' => '2021-08-10',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'expense' => 2,
                'installment' => 2,
                'value_installment' => 700.0,
                'pay' => '2021-09-10',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'expense' => 2,
                'installment' => 3,
                'value_installment' => 700.0,
                'pay' => '2021-10-10',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'expense' => 2,
                'installment' => 4,
                'value_installment' => 700.0,
                'pay' => '2021-11-10',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'expense' => 2,
                'installment' => 5,
                'value_installment' => 700.0,
                'pay' => '2021-11-02',
            ),
            5 => 
            array (
                'id' => 90,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 1,
                'value_installment' => 166.67,
                'pay' => '2022-01-16',
            ),
            6 => 
            array (
                'id' => 91,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 2,
                'value_installment' => 166.67,
                'pay' => '2022-02-16',
            ),
            7 => 
            array (
                'id' => 92,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 3,
                'value_installment' => 166.67,
                'pay' => '2022-03-16',
            ),
            8 => 
            array (
                'id' => 93,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 4,
                'value_installment' => 166.67,
                'pay' => '2022-04-16',
            ),
            9 => 
            array (
                'id' => 94,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 5,
                'value_installment' => 166.67,
                'pay' => '2022-05-16',
            ),
            10 => 
            array (
                'id' => 95,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 6,
                'value_installment' => 166.67,
                'pay' => '2022-06-16',
            ),
            11 => 
            array (
                'id' => 96,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 7,
                'value_installment' => 166.67,
                'pay' => '2022-07-16',
            ),
            12 => 
            array (
                'id' => 97,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 8,
                'value_installment' => 166.67,
                'pay' => '2022-08-16',
            ),
            13 => 
            array (
                'id' => 98,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 9,
                'value_installment' => 166.67,
                'pay' => '2022-09-16',
            ),
            14 => 
            array (
                'id' => 99,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 10,
                'value_installment' => 166.67,
                'pay' => '2022-10-16',
            ),
            15 => 
            array (
                'id' => 100,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 11,
                'value_installment' => 166.67,
                'pay' => '2022-11-16',
            ),
            16 => 
            array (
                'id' => 101,
                'user_id' => 1,
                'expense' => 29,
                'installment' => 12,
                'value_installment' => 166.67,
                'pay' => '2022-12-16',
            ),
        ));
        
        
    }
}