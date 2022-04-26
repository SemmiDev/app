<?php

namespace Modules\Mengajar\Repository;

use Modules\Mengajar\Entity\MengajarEntity;

class MengajarRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(MengajarEntity $mengajar): MengajarEntity
    {
        $statement = $this->connection->prepare("INSERT INTO mengajar(id_dosen, id_matakuliah, hari, jam_mulai, jam_selesai) VALUES (?,?,?,?,?)");
        $statement->execute([$mengajar->idDosen, $mengajar->idMataKuliah, $mengajar->hari, $mengajar->jamMulai, $mengajar->jamSelesai]);
        return $mengajar;   
    }

    public function update(MengajarEntity $mengajar): MengajarEntity
    {
        $statement = $this->connection->prepare("UPDATE mengajar SET id_dosen = ?, id_matakuliah = ?, hari = ?, jam_mulai = ?, jam_selesai = ? WHERE id_mengajar = ?");
        $statement->execute([$mengajar->idDosen, $mengajar->idMataKuliah, $mengajar->hari, $mengajar->jamMulai, $mengajar->jamSelesai, $mengajar->id]);
        return $mengajar;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM mengajar");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $mengajar = new MengajarEntity();
            $mengajar->id = $row['id_mengajar'];
            $mengajar->idDosen = $row['id_dosen'];
            $mengajar->idMataKuliah = $row['id_matakuliah'];
            $mengajar->hari = $row['hari'];
            $mengajar->jamMulai = $row['jam_mulai'];
            $mengajar->jamSelesai = $row['jam_selesai'];
            return $mengajar;
        }, $result);
    }

    public function findById($id): ? MengajarEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM mengajar WHERE id_mengajar = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $mengajar = new MengajarEntity();
                $mengajar->id = $row['id_mengajar'];
                $mengajar->idDosen = $row['id_dosen'];
                $mengajar->idMataKuliah = $row['id_matakuliah'];
                $mengajar->hari = $row['hari'];
                $mengajar->jamMulai = $row['jam_mulai'];
                $mengajar->jamSelesai = $row['jam_selesai'];
                return $mengajar;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM mengajar WHERE id_mengajar = ?");
        $statement->execute([$id]);
    }
}