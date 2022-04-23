<?php

namespace Modules\Mahasiswa\Entity;

class MahasiswaEntity {
    public $id;
    public $nim;
    public $namaDepan;
    public $namaBelakang;
    public $email;
    public $jenisKelamin;
    public $agama;
    public $jenjang;
    public $tanggalLahir;
    public $noHP;
    public $alamat;

    public $status = "aktif";
    public $totalSKS = 0;
    public $semester = 1;

    public $idJurusan;
    public $idDosenPA;
}

class MahasiswaEntityDetails {
    public $id;
    public $nim;
    public $namaDepan;
    public $namaBelakang;
    public $email;
    public $jenisKelamin;
    public $agama;
    public $jenjang;
    public $tanggalLahir;
    public $noHP;
    public $alamat;
    public $status;
    public $totalSKS;
    public $semester;
    
    public $idJurusan;
    public $idDosenPA;
    
    public $jurusan;
    public $dosenPA;

    public function __construct(MahasiswaEntity $mahasiswa, $jurusan, $dosenPA) {
        if (is_null($dosenPA)) {
            $this->dosenPA = null;
            $this->idosenPA = null;
        } else {
            $this->dosenPA = $dosenPA;
            $this->idDosenPA = $mahasiswa->idDosenPA;
        }

        if (is_null($jurusan)) {
            $this->jurusan = null;
            $this->idJurusan = null;
        } else {
            $this->idJurusan = $mahasiswa->idJurusan;
            $this->jurusan = $jurusan;
        } 

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
    }
}