<?php

use Phinx\Migration\AbstractMigration;

class CreateReferencia extends AbstractMigration
{
    public function up(){
        $this->table('referencia')
            ->addColumn('texto', 'text')
            ->addColumn('link', 'string')
            ->addColumn('status', 'integer')
            ->addColumn('id_plantas', 'integer')
            ->addForeignKey('id_plantas', 'plants', 'id')
            ->save();
    }

    public function down()
    {
        $this->dropTable('referencia');
    }
}
