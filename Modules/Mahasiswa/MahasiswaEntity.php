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
    
    public $angkatan;
    public $jalurMasuk;

    public $status = "aktif";
    public $totalSKS = 0;
    public $semester = 1;

    public $idJurusan;
    public $idProdi;
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

    public $angkatan;
    public $jalurMasuk;
    
    public $idJurusan;
    public $idProdi;
    public $idDosenPA;

    public $jurusan;
    public $prodi;
    public $dosenPA;

    public function __construct(MahasiswaEntity $mahasiswa, $jurusan, $prodi, $dosenPA) {
        if (is_null($dosenPA)) {
            $this->idosenPA = null;
            $this->dosenPA = null;
        } else {
            $this->dosenPA = $dosenPA;
            $this->idDosenPA = $mahasiswa->idDosenPA;
        }

        if (is_null($jurusan)) {
            $this->idJurusan = null;
            $this->jurusan = null;
        } else {
            $this->idJurusan = $mahasiswa->idJurusan;
            $this->jurusan = $jurusan;
        } 

        if (is_null($prodi)) {
            $this->idProdi = null;
            $this->prodi = null;
        } else {
            $this->idProdi = $mahasiswa->idProdi;
            $this->prodi = $prodi;
        }

        $this->id = $mahasiswa->id;
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

        $this->angkatan = $mahasiswa->angkatan;
        $this->jalurMasuk = $mahasiswa->jalurMasuk;
    }
}