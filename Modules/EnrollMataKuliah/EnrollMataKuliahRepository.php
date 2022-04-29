<?php

namespace Modules\EnrollMataKuliah\Repository;

use Modules\EnrollMataKuliah\Entity\EnrollMataKuliahEntity;

class EnrollMataKuliahRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(EnrollMataKuliahEntity $enroll): EnrollMataKuliahEntity
    {

        $statement = $this->connection->prepare("INSERT INTO enroll_matakuliah(id_mahasiswa,id_matakuliah,semester,nilai) VALUES (?,?,?,?)");
        $statement->execute([
            $enroll->idMahasiswa,
            $enroll->idMataKuliah,
            $enroll->semester,
            $enroll->nilai,
        ]);
        return $enroll;
    }

    public function update(EnrollMataKuliahEntity $enroll): EnrollMataKuliahEntity
    {
        $statement = $this->connection->prepare("UPDATE enroll_matakuliah SET id_mahasiswa = ?, id_matakuliah = ?, semester = ?, nilai = ? WHERE id_enroll_matakuliah = ?");
        $statement->execute([
            $enroll->idMahasiswa,
            $enroll->idMataKuliah,
            $enroll->semester,
            $enroll->nilai,
            $enroll->id,
        ]);
        return $enroll;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM enroll_matakuliah");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $enroll = new EnrollMataKuliahEntity();
            $enroll->id = $row['id_enroll_matakuliah'];
            $enroll->idMahasiswa = $row['id_mahasiswa'];
            $enroll->idMataKuliah = $row['id_matakuliah'];
            $enroll->semester = $row['semester'];
            $enroll->nilai = $row['nilai'];
            return $enroll;
        }, $result);
    }

    public function findById($id): ?EnrollMataKuliahEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM enroll_matakuliah WHERE id_enroll_matakuliah = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $enroll = new EnrollMataKuliahEntity();
                $enroll->id = $row['id_enroll_matakuliah'];
                $enroll->idMahasiswa = $row['id_mahasiswa'];
                $enroll->idMataKuliah = $row['id_matakuliah'];
                $enroll->semester = $row['semester'];
                $enroll->nilai = $row['nilai'];
                return $enroll;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM enroll_matakuliah WHERE id_enroll_matakuliah = ?");
        $statement->execute([$id]);
    }
}
