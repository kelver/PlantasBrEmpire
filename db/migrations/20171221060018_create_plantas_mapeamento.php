<?php

use Phinx\Migration\AbstractMigration;

class CreatePlantasMapeamento extends AbstractMigration
{
    public function up(){
        $this->table('plantas_mapeamento')
            ->addColumn('latitude', 'string') // 0: foliar 1: casca
            ->addColumn('longitude', 'string')
            ->addColumn('fonte', 'string')
            ->addColumn('id_plantas', 'integer')
            ->addForeignKey('id_plantas', 'plants', 'id')
            ->save();
    }

    public function down()
    {
        $this->dropTable('plantas_mapeamento');
    }
}
