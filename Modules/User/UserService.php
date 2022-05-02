<?php

namespace Modules\User\Service;

use Config\Database;
use Modules\Exception\ValidationException;
use Modules\Role\Repository\RoleRepository;
use Modules\User\Entity\UserEntity;
use Modules\User\Entity\UserEntityDetails;
use Modules\User\Entity\UserUpdatePassword;
use Modules\User\Repository\UserRepository;

class UserService {
    private UserRepository $userRepository;
    private RoleRepository $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function register(UserEntity $req): UserEntity
    {
        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByEmail($req->email);
            if ($user != null) {
                throw new ValidationException("User telah terdaftar");
            }

            $req->password = password_hash($req->password, PASSWORD_BCRYPT);
            $this->userRepository->save($req);
            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function login(UserEntity $req): UserEntityDetails
    {
        $user = $this->userRepository->findByEmail($req->email);
        if (!$user) {
            throw new ValidationException('Account tidak ditemukan');
        }
        if (!password_verify($req->password, $user->password)) {
            throw new ValidationException('Password salah');
        }

        $userDetails =  new UserEntityDetails($user, $this->roleRepository->findById($user->idRole));
        $userDetails->id = $user->id;
        return $userDetails;
    }
    
    
    public function updatePassword(UserUpdatePassword $req): UserEntity
    {
        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByEmail($req->email);
            if ($user == null) {
                throw new ValidationException("User not found");
            }

            if (!password_verify($req->oldPassword, $user->password)) {
                throw new ValidationException("Old password is wrong");
            }

            $user->password = password_hash($req->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->update($user);

            Database::commitTransaction();
            return $user;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function updatePasswordDirectly(UserUpdatePassword $req): UserEntity
    {
        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByEmail($req->email);
            if ($user == null) {
                throw new ValidationException("User not found");
            }
            
            $user->password = password_hash($req->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->update($user);

            Database::commitTransaction();
            return $user;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}
