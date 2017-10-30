 <?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 21/05/17
 * Time: 01:33
 */

//automatizando migrações e seeders

 exec(__DIR__ . '/vendor/bin/phinx rollback -t=0');
 exec(__DIR__ . '/vendor/bin/phinx migrate');
 exec(__DIR__ . '/vendor/bin/phinx seed:run -s PessoaSeeder');
 exec(__DIR__ . '/vendor/bin/phinx seed:run -s CadastrosSeeder');
 exec(__DIR__ . '/vendor/bin/phinx seed:run -s EspeciesSeeder');
 exec(__DIR__ . '/vendor/bin/phinx seed:run -s CategoriasSeeder');
 exec(__DIR__ . '/vendor/bin/phinx seed:run -s EstadosSeeder');
 exec(__DIR__ . '/vendor/bin/phinx seed:run -s RegioesSeeder');
 exec(__DIR__ . '/vendor/bin/phinx seed:run -s ContinentesSeeder');
 exec(__DIR__ . '/vendor/bin/phinx seed:run -s PaisesSeeder');