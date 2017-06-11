<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 06/06/17
 * Time: 01:43
 */

namespace PlantasBr\Models;


interface UserAdmInterface
{
    public function getId():int;
    public function getUsuario():string;
    public function getSenha():string;
}