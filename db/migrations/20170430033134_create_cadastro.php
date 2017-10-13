<?php

use Phinx\Migration\AbstractMigration;

class CreateCadastro extends AbstractMigration
{
    public function up(){
        $this->table('cadastro')
            ->addColumn('usuario', 'string')
            ->addColumn('senha', 'string')
            ->addColumn('primeiro_acesso', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'null' => true))
            ->addColumn('ultimo_acesso', 'timestamp',  array('default' => 'CURRENT_TIMESTAMP', 'null' => true))
            ->addColumn('status', 'integer', array('default' => '1'))//1:ativo 0:inativo
            ->addColumn('idPessoa', 'integer')
            ->addColumn('dataAssinatura', 'timestamp',  array('default' => 'CURRENT_TIMESTAMP', 'null' => true))
            ->addColumn('periodoAssinatura', 'integer',  array('default' => '0')) // 0:anual 1: mensal
            ->addColumn('statusAssinatura', 'integer',  array('default' => '0')) // 0:inativa 1: ativa
            ->save();
    }

    public function down()
    {
        $this->dropTable('cadastro');
    }
}
