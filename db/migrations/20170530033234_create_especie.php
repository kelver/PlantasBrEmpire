<?php

use Phinx\Migration\AbstractMigration;

class CreateEspecie extends AbstractMigration
{
    public function up(){
        $this->table('especie')
            ->addColumn('especie', 'string')
            ->addColumn('imagem', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('especie');
    }
}
