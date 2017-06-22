<?php

use Phinx\Migration\AbstractMigration;

class CreateGlossario extends AbstractMigration
{
    public function up(){
        $this->table('glossario')
            ->addColumn('nome', 'string')
            ->addColumn('descricao', 'text')
            ->addColumn('imagem', 'string')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('glossario');
    }
}
