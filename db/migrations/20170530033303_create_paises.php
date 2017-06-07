<?php

use Phinx\Migration\AbstractMigration;

class CreatePaises extends AbstractMigration
{
    public function up(){
        $this->table('paises')
            ->addColumn('paises', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('paises');
    }
}
