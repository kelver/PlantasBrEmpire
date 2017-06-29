<?php

use Phinx\Seed\AbstractSeed;

class PessoaSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $pessoa = $this->table('pessoa');

        /*$pessoa->insert([
            'nome' => 'Kelver',
            'email' => $faker->email,
            'telefone' => $faker->phoneNumber
        ])->save();*/

        $data = [];

        foreach(range(1,3) as $value){
            $data[] = [
                'nome' => $faker->name,
                'email' => $faker->email,
                'telefone' => $faker->phoneNumber
                ];
        }
        $pessoa->insert($data)->save();


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
