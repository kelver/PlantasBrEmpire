<?php

use Phinx\Migration\AbstractMigration;

class CreateVideosPlantas extends AbstractMigration
{
    public function up(){
        $this->table('videosPlantas')
            ->addColumn('video', 'string')
            ->addColumn('legenda', 'text')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('videosPlantas');
    }
}
