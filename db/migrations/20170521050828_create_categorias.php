<?php

use Phinx\Migration\AbstractMigration;

class CreateCategorias extends AbstractMigration
{
    public function up(){
        $this->table('categorias')
            ->addColumn('categoria', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('categorias');
    }
}
