<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'full_name' => 'Lucas Vieira de Andrade',
                'first_name' => 'Lucas',
                'last_name' => 'Vieira',
                'email' => 'lucasvieiraandrade58@gmail.com',
                'password' => '$2y$10$S21Mu7e1XzEjLaO7gAgJ7OKKli0147qx2Q6Bi8CDKQnqm3Fw6DhPK',
                'created_at' => '2021-12-09 15:19:56',
                'updated_at' => '2021-12-09 15:19:56',
            ),
            1 => 
            array (
                'id' => 2,
                'full_name' => 'Lorraine Macedo de Sousa',
                'first_name' => 'Lorraine',
                'last_name' => 'Macedo',
                'email' => 'lorrainemacedo@hotmail.com',
                'password' => '$2y$10$qQuO4QaCxv8BntNt6FoA3esEyGpbEgxCYkLE.4EO07MbSBFUdsCUa',
                'created_at' => '2021-12-10 16:18:35',
                'updated_at' => '2021-12-10 16:18:35',
            ),
        ));
        
        
    }
}