<?php

use Phinx\Migration\AbstractMigration;

class CreatePlantasPaises extends AbstractMigration
{
    public function up(){
        $this->table('plantas_paises')
            ->addColumn('id_pais', 'integer') // 0: foliar 1: casca
            ->addColumn('id_plantas', 'integer')
            ->addForeignKey('id_pais', 'paises', 'id')
            ->addForeignKey('id_plantas', 'plants', 'id')
            ->save();
    }

    public function down()
    {
        $this->dropTable('plantas_paises');
    }
}
