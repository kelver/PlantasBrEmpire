<?php

use Phinx\Migration\AbstractMigration;

class CreateContinente extends AbstractMigration
{
    public function up(){
        $this->table('continente')
            ->addColumn('continente', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('continente');
    }
}
