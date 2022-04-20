<?php

namespace Modules\Fakultas\Repository;

use Modules\Fakultas\Entity\FakultasEntity;

class FakultasRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(FakultasEntity $fakultas): FakultasEntity
    {
        $statement = $this->connection->prepare("INSERT INTO fakultas(nama_fakultas) VALUES (?)");
        $statement->execute([$fakultas->nama]);
        return $fakultas;
    }

    public function update(FakultasEntity $fakultas): FakultasEntity
    {
        $statement = $this->connection->prepare("UPDATE fakultas SET nama_fakultas = ? WHERE id_fakultas = ?");
        $statement->execute([$fakultas->nama, $fakultas->id]);
        return $fakultas;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM fakultas");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $fakultas = new FakultasEntity();
            $fakultas->id = $row['id_fakultas'];
            $fakultas->nama = $row['nama_fakultas'];
            return $fakultas;
        }, $result);
    }

    public function findById(int $id): ? FakultasEntity
    {
        $statement = $this->connection->prepare("SELECT id_fakultas, nama_fakultas FROM fakultas WHERE id_fakultas = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $fakultas = new FakultasEntity();
                $fakultas->id = $row['id_fakultas'];
                $fakultas->nama = $row['nama_fakultas'];
                return $fakultas;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM fakultas WHERE id_fakultas = ?");
        $statement->execute([$id]);
    }
}