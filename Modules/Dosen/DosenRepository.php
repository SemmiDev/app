<?php

namespace Modules\Dosen\Repository;

use Modules\Dosen\Entity\DosenEntity;

class DosenRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(DosenEntity $dosen): DosenEntity
    {
        $statement = $this->connection->prepare("INSERT INTO dosen(nip,nama_depan,nama_belakang,email,jenis_kelamin, no_telp, no_hp, golongan_pns, status, alamat) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $statement->execute([
                $dosen->nip,
                $dosen->namaDepan,
                $dosen->namaBelakang,
                $dosen->email,
                $dosen->jenisKelamin,
                $dosen->noTelp,
                $dosen->noHP,
                $dosen->golonganPNS,
                $dosen->status,
                $dosen->alamat,
            ]);

        $statement = $this->connection->prepare("INSERT INTO users(email, password, id_role) VALUES (?,?,?)");
        // default password for new dosen
        $statement->execute([$dosen->email, password_hash('12345678', PASSWORD_BCRYPT), 2]);
        return $dosen;
    }

    public function update(DosenEntity $dosen): DosenEntity
    {
        $statement = $this->connection->prepare("UPDATE dosen SET nip = ? , nama_depan = ?, nama_belakang = ?, email = ?, jenis_kelamin = ?, no_telp = ?, no_hp = ?, golongan_pns = ?, status = ?, alamat = ? WHERE id_dosen = ?");
        $statement->execute([
        $dosen->nip,
        $dosen->namaDepan,
        $dosen->namaBelakang,
        $dosen->email,
        $dosen->jenisKelamin,
        $dosen->noTelp,
        $dosen->noHP,
        $dosen->golonganPNS,
        $dosen->status,
        $dosen->alamat,
        $dosen->id]);
        return $dosen;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM dosen");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $dosen = new DosenEntity();
            $dosen->id = $row['id_dosen'];
            $dosen->nip = $row['nip'];
            $dosen->namaDepan = $row['nama_depan'];
            $dosen->namaBelakang = $row['nama_belakang'];
            $dosen->email = $row['email'];
            $dosen->jenisKelamin = $row['jenis_kelamin'];
            $dosen->noTelp = $row['no_telp'];
            $dosen->noHP = $row['no_hp'];
            $dosen->golonganPNS = $row['golongan_pns'];
            $dosen->status = $row['status'];
            $dosen->alamat = $row['alamat'];
            return $dosen;
        }, $result);
    }

    public function findById($id): ? DosenEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM dosen WHERE id_dosen = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $dosen = new DosenEntity();
                $dosen->id = $row['id_dosen'];
                $dosen->nip = $row['nip'];
                $dosen->namaDepan = $row['nama_depan'];
                $dosen->namaBelakang = $row['nama_belakang'];
                $dosen->email = $row['email'];
                $dosen->jenisKelamin = $row['jenis_kelamin'];
                $dosen->noTelp = $row['no_telp'];
                $dosen->noHP = $row['no_hp'];
                $dosen->golonganPNS = $row['golongan_pns'];
                $dosen->status = $row['status'];
                $dosen->alamat = $row['alamat'];
                return $dosen;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByEmail($email): ? DosenEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM dosen WHERE email = ?");
        $statement->execute([$email]);

        try {
            if ($row = $statement->fetch()) {
                $dosen = new DosenEntity();
                $dosen->id = $row['id_dosen'];
                $dosen->nip = $row['nip'];
                $dosen->namaDepan = $row['nama_depan'];
                $dosen->namaBelakang = $row['nama_belakang'];
                $dosen->email = $row['email'];
                $dosen->jenisKelamin = $row['jenis_kelamin'];
                $dosen->noTelp = $row['no_telp'];
                $dosen->noHP = $row['no_hp'];
                $dosen->golonganPNS = $row['golongan_pns'];
                $dosen->status = $row['status'];
                $dosen->alamat = $row['alamat'];
                return $dosen;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }


    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM dosen WHERE id_dosen = ?");
        $statement->execute([$id]);
    }
}