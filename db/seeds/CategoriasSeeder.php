<?php

use Phinx\Seed\AbstractSeed;

class CategoriasSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $categorias = $this->table('categorias');
        $data = [];

//        foreach(range(1,10) as $value){
            $data[] = [
                    'categoria' => $faker->name
                ];
//        }
        $categorias->insert($data)->save();


        //sem faker
//        $categorias->insert([
//            [
//                'categoria' => 'categoria1'
//            ],[
//                'categoria' => 'categoria2'
//            ]
//        ])->save();
    }
}
