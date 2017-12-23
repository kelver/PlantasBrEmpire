<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 29/05/17
 * Time: 00:35
 */

namespace PlantasBr\Models;


use Illuminate\Database\Eloquent\Model;

class plantasCaracteres extends Model
{
    //desabilita tentativas de campos updated_at e created_at
    public $timestamps = false;
    protected $table = 'plantas_caracteres_especiais';

    //mass assignment
    protected $fillable = [
        'id_plantas',
        'id_caracteres_especiais'
    ];

    public function caracteres()
    {
        return $this->belongsToMany(CaracteresEspeciais::class);
    }

    public function plantas()
    {
        return $this->belongsToMany(Plantas::class);
    }
}