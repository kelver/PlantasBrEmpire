<?php

use Phinx\Seed\AbstractSeed;

class ContinentesSeeder extends AbstractSeed
{
    public function run()
    {
        $continentes = [
            'África',
            'América',
            'Antártica',
            'Ásia',
            'Europa',
            'Oceania'
        ];
        $continenteTb = $this->table('continente');
        $data = [];

        foreach($continentes as $continente){
            $data[] = [
                'continente' => $continente,
                'status' => 1
            ];
        }
        $continenteTb->insert($data)->save();
    }
}
