<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 29/05/17
 * Time: 00:35
 */

namespace PlantasBr\Models;


use Illuminate\Database\Eloquent\Model;

class plantasRegioes extends Model
{
    //desabilita tentativas de campos updated_at e created_at
    public $timestamps = false;
    protected $table = 'plantas_regioes';

    //mass assignment
    protected $fillable = [
        'id_plantas',
        'id_regiao'
    ];

    public function regioes()
    {
        return $this->belongsToMany(Regioes::class);
    }

    public function plantas()
    {
        return $this->belongsToMany(Plantas::class);
    }
}