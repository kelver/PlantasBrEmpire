<?php

use Phinx\Migration\AbstractMigration;

class CreatePessoa extends AbstractMigration
{
    public function up(){
        $this->table('pessoa')
            ->addColumn('nome', 'string')
            ->addColumn('email', 'string')
            ->addColumn('telefone', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('pessoa');
    }
}
