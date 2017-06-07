<?php

use Phinx\Migration\AbstractMigration;

class CreatePlano extends AbstractMigration
{
    public function up(){
        $this->table('plano')
            ->addColumn('nome_plano', 'string')
            ->addColumn('valor_plano', 'decimal', 10, 2)
            ->addColumn('data_cadastro', 'datetime')
            ->addColumn('validade', 'datetime')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('plano');
    }
}
