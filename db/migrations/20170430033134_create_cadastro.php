<?php

use Phinx\Migration\AbstractMigration;

class CreateCadastro extends AbstractMigration
{
    public function up(){
        $this->table('cadastro')
            ->addColumn('usuario', 'string')
            ->addColumn('senha', 'string')
            ->addColumn('primeiro_acesso', 'datetime')
            ->addColumn('ultimo_acesso', 'datetime')
            ->addColumn('status', 'integer')
            ->addColumn('idPessoa', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('cadastro');
    }
}
