<?php

namespace Modules\Mahasiswa\Entity;

use Modules\Dosen\Entity\DosenEntity;
use Modules\Jurusan\Entity\JurusanEntity;

class MahasiswaEntity {
    public int $id;
    public string $nim;
    public string $namaDepan;
    public string $namaBelakang;
    public string $email;
    public string $jenisKelamin;
    public string $agama;
    public string $jenjang;
    public string $tanggalLahir;
    public string $noHP;
    public string $alamat;

    public string $status = "aktif";
    public int $totalSKS = 0;
    public int $semester = 1;
    public int $idJurusan;
    public int $idDosenPA;
}

class MahasiswaEntityDetails {
    public int $id;
    public string $nim;
    public string $namaDepan;
    public string $namaBelakang;
    public string $email;
    public string $jenisKelamin;
    public string $agama;
    public string $jenjang;
    public string $tanggalLahir;
    public string $noHP;
    public string $alamat;
    public string $status;
    public int $totalSKS;
    public int $semester;
    
    public int $idJurusan;
    public int $idDosenPA;
    
    public JurusanEntity $jurusan;
    public DosenEntity $dosenPA;

    public function __construct(MahasiswaEntity $mahasiswa, JurusanEntity $jurusan, DosenEntity $dosenPA) {
        $this->nim = $mahasiswa->nim;
        $this->namaDepan = $mahasiswa->namaDepan;
        $this->namaBelakang = $mahasiswa->namaBelakang;
        $this->email = $mahasiswa->email;
        $this->jenisKelamin = $mahasiswa->jenisKelamin;
        $this->agama = $mahasiswa->agama;
        $this->jenjang = $mahasiswa->jenjang;
        $this->tanggalLahir = $mahasiswa->tanggalLahir;
        $this->noHP = $mahasiswa->noHP;
        $this->alamat = $mahasiswa->alamat;
        $this->status = $mahasiswa->status;
        $this->totalSKS = $mahasiswa->totalSKS;
        $this->semester = $mahasiswa->semester;
    
        $this->idJurusan = $mahasiswa->idJurusan;
        $this->idDosenPA = $mahasiswa->idDosenPA;
        
        $this->jurusan = $jurusan;
        $this->dosenPA = $dosenPA;
    }
}