<?php

use Phinx\Seed\AbstractSeed;

class EspeciesSeeder extends AbstractSeed
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
        $categorias = $this->table('especie');
        $data = [];

        foreach(range(1,6) as $value){
            $data[] = [
                    'especie' => 'especie' . $value,
                    'imagem' => 'especie' . $value . '.jpg'
                ];
        }
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
