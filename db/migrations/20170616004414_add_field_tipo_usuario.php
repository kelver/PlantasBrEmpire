<?php

use Phinx\Migration\AbstractMigration;

class AddFieldTipoUsuario extends AbstractMigration
{
    public function up()
    {
        $this->table('cadastro')
            ->addColumn('tipo', 'char')
            ->save();
    }

    public function down()
    {
        $this->table('cadastro')
            ->removeColumn('tipo', 'integer');
    }
}