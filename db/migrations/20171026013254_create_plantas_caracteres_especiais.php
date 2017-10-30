<?php

use Phinx\Migration\AbstractMigration;

class CreatePlantasCaracteresEspeciais extends AbstractMigration
{
    public function up(){
        $this->table('plantas_caracteres_especiais')
            ->addColumn('id_caracteres_especiais', 'integer') // 0: foliar 1: casca
            ->addColumn('id_plantas', 'integer')
            ->addForeignKey('id_caracteres_especiais', 'caracteres_especiais', 'id')
            ->addForeignKey('id_plantas', 'plants', 'id')
            ->save();
    }

    public function down()
    {
        $this->dropTable('plantas_caracteres_especiais');
    }
}
