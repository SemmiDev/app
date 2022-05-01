<?php

namespace Modules\Role\Repository;

use Modules\Role\Entity\RoleEntity;

class RoleRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(RoleEntity $role): RoleEntity
    {
        $statement = $this->connection->prepare("INSERT INTO roles(nama) VALUES (?)");
        $statement->execute([$role->nama]);
        return $role;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM roles");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $role = new RoleEntity();
            $role->id = $row['id_role'];
            $role->nama = $row['nama'];
            return $role;
        }, $result);
    }

    public function findById($id): ? RoleEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM roles WHERE id_role = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $role = new RoleEntity();
                $role->id = $row['id_role'];
                $role->nama = $row['nama'];
                return $role;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM roles WHERE id_role = ?");
        $statement->execute([$id]);
    }
}