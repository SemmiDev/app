<?php

namespace Modules\MataKuliah\Repository;

use Modules\MataKuliah\Entity\MataKuliahEntity;

class MataKuliahRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function totalMahasiswaInMataKuliahId($id)
    {
        $statement = $this->connection->prepare("SELECT COUNT(*) FROM enroll_matakuliah WHERE id_matakuliah = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function findDosenPengajar($idMatkul)
    {
        $statement = $this->connection->prepare("SELECT id_dosen FROM mengajar WHERE id_matakuliah = :idMatkul");
        $statement->bindParam(":idMatkul", $idMatkul);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function save(MataKuliahEntity $matkul): MataKuliahEntity
    {
        $statement = $this->connection->prepare("INSERT INTO matakuliah(nama, kode, sks, semester, id_dosen_pengampu, id_jurusan) VALUES (?,?,?,?,?,?)");
        $statement->execute([$matkul->nama, $matkul->kode, $matkul->sks, $matkul->semester, $matkul->idDosenPengampu, $matkul->idJurusan]);
        return $matkul;
    }

    public function update(MataKuliahEntity $matkul): MataKuliahEntity
    {
        $statement = $this->connection->prepare("UPDATE matakuliah SET nama = ?, kode = ?, sks = ?, semester = ?, id_dosen_pengampu = ?, id_jurusan = ? WHERE id_matakuliah = ?");
        $statement->execute([$matkul->nama, $matkul->kode, $matkul->sks, $matkul->semester, $matkul->idDosenPengampu, $matkul->idJurusan, $matkul->id]);
        return $matkul;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM matakuliah");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $matkul = new MataKuliahEntity();
            $matkul->id = $row['id_matakuliah'];
            $matkul->nama = $row['nama'];
            $matkul->kode = $row['kode'];
            $matkul->sks = $row['sks'];
            $matkul->semester = $row['semester'];
            $matkul->idDosenPengampu = $row['id_dosen_pengampu'];
            $matkul->idJurusan = $row['id_jurusan'];
            return $matkul;
        }, $result);
    }

    public function findById($id): ? MataKuliahEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM matakuliah WHERE id_matakuliah = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $matkul = new MataKuliahEntity();
                $matkul->id = $row['id_matakuliah'];
                $matkul->nama = $row['nama'];
                $matkul->kode = $row['kode'];
                $matkul->sks = $row['sks'];
                $matkul->semester = $row['semester'];
                $matkul->idDosenPengampu = $row['id_dosen_pengampu'];
                $matkul->idJurusan = $row['id_jurusan'];
                return $matkul;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM matakuliah WHERE id_matakuliah = ?");
        $statement->execute([$id]);
    }
}