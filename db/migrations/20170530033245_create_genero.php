<?php

use Phinx\Migration\AbstractMigration;

class CreateGenero extends AbstractMigration
{
    public function up(){
        $this->table('genero')
            ->addColumn('genero', 'string')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('genero');
    }
}
