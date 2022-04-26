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
        $statement = $this->connection->prepare("INSERT INTO fakultas(nama_fakultas, id_dekan, id_wakil_dekan_1, id_wakil_dekan_2, id_wakil_dekan_3) VALUES (?,?,?,?,?)");
        $statement->execute([$fakultas->nama, $fakultas->idDekan, $fakultas->idWakilDekan1, $fakultas->idWakilDekan2, $fakultas->idWakilDekan3]);
        return $fakultas;
    }

    public function update(FakultasEntity $fakultas): FakultasEntity
    {
        $statement = $this->connection->prepare("UPDATE fakultas SET nama_fakultas = ?, id_dekan = ?, id_wakil_dekan_1 = ?, id_wakil_dekan_2 = ?, id_wakil_dekan_3 = ? WHERE id_fakultas = ?");
        $statement->execute([$fakultas->nama, $fakultas->idDekan, $fakultas->idWakilDekan1, $fakultas->idWakilDekan2, $fakultas->idWakilDekan3, $fakultas->id]);
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
            $fakultas->idDekan = $row['id_dekan'];
            $fakultas->idWakilDekan1 = $row['id_wakil_dekan_1'];
            $fakultas->idWakilDekan2 = $row['id_wakil_dekan_2'];
            $fakultas->idWakilDekan3 = $row['id_wakil_dekan_3'];
            return $fakultas;
        }, $result);
    }

    public function findById($id): ? FakultasEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM fakultas WHERE id_fakultas = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $fakultas = new FakultasEntity();
                $fakultas->id = $row['id_fakultas'];
                $fakultas->nama = $row['nama_fakultas'];
                $fakultas->idDekan = $row['id_dekan'];
                $fakultas->idWakilDekan1 = $row['id_wakil_dekan_1'];
                $fakultas->idWakilDekan2 = $row['id_wakil_dekan_2'];
                $fakultas->idWakilDekan3 = $row['id_wakil_dekan_3'];
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