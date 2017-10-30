<?php

use Phinx\Migration\AbstractMigration;

class CreatePlantasEstados extends AbstractMigration
{
    public function up(){
        $this->table('plantas_estados')
            ->addColumn('id_estado', 'integer') // 0: foliar 1: casca
            ->addColumn('id_plantas', 'integer')
            ->addForeignKey('id_plantas', 'plants', 'id')
            ->addForeignKey('id_estado', 'estados', 'id')
            ->save();
    }

    public function down()
    {
        $this->dropTable('plantas_estados');
    }
}
