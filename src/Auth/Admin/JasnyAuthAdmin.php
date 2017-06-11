<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 23:27
 */

namespace PlantasBr\Auth\Admin;


use Jasny\Auth;
use Jasny\Auth\Sessions;
use Jasny\Auth\User;
use PlantasBr\Repository\RepositoryInterface;

class JasnyAuthAdmin extends Auth
{
    use Sessions;
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * JasnyAuth constructor.
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Fetch a user by ID
     *
     * @param int|string $id
     * @return User|null
     */
    public function fetchUserById($id)
    {
        return $this->repository->find($id, false);
    }

    /**
     * Fetch a user by username
     *
     * @param string $username
     * @return User|null
     */
    public function fetchUserByUsername($username)
    {
        return $this->repository->findByField('usuario', $username)[0];
    }
}