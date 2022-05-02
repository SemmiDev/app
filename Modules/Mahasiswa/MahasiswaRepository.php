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
        $statement = $this->connection->prepare("INSERT INTO mahasiswa(nim, nama_depan, nama_belakang, email, jenis_kelamin, agama, jenjang, tanggal_lahir, no_hp, status, total_sks, semester, alamat, id_jurusan, id_dosen_pa, angkatan, jalur_masuk) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
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
                $mhs->idDosenPA,
                $mhs->angkatan,
                $mhs->jalurMasuk,
            ]);

        $statement = $this->connection->prepare("INSERT INTO users(email, password, id_role) VALUES (?,?,?)");
        $statement->execute([$mhs->email, password_hash('12345678', PASSWORD_BCRYPT), 1]);
        return $mhs;
    }

    public function update(MahasiswaEntity $mhs): MahasiswaEntity
    {
        $statement = $this->connection->prepare("UPDATE mahasiswa SET nama_depan = ?, nama_belakang = ?, jenis_kelamin = ?, agama = ?, jenjang = ?, tanggal_lahir = ?, no_hp = ?, status = ?, total_sks = ?, semester = ?, alamat = ?, id_jurusan = ?, id_dosen_pa = ?, angkatan = ?, jalur_masuk = ? WHERE id_mahasiswa = ?");
        $statement->execute([
            $mhs->namaDepan,
            $mhs->namaBelakang,
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
            $mhs->idDosenPA,
            $mhs->angkatan,
            $mhs->jalurMasuk,
            $mhs->id,
        ]);
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
            $mhs->angkatan = $row['angkatan'];
            $mhs->jalurMasuk = $row['jalur_masuk'];
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
                $mhs->angkatan = $row['angkatan'];
                $mhs->jalurMasuk = $row['jalur_masuk'];
                return $mhs;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByEmail($email): ? MahasiswaEntity
    {
        $statement = $this->connection->prepare("SELECT * FROM mahasiswa WHERE email = ?");
        $statement->execute([$email]);

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
                $mhs->angkatan = $row['angkatan'];
                $mhs->jalurMasuk = $row['jalur_masuk'];
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