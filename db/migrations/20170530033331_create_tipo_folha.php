<?php

use Phinx\Migration\AbstractMigration;

class CreateTipoFolha extends AbstractMigration
{
    public function up(){
        $this->table('tipo_folha')
            ->addColumn('tipo_folha', 'string')
            ->save();
    }

    public function down()
    {
        $this->dropTable('tipo_folha');
    }
}
