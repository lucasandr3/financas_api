<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'full_name' => 'Ana Paula Vieira de Andrade',
                'name_alias' => 'Ana Paula',
                'document' => '11597906638',
                'phone' => '34988373408',
                'email' => 'anapaula@gmail.com',
                'zipcode' => '38440290',
                'street' => 'Rua Central',
                'number' => '281',
                'neighborhood' => 'Aeroporto',
                'city' => 'Araguari',
                'state' => 'MG',
                'tag' => 1,
                'score' => 3,
            ),
        ));
        
        
    }
}