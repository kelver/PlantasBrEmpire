<?php

use Phinx\Migration\AbstractMigration;

class CreatePlantasContinentes extends AbstractMigration
{
    public function up(){
        $this->table('plantas_continentes')
            ->addColumn('id_continente', 'integer') // 0: foliar 1: casca
            ->addColumn('id_plantas', 'integer')
            ->addForeignKey('id_continente', 'continente', 'id')
            ->addForeignKey('id_plantas', 'plants', 'id')
            ->save();
    }

    public function down()
    {
        $this->dropTable('plantas_continentes');
    }
}
