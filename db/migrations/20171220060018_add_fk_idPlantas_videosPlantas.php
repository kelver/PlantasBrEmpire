<?php

use Phinx\Migration\AbstractMigration;

class AddFkIdPlantasVideosPlantas extends AbstractMigration
{
    public function up(){
	    $this->table('videosPlantas')
	         ->addColumn('id_plantas', 'integer')
	         ->addForeignKey('id_plantas', 'plants', 'id')
	         ->save();
    }

    public function down()
    {
	    $this->table('videosPlantas')
	         ->dropForeignKey('id_plantas');
    }
}
