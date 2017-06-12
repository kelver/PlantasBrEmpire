<?php

use Phinx\Seed\AbstractSeed;

class UserAdmSeeder extends AbstractSeed
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
        $userAdm = $this->table('userAdm');

        $data = [];

        foreach(range(1,3) as $value){
            $data[] = [
                'usuario' => 'kelver'. $value,
                'senha' => $auth->hashPassword('5190kelver')
            ];
        }
        $userAdm->insert($data)->save();
    }
}
