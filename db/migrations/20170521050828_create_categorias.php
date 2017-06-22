<?php

use Phinx\Migration\AbstractMigration;

class CreateCategorias extends AbstractMigration
{
    public function up(){
        $this->table('categorias')
            ->addColumn('categoria', 'string')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('categorias');
    }
}
