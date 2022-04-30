<?php

namespace Modules\Jurusan\Repository;

use Modules\Jurusan\Entity\JurusanEntity;

class JurusanRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function totalMahasiswaInJurusanId(int $id): int
    {
        $sql = "SELECT COUNT(*) FROM mahasiswa WHERE id_jurusan = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function totalJurusanInFakultas(int $jurusanId): int
    {
        $sql = "SELECT COUNT(*) FROM jurusan WHERE id_fakultas = :fakultasId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':fakultasId', $jurusanId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function save(JurusanEntity $jurusan): JurusanEntity
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM jurusan");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        $count += 1;
        
        $statement = $this->connection->prepare("INSERT INTO jurusan(nama_jurusan, id_kajur, akreditasi, jenjang, id_fakultas, kode) VALUES (?,?,?,?,?,?)");
        $statement->execute([$jurusan->nama, $jurusan->idKajur, $jurusan->akreditasi, $jurusan->jenjang, $jurusan->idFakultas, $count]);
        return $jurusan;
    }

    public function update(JurusanEntity $jurusan): JurusanEntity
    {
        $statement = $this->connection->prepare("UPDATE jurusan SET nama_jurusan = ?, id_kajur = ?, akreditasi = ?, jenjang = ?, id_fakultas = ? WHERE id_jurusan = ?");
        $statement->execute([$jurusan->nama, $jurusan->idKajur, $jurusan->akreditasi, $jurusan->jenjang, $jurusan->idFakultas, $jurusan->id]);
        return $jurusan;
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
            $jurusan->idKajur = $row['id_kajur'];
            $jurusan->akreditasi = $row['akreditasi'];
            $jurusan->jenjang = $row['jenjang'];
            $jurusan->idFakultas = $row['id_fakultas'];
            $jurusan->kode = $row['kode'];
            return $jurusan;
        }, $result);
    }

    public function findById($id): ? JurusanEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM jurusan WHERE id_jurusan = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $jurusan = new JurusanEntity();
                $jurusan->id = $row['id_jurusan'];
                $jurusan->nama = $row['nama_jurusan'];
                $jurusan->idKajur = $row['id_kajur'];
                $jurusan->akreditasi = $row['akreditasi'];
                $jurusan->jenjang = $row['jenjang'];
                $jurusan->idFakultas = $row['id_fakultas'];
                $jurusan->kode = $row['kode'];
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