<?php

use Phinx\Seed\AbstractSeed;

class PaisesSeeder extends AbstractSeed
{
    public function run()
    {
        $paises = [
            'Brasil',
            'Estados Unidos da América',
            'França',
            'Japão',
            'Irlanda',
            'Israel'
        ];
        $paisTb = $this->table('paises');
        $data = [];

        foreach($paises as $pais){
            $data[] = [
                'pais' => $pais,
                'status' => 1
            ];
        }
        $paisTb->insert($data)->save();
    }
}
