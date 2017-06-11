<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 22:44
 */
declare(strict_types=1);
namespace PlantasBr\Auth\Admin;


use PlantasBr\Models\UserAdmInterface;

interface AuthAdminInterface
{
    public function login(array $credentials):bool;
    public function check():bool;
    public function logout():void;
    public function hashPassword(string $password):string;
    public function user(): ?UserAdmInterface;
}