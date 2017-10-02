<?php

use Phinx\Migration\AbstractMigration;

class CreateCaracteresEspeciais extends AbstractMigration
{
    public function up(){
        $this->table('caracteres_especiais')
            ->addColumn('caracter', 'string')
            ->addColumn('tipo', 'integer') // 0: foliar 1: casca
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('caracteres_especiais');
    }
}
