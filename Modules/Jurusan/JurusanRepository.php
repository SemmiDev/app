<?php

namespace Modules\Jurusan\Repository;

use Modules\Jurusan\Entity\JurusanEntity;

class JurusanRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function totalJurusanInFakultas(int $fakultasId): int
    {
        $sql = "SELECT COUNT(*) FROM jurusan WHERE id_fakultas = :fakultasId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':fakultasId', $fakultasId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function save(JurusanEntity $fakultas): JurusanEntity
    {
        $statement = $this->connection->prepare("INSERT INTO jurusan(nama_jurusan, akreditasi, jenjang, id_fakultas) VALUES (?,?,?,?)");
        $statement->execute([$fakultas->nama, $fakultas->akreditasi, $fakultas->jenjang, $fakultas->idFakultas]);
        return $fakultas;
    }

    public function update(JurusanEntity $fakultas): JurusanEntity
    {
        $statement = $this->connection->prepare("UPDATE jurusan SET nama_jurusan = ?, akreditasi = ?, jenjang = ?, id_fakultas = ? WHERE id_jurusan = ?");
        $statement->execute([$fakultas->nama, $fakultas->akreditasi, $fakultas->jenjang, $fakultas->idFakultas, $fakultas->id]);
        return $fakultas;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM jurusan");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $jurusan = new JurusanEntity();
            $jurusan->id = $row['id_jurusan'];
            $jurusan->nama = $row['nama_jurusan'];
            $jurusan->akreditasi = $row['akreditasi'];
            $jurusan->jenjang = $row['jenjang'];
            $jurusan->idFakultas = $row['id_fakultas'];
            return $jurusan;
        }, $result);
    }

    public function findById(int $id): ? JurusanEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM jurusan WHERE id_jurusan = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $jurusan = new JurusanEntity();
                $jurusan->id = $row['id_jurusan'];
                $jurusan->nama = $row['nama_jurusan'];
                $jurusan->akreditasi = $row['akreditasi'];
                $jurusan->jenjang = $row['jenjang'];
                $jurusan->idFakultas = $row['id_fakultas'];
                return $jurusan;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM jurusan WHERE id_jurusan = ?");
        $statement->execute([$id]);
    }
}