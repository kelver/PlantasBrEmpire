<?php

use Phinx\Migration\AbstractMigration;

class CreateFotosPlantas extends AbstractMigration
{
    public function up(){
        $this->table('fotosPlantas')
            ->addColumn('foto', 'string')
            ->addColumn('legenda', 'text')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('fotosPlantas');
    }
}
