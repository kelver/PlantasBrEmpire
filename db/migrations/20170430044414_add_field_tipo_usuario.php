<?php

use Phinx\Migration\AbstractMigration;

class AddFieldTipoUsuario extends AbstractMigration
{
    public function up()
    {
        $this->table('cadastro')
            ->addColumn('tipo', 'char',  array('default' => '0'))
            ->save();
    }

    public function down()
    {
        $this->table('cadastro')
            ->removeColumn('tipo');
    }
}