<?php

namespace App\Domain\User\Service;

use App\Base\Domain\Service;
use App\Domain\User\Repository\UserRepository;
use App\Exception\ValidationException;
use App\Helpers\CryptoHelper;

/**
 * Service.
 */
final class User extends Service
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->btc = new CryptoHelper();
    }

    public function usersList(int $page, int $rpp, string $userName): array
    {
        $offset = ($page - 1) * $rpp;
        return (array) $this->repository->usersList($offset, $rpp, $userName);
    }

    public function loginUser(string $userName): array
    {
        return $this->repository->loginUser($userName);
    }
}
