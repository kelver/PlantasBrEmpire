<?php

use Phinx\Migration\AbstractMigration;

class CreatePaises extends AbstractMigration
{
    public function up(){
        $this->table('paises')
            ->addColumn('pais', 'string')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('paises');
    }
}
