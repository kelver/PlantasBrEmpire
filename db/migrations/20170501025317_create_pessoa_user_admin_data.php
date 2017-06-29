<?php

use Phinx\Migration\AbstractMigration;

class CreatePessoaUserAdminData extends AbstractMigration
{
    public function up()
    {
        $pessoa = $this->table('pessoa');

        $pessoa->insert([
            'id' => 1,
            'nome' => 'Kelver',
            'email' => 'kelver_kmv@hotmail.com',
            'telefone' => '65 99245-3503'
        ])->save();
    }

    public function down()
    {
        $this->execute("DELETE FROM pessoa WHERE email = 'kelver_kmv@hotmail.com' ");
    }

}
