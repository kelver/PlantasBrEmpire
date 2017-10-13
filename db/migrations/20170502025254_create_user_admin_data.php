<?php

use Phinx\Migration\AbstractMigration;

class CreateUserAdminData extends AbstractMigration
{
   public function up()
   {
       $app = require __DIR__ . '/../bootstrap.php';
       $auth = $app->service('auth');

       $i='';
       foreach(range(1,2) as $value) {
           $cadastros = $this->table('cadastro');
           $cadastros->insert([
               'usuario' => 'kelver'.$i,
               'senha' => $auth->hashPassword('123456'),
               'primeiro_acesso' => null,
               'ultimo_acesso' => date('Y-m-d H:i:s'),
               'status' => 1,
               'idPessoa' => 1,
               'tipo' => ($i=='')?1:0, // 0 usuario comum, 1 usuário adm
               'dataAssinatura' => date('Y-m-d'),
               'periodoAssinatura' => '1'
           ])->save();
           $i=2;
       }
   }

   public function down()
   {
       $this->execute("DELETE FROM cadastro WHERE USUARIO = 'kelver'");
   }
}
