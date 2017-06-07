<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 29/05/17
 * Time: 00:35
 */

namespace PlantasBr\Models;


use Illuminate\Database\Eloquent\Model;

class Especies extends Model
{
    //desabilita tentativas de campos updated_at e created_at
    public $timestamps = false;
    protected $table = 'especie';

    //mass assignment
    protected $fillable = [
        'especie',
        'imagem'
    ];
}