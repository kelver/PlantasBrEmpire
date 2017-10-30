<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 29/05/17
 * Time: 00:35
 */

namespace PlantasBr\Models;


use Illuminate\Database\Eloquent\Model;

class plantasContinentes extends Model
{
    //desabilita tentativas de campos updated_at e created_at
    public $timestamps = false;
    protected $table = 'plantas_continentes';

    //mass assignment
    protected $fillable = [
        'id_plantas',
        'id_continente'
    ];

    public function continentes()
    {
        return $this->belongsToMany(Continentes::class);
    }

    public function plantas()
    {
        return $this->belongsToMany(Plantas::class);
    }
}