<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Exception\ValidationException;
use App\Helpers\BTCValidate;

/**
 * Service.
 */
final class User
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->btc = new BTCValidate();
    }

    public function readUser(int $userId = null): array
    {

        return (array) $this->repository->readUser($userId);
    }

    public function findUser(array $params): array
    {

        return (array) $this->repository->findUser($params);
    }
    public function usersList(int $page, int $rpp, string $userName): array
    {
        $offset = ($page - 1) * $rpp;
        return (array) $this->repository->usersList($offset, $rpp, $userName);
    }

    public function createUser(array $data, bool $override = false): int
    {
        // Input validation
        $this->validateNewUser($data, $override);

        // password hash
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        // Insert user
        $userId = $this->repository->insertUser($data);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $userId;
    }

    private function validateNewUser(array $data, bool $override = false): void
    {
        $errors = [];

        // validate fullName
        if (empty($data['fullName'])) {
            $errors['fullName'] = 'Full Name is required.';
        } elseif (strlen($data['fullName']) < 5) {
            $errors['fullName'] = 'Enter a valid full name.';
        }

        // validate userName
        if (empty($data['userName'])) {
            $errors['userName'] = 'Username is required.';
        } elseif ($this->repository->usernameInUse($data['userName'])) {
            $errors['userName'] = 'Username in use.';
        }

        // validate email 
        if (empty($data['email'])) {
            $errors['email'] = 'Email is required.';
        } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Invalid email address.';
        } elseif ($this->repository->emailInUse($data['email']) && !$override) {
            $errors['email'] = 'Email in use.';
        }

        // validate password
        if (empty($data['password'])) {
            $errors['password'] = 'Password is required.';
        } elseif (strlen($data['password']) < 4) {
            $errors['password'] = 'Password should be at least 4 characters.';
        }

        // validate bitcoinWalletAddress

        if (
            !empty($data['bitcoinWalletAddress']) &&
            empty($this->btc->validate($data['bitcoinWalletAddress']))
        ) {
            $errors['bitcoinWalletAddress'] = 'Invalid Bitcoin wallet Address.';
        }

        if ($errors) {
            $errors = implode(" ", $errors);
            throw new ValidationException($errors);
        }
    }

    public function deleteUser($userId): bool
    {
        return $this->repository->deleteUser($userId);
    }

    public function updateUser(int $userId, array $data): bool
    {
        if (array_key_exists('password', $data) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        $this->validateUpdateUser($data);

        return $this->repository->updateUser($userId, $data);
    }
    private function validateUpdateUser(array $data): void
    {
        $errors = [];

        // validate fullName
        if (isset($data['fullName']))
            if (empty($data['fullName'])) {
                $errors['fullName'] = 'Full Name cannot be empty.';
            } elseif (strlen($data['fullName']) < 5) {
                $errors['fullName'] = 'Enter a valid name.';
            }

        // validate userName
        if (isset($data['userName'])) {
            $errors['userName'] = 'Username cannot be updated.';
        }

        // validate email
        if (isset($data['email']))
            if (empty($data['email'])) {
                $errors['email'] = 'Email cannot be empty.';
            } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Invalid email address.';
            }

        // validate bitcoinWalletAddress
        if (isset($data['bitcoinWalletAddress']))
            if (
                !empty($data['bitcoinWalletAddress']) &&
                empty($this->btc->validate($data['bitcoinWalletAddress']))
            ) {
                $errors['bitcoinWalletAddress'] = 'Invalid Bitcoin Wallet Address.';
            }

        if ($errors) {
            $errors = implode(" ", $errors);
            throw new ValidationException($errors);
        }
    }

    public function loginUser(string $userName): array
    {
        return $this->repository->loginUser($userName);
    }
}
