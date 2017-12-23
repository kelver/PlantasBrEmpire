<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 29/05/17
 * Time: 00:35
 */

namespace PlantasBr\Models;


use Illuminate\Database\Eloquent\Model;

class mapeamentosPlantas extends Model
{
    //desabilita tentativas de campos updated_at e created_at
    public $timestamps = false;
    protected $table = 'plantas_mapeamento';

    //mass assignment
    protected $fillable = [
        'latitude',
        'longitude',
        'fonte',
	    'id_plantas'
    ];
}