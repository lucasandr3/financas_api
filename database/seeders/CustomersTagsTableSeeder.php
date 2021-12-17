<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers_tags')->delete();
        
        \DB::table('customers_tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tag' => 'Sem Restrição',
            ),
            1 => 
            array (
                'id' => 2,
                'tag' => 'Com Restrição',
            ),
        ));
        
        
    }
}