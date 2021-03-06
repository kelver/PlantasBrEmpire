<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateContatos extends AbstractMigration
{
    public function up(){
        $this->table('contatos')
            ->addColumn('nome', 'string')
            ->addColumn('email', 'string')
            ->addColumn('assunto', 'string')
            ->addColumn('mensagem', 'text', array('limit' => MysqlAdapter::TEXT_LONG))
            ->addColumn('status', 'char')
            ->addColumn('data', 'timestamp', array('default' => 'CURRENT_TIMESTAMP', 'null' => true))
            ->save();
    }

    public function down()
    {
        $this->dropTable('contatos');
    }
}
