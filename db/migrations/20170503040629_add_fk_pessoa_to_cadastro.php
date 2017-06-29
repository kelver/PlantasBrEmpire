<?php

use Phinx\Migration\AbstractMigration;

class AddFkPessoaToCadastro extends AbstractMigration
{
    public function up()
    {
        $this->table('cadastro')
            ->addForeignKey('idPessoa', 'pessoa', 'id')
            ->save();
    }

    public function down()
    {
        $this->table('cadastro')
            ->dropForeignKey('idPessoa');
    }
}
