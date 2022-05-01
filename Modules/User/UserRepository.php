<?php

namespace Modules\User\Repository;

use Modules\User\Entity\UserEntity;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(UserEntity $user): UserEntity
    {
        $statement = $this->connection->prepare("INSERT INTO users(email, password, id_role) VALUES (?,?,?)");
        $statement->execute([$user->email, $user->password, $user->idRole]);
        return $user;
    }

    public function update(UserEntity $user)
    {
        $statement = $this->connection->prepare("UPDATE users SET email = ?, password = ?, id_role = ? WHERE id_user = ?");
        $statement->execute([
            $user->email,
            $user->password,
            $user->idRole,
            $user->id,
        ]);
        return $user;
    }

    public function findById(int $id): ?UserEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE id_user = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new UserEntity();
                $user->id = $row['id_user'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->idRole = $row['id_role'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
        $statement->execute([$email]);

        try {
            if ($row = $statement->fetch()) {
                $user = new UserEntity();
                $user->id = $row['id_user'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->idRole = $row['id_role'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE id_user = ?");
        $statement->execute([$id]);
    }
}
