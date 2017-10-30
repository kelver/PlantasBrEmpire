<?php

use Phinx\Migration\AbstractMigration;

class CreatePlantasRegioes extends AbstractMigration
{
    public function up(){
        $this->table('plantas_regioes')
            ->addColumn('id_regiao', 'integer') // 0: foliar 1: casca
            ->addColumn('id_plantas', 'integer')
            ->addForeignKey('id_plantas', 'plants', 'id')
            ->addForeignKey('id_regiao', 'regioes', 'id')
            ->save();
    }

    public function down()
    {
        $this->dropTable('plantas_regioes');
    }
}
