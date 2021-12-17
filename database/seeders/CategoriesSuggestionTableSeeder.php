<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesSuggestionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories_suggestion')->delete();
        
        \DB::table('categories_suggestion')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Aparência',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Experiência de Usuário',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ferramentas',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Funcionalidade',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Integraçoes',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Elogio',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Reclamação',
            ),
        ));
        
        
    }
}