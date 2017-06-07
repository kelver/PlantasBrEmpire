<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 06/06/17
 * Time: 01:43
 */

namespace PlantasBr\Models;


interface UserInterface
{
    public function getId():int;
    public function getUsuario():string;
    public function getStatus():string;
    public function getSenha():string;
}