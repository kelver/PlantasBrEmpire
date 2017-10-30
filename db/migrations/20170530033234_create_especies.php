<?php

use Phinx\Migration\AbstractMigration;

class CreateEspecies extends AbstractMigration
{
    public function up(){
        $this->table('especies')
            ->addColumn('especie', 'string')
            ->addColumn('imagem', 'string')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('especies');
    }
}
