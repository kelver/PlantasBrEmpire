<?php

use Phinx\Migration\AbstractMigration;

class CreateEndemismo extends AbstractMigration
{
    public function up(){
        $this->table('endemismo')
            ->addColumn('endemismo', 'string')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('endemismo');
    }
}
