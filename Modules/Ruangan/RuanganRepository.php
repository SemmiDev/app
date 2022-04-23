<?php

namespace Modules\Ruangan\Repository;

use Modules\Ruangan\Entity\RuanganEntity;

class RuanganRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(RuanganEntity $ruangan): RuanganEntity {
        $statement = $this->connection->prepare("INSERT INTO ruangan (nama,jenis,kapasitas,lantai,latitude,longitude) VALUES (?,?,?,?,?,?)");
        $statement->execute([
            $ruangan->nama,
            $ruangan->jenis,
            $ruangan->kapasitas,
            $ruangan->lantai,
            $ruangan->latitude,
            $ruangan->longitude,
        ]);
        return $ruangan;
    }

    public function update(RuanganEntity $ruangan): RuanganEntity
    {
        $statement = $this->connection->prepare("UPDATE ruangan SET nama = ?, jenis = ?, kapasitas = ?, lantai = ?, latitude = ?, longitude = ? WHERE id_ruangan = ?");
        $statement->execute([
            $ruangan->nama,
            $ruangan->jenis,
            $ruangan->kapasitas,
            $ruangan->lantai,
            $ruangan->latitude,
            $ruangan->longitude,
            $ruangan->id,
        ]);
        return $ruangan;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM ruangan");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $ruangan = new RuanganEntity();
            $ruangan->id = $row['id_ruangan'];
            $ruangan->nama = $row['nama'];
            $ruangan->jenis = $row['jenis'];
            $ruangan->kapasitas = $row['kapasitas'];
            $ruangan->lantai = $row['lantai'];
            $ruangan->latitude = $row['latitude'];
            $ruangan->longitude = $row['longitude'];
            return $ruangan;
        }, $result);
    }

    public function findById(int $id): ? RuanganEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM ruangan WHERE id_ruangan = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $ruangan = new RuanganEntity();
                $ruangan->id = $row['id_ruangan'];
                $ruangan->nama = $row['nama'];
                $ruangan->jenis = $row['jenis'];
                $ruangan->kapasitas = $row['kapasitas'];
                $ruangan->lantai = $row['lantai'];
                $ruangan->latitude = $row['latitude'];
                $ruangan->longitude = $row['longitude'];
                return $ruangan;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM ruangan WHERE id_ruangan = ?");
        $statement->execute([$id]);
    }
}