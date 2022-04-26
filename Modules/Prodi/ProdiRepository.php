<?php

namespace Modules\Prodi\Repository;

use Modules\Prodi\Entity\ProdiEntity;

class ProdiRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function prodiInJurusan($id) {
        $sql = "SELECT * FROM prodi WHERE id_jurusan = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function save(ProdiEntity $prodi): ProdiEntity
    {
        $statement = $this->connection->prepare("INSERT INTO prodi(nama_prodi, id_kaprodi, akreditasi, id_jurusan) VALUES (?,?,?,?)");
        $statement->execute(
            [
                $prodi->nama,
                $prodi->idKaprodi,
                $prodi->akreditasi,
                $prodi->idJurusan,
            ]);
        return $prodi;
    }

    public function update(ProdiEntity $prodi): ProdiEntity
    {
        $statement = $this->connection->prepare("UPDATE prodi SET nama_prodi = ? , id_kaprodi = ?, akreditasi = ?, id_jurusan = ? WHERE id_prodi = ?");
        $statement->execute([
            $prodi->nama,
            $prodi->idKaprodi,
            $prodi->akreditasi,
            $prodi->idJurusan,
            $prodi->id,
        ]);
        return $prodi;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM prodi");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $prodi = new ProdiEntity();
            $prodi->id = $row['id_prodi'];
            $prodi->nama = $row['nama_prodi'];
            $prodi->idKaprodi = $row['id_kaprodi'];
            $prodi->akreditasi = $row['akreditasi'];
            $prodi->idJurusan = $row['id_jurusan'];
            return $prodi;
        }, $result);
    }

    public function findById($id): ? ProdiEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM prodi WHERE id_prodi = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $prodi = new ProdiEntity();
                $prodi->id = $row['id_prodi'];
                $prodi->nama = $row['nama_prodi'];
                $prodi->idKaprodi = $row['id_kaprodi'];
                $prodi->akreditasi = $row['akreditasi'];
                $prodi->idJurusan = $row['id_jurusan'];
                return $prodi;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM prodi WHERE id_prodi = ?");
        $statement->execute([$id]);
    }
}