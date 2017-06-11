<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 22:46
 */

namespace PlantasBr\Auth\Admin;


use PlantasBr\Models\UserAdmInterface;

class AuthAdmin implements AuthAdminInterface
{
    /**
     * @var JasnyAuthAdmin
     */
    private $jasnyAuth;

    /**
     * Auth constructor.
     */
    public function __construct(JasnyAuthAdmin $jasnyAuth)
    {
        $this->jasnyAuth = $jasnyAuth;
        $this->sessionStart();
    }

    public function login(array $credentials): bool
    {
        list('usuario' => $usuario, 'senha' => $senha) = $credentials;
        return $this->jasnyAuth->login($usuario, $senha) !== null;
    }

    public function check(): bool
    {
        return $this->user() !== null;
    }

    public function logout(): void
    {
        $this->jasnyAuth->logout();
    }

    public function user(): ?UserAdmInterface
    {
        return $this->jasnyAuth->user();
    }

    public function hashPassword(string $password): string
    {
        return $this->jasnyAuth->hashPassword($password);
    }

    protected function sessionStart()
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }
}