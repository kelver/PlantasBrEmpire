<?php

use Phinx\Seed\AbstractSeed;

class CadastrosSeeder extends AbstractSeed
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
        $app = require __DIR__ . '/../bootstrap.php';
        $auth = $app->service('auth');

        $faker = \Faker\Factory::create('pt_BR');
        $cadastros = $this->table('cadastro');

        $data = [];
        $i = 2;
        foreach(range(1,2) as $value){
            $data[] = [
                    'usuario' => $faker->firstName,
                    'senha' => $auth->hashPassword('123456'),
                    'primeiro_acesso' => date('Y-m-d H:i:s'),
                    'ultimo_acesso' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'idPessoa' => $i++,
                    'tipo' => 0, // 0 usuario comum, 1 usuário adm
                    'dataAssinatura' => date('Y-m-d'),
                    'periodoAssinatura' => '0'
                ];
        }
        $cadastros->insert($data)->save();
    }
}
