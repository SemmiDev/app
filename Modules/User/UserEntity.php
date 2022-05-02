<?php

namespace Modules\User\Entity;

class UserEntity
{
    public $id;
    public $email;
    public $password;
    public $idRole;
}

class UserUpdatePassword
{
    public $id;
    public $email;
    public $oldPassword;
    public $newPassword;
    public $idRole;
}

class UserEntityDetails
{
    public $id;
    public $email;
    public $password;
    public $user;

    public $idRole;
    public $role;

    public function __construct(UserEntity $userEntity, $roleEntity)
    {
        $this->email = $userEntity->email;
        $this->password = $userEntity->password;

        if (!is_null($roleEntity)) {
            $this->idRole = $roleEntity->id;
            $this->role = $roleEntity->nama;
        } else {
            $this->idRole = null;
            $this->role = null;
        }
    }
}
