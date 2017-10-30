<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 29/05/17
 * Time: 00:35
 */

namespace PlantasBr\Models;


use Illuminate\Database\Eloquent\Model;

class Plantas extends Model
{
    //desabilita tentativas de campos updated_at e created_at
    public $timestamps = false;
    protected $table = 'plants';

    //mass assignment
    protected $fillable = [
        'familia',
        'nome_cientifico',
        'nome_popular',
        'genero',
        'especie',
        'sinonimia',
        'outros_nomes_populares',
        'origem',
        'endemismo',
        'dominio_fitogeografico',
        'tipo_vegetacao',
        'clima',
        'substrato',
        'grau_umidade',
        'grupo_sucessional',
        'exigencia_luminica',
        'ciclo_vida',
        'deiscencia_foliar',
        'resumo',
        'informacoes',
        'informacoes_adicionais',
        'forma_vida',
        'altura_max',
        'unidade_altura',
        'filotaxia',
        'forma_folha',
        'margem_folha',
        'apice_folha',
        'base_folha',
        'tipo_folha',
        'consistencia_folha',
        'pilosidade_folha',
        'caracteres_especiais_folha',
        'nervacao_folha',
        'cor_flor',
        'plano_simetria_flor',
        'disposicao_flor',
        'corola_flor',
        'calice_flor',
        'perianto_flor',
        'estames_flor',
        'forma_corola_flor',
        'tipo_fruto',
        'cor_fruto',
        'aparencia_casca',
        'deiscencia_casca',
        'cor_interna_casca',
        'textura_interna_casca',
        'caracteres_especiais_casca',
        'status'
    ];
}