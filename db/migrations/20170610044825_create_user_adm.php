<?php

use Phinx\Migration\AbstractMigration;

class CreateUserAdm extends AbstractMigration
{
    public function up(){
        $this->table('userAdm')
            ->addColumn('usuario', 'string')
            ->addColumn('senha', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('userAdm');
    }
}
