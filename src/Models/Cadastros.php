<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 29/05/17
 * Time: 00:35
 */

namespace PlantasBr\Models;


use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;

class Cadastros extends Model implements JasnyUser, UserInterface
{
    //desabilita tentativas de campos updated_at e created_at
    public $timestamps = false;
    protected $table = 'cadastro';

    //mass assignment
    protected $fillable = [
        'usuario',
        'senha',
        'primeiro_acesso',
        'ultimo_acesso',
        'status',
        'idPessoa',
        'tipo'
    ];

    /**
     * Get user id
     *
     * @return int|string
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * Get user's username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->usuario;
    }

    /**
     * Get user's hashed password
     *
     * @return string
     */
    public function getHashedPassword(): string
    {
        return $this->senha;
    }

    /**
     * Event called on login.
     *
     * @return boolean  false cancels the login
     */
    public function onLogin()
    {
        // TODO: Implement onLogin() method.
    }

    /**
     * Event called on logout.
     *
     * @return void
     */
    public function onLogout()
    {
        // TODO: Implement onLogout() method.
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function getStatus(): string
    {
        return ($this->status == 1) ?
             'Ativo' :
             'Inativo';
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getRole(): int
    {
        return $this->tipo;
    }
}