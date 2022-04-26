<?php

namespace Modules\Mahasiswa\Repository;

use Modules\Mahasiswa\Entity\MahasiswaEntity;

class MahasiswaRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function totalMahasiswaInJurusanId(int $jurusanId): int
    {
        $sql = "SELECT COUNT(*) FROM mahasiswa WHERE id_jurusan = :jurusanId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':jurusanId', $jurusanId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function totalMahasiswaInProdiId(int $prodiId): int
    {
        $sql = "SELECT COUNT(*) FROM mahasiswa WHERE id_prodi = :prodiId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':prodiId', $prodiId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function updateProdi($id, $prodiId) {
        $sql = "UPDATE mahasiswa SET id_prodi = :prodiId WHERE id_mahasiswa = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':prodiId', $prodiId);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function save(MahasiswaEntity $mhs): MahasiswaEntity
    {
        $statement = $this->connection->prepare("INSERT INTO mahasiswa(nim, nama_depan, nama_belakang, email, jenis_kelamin, agama, jenjang, tanggal_lahir, no_hp, status, total_sks, semester, alamat, id_jurusan, id_prodi, id_dosen_pa) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(
            [
                $mhs->nim,
                $mhs->namaDepan,
                $mhs->namaBelakang,
                $mhs->email,
                $mhs->jenisKelamin,
                $mhs->agama,
                $mhs->jenjang,
                $mhs->tanggalLahir,
                $mhs->noHP,
                $mhs->status,
                $mhs->totalSKS,
                $mhs->semester,
                $mhs->alamat,
                $mhs->idJurusan,   
                $mhs->idProdi,   
                $mhs->idDosenPA
            ]);
        return $mhs;
    }

    public function update(MahasiswaEntity $mhs): MahasiswaEntity
    {
        $statement = $this->connection->prepare("UPDATE mahasiswa SET nim = ? , nama_depan = ?, nama_belakang = ?, email = ?, jenis_kelamin = ?, agama = ?, jenjang = ?, tanggal_lahir = ?, no_hp = ?, status = ?, total_sks = ?, semester = ?, alamat = ?, id_jurusan = ?, id_prodi = ?, id_dosen_pa = ? WHERE id_mahasiswa = ?");
        $statement->execute([
            $mhs->nim,
            $mhs->namaDepan,
            $mhs->namaBelakang,
            $mhs->email,
            $mhs->jenisKelamin,
            $mhs->agama,
            $mhs->jenjang,
            $mhs->tanggalLahir,
            $mhs->noHP,
            $mhs->status,
            $mhs->totalSKS,
            $mhs->semester,
            $mhs->alamat,
            $mhs->idJurusan,
            $mhs->idProdi,
            $mhs->idDosenPA,
            $mhs->id]);
        return $mhs;
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM mahasiswa");
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function ($row) {
            $mhs = new MahasiswaEntity();
            $mhs->id = $row['id_mahasiswa'];
            $mhs->nim = $row['nim'];
            $mhs->namaDepan = $row['nama_depan'];
            $mhs->namaBelakang = $row['nama_belakang'];
            $mhs->email = $row['email'];
            $mhs->jenisKelamin = $row['jenis_kelamin'];
            $mhs->agama = $row['agama'];
            $mhs->jenjang = $row['jenjang'];
            $mhs->tanggalLahir = $row['tanggal_lahir'];
            $mhs->noHP = $row['no_hp'];
            $mhs->status = $row['status'];
            $mhs->totalSKS = $row['total_sks'];
            $mhs->semester = $row['semester'];
            $mhs->alamat = $row['alamat'];
            $mhs->idJurusan = $row['id_jurusan'];
            $mhs->idProdi = $row['id_prodi'];
            $mhs->idDosenPA = $row['id_dosen_pa'];
            return $mhs;
        }, $result);
    }

    public function findById(int $id): ? MahasiswaEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM mahasiswa WHERE id_mahasiswa = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $mhs = new MahasiswaEntity();
                $mhs->id = $row['id_mahasiswa'];
                $mhs->nim = $row['nim'];
                $mhs->namaDepan = $row['nama_depan'];
                $mhs->namaBelakang = $row['nama_belakang'];
                $mhs->email = $row['email'];
                $mhs->jenisKelamin = $row['jenis_kelamin'];
                $mhs->agama = $row['agama'];
                $mhs->jenjang = $row['jenjang'];
                $mhs->tanggalLahir = $row['tanggal_lahir'];
                $mhs->noHP = $row['no_hp'];
                $mhs->stat = $row['status'];
                $mhs->totalSKS = $row['total_sks'];
                $mhs->semester = $row['semester'];
                $mhs->alamat = $row['alamat'];
                $mhs->idJurusan = $row['id_jurusan'];
                $mhs->idProdi = $row['id_prodi'];
                $mhs->idDosenPA = $row['id_dosen_pa'];
                return $mhs;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function delete(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM mahasiswa WHERE id_mahasiswa = ?");
        $statement->execute([$id]);
    }
}