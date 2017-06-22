<?php

use Phinx\Migration\AbstractMigration;

class CreateOrigem extends AbstractMigration
{
    public function up(){
        $this->table('origem')
            ->addColumn('origem', 'string')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('origem');
    }
}
