<?php

use Phinx\Migration\AbstractMigration;

class CreateRegioes extends AbstractMigration
{
    public function up(){
        $this->table('regioes')
            ->addColumn('regiao', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('regioes');
    }
}
