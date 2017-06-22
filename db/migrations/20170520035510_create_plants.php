<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreatePlants extends AbstractMigration
{
    public function up(){
        $this->table('plants')
            ->addColumn('familia', 'string')
            ->addColumn('nome_cientifico', 'string')
            ->addColumn('nome_popular', 'string')
            ->addColumn('genero', 'integer')
            ->addColumn('especie', 'integer')
            ->addColumn('sinonimia', 'text')
            ->addColumn('outros_nomes_populares', 'text')
            ->addColumn('origem', 'integer')
            ->addColumn('endemismo', 'integer')
            ->addColumn('continente', 'integer')
            ->addColumn('pais', 'integer')
            ->addColumn('dominio_fitogeografico', 'string')
            ->addColumn('tipo_vegetacao', 'string')
            ->addColumn('substrato', 'string')
            ->addColumn('grau_umidade', 'string')
            ->addColumn('grupo_sucessional', 'string')
            ->addColumn('exigencia_luminica', 'string')
            ->addColumn('ciclo_vida', 'string')
            ->addColumn('deiscencia_foliar', 'string')
            ->addColumn('resumo', 'text', array('limit' => MysqlAdapter::TEXT_LONG))
            ->addColumn('informacoes', 'text', array('limit' => MysqlAdapter::TEXT_LONG))
            ->addColumn('informacoes_adicionais', 'text', array('limit' => MysqlAdapter::TEXT_LONG))
            ->addColumn('forma_vida', 'string')
            ->addColumn('autura_max', 'integer')
            ->addColumn('unidade_autura', 'string', array('limit' => 2))
            ->addColumn('filotaxia', 'string')
            ->addColumn('forma_folha', 'string')
            ->addColumn('margem_folha', 'string')
            ->addColumn('apice_folha', 'string')
            ->addColumn('base_folha', 'string')
            ->addColumn('tipo_folha', 'string')
            ->addColumn('consistencia_folha', 'string')
            ->addColumn('pilosidade_folha', 'string')
            ->addColumn('caracteres_especiais_folha', 'string')
            ->addColumn('nervacao_folha', 'string')
            ->addColumn('cor_flor', 'string')
            ->addColumn('plano_simetria_flor', 'string')
            ->addColumn('disposicao_flor', 'integer')
            ->addColumn('corola_flor', 'string')
            ->addColumn('calice_flor', 'string')
            ->addColumn('perianto_flor', 'string')
            ->addColumn('estames_flor', 'string')
            ->addColumn('forma_corola_flor', 'string')
            ->addColumn('tipo_fruto', 'string')
            ->addColumn('cor_fruto', 'string')
            ->addColumn('aparencia_casca', 'string')
            ->addColumn('deiscencia_casca', 'string')
            ->addColumn('cor_interna_casca', 'string')
            ->addColumn('textura_interna_casca', 'string')
            ->addColumn('caracteres_especiais_casca', 'string')
            ->addColumn('status', 'integer')
            ->save();
    }

    public function down()
    {
        $this->dropTable('plants');
    }
}
