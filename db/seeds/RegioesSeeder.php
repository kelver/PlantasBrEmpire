<?php

use Phinx\Seed\AbstractSeed;

class RegioesSeeder extends AbstractSeed
{
    public function run()
    {
        $regioes = [
            'Norte',
            'Sul',
            'Nordeste',
            'Sudeste',
            'Centro-Oeste'
        ];
        $region = $this->table('regioes');
        $data = [];

        foreach($regioes as $regiao){
            $data[] = [
                'regiao' => $regiao
            ];
        }
        $region->insert($data)->save();
    }
}
