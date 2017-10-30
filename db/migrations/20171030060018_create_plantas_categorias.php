<?php

use Phinx\Migration\AbstractMigration;

class CreatePlantasCategorias extends AbstractMigration
{
    public function up(){
        $this->table('plantas_categorias')
            ->addColumn('id_categoria', 'integer') // 0: foliar 1: casca
            ->addColumn('id_plantas', 'integer')
            ->addForeignKey('id_plantas', 'plants', 'id')
            ->addForeignKey('id_categoria', 'categorias', 'id')
            ->save();
    }

    public function down()
    {
        $this->dropTable('plantas_categorias');
    }
}
