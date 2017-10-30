<?php

use Phinx\Migration\AbstractMigration;

class CreateEstados extends AbstractMigration
{
    public function up(){
        $this->table('estados')
            ->addColumn('estado', 'string')
            ->addColumn('sigla', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('estados');
    }
}
