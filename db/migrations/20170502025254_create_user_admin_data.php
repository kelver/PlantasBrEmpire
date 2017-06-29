<?php

use Phinx\Migration\AbstractMigration;

class CreateUserAdminData extends AbstractMigration
{
   public function up()
   {
       $app = require __DIR__ . '/../bootstrap.php';
       $auth = $app->service('auth');
       $idPessoa = $this->execute("select id from pessoa");

       $cadastros = $this->table('cadastro');
        $cadastros->insert([
            'usuario' => 'kelver',
            'senha' => $auth->hashPassword('123456'),
            'primeiro_acesso' => date('Y-m-d H:i:s'),
            'ultimo_acesso' => date('Y-m-d H:i:s'),
            'status' => 1,
            'idPessoa' => $idPessoa,
            'tipo' => 0 // 0 usuario comum, 1 usuário adm
        ])->save();
   }

   public function down()
   {
       $this->execute("DELETE FROM cadastro WHERE USUARIO = 'kelver'");
   }
}
