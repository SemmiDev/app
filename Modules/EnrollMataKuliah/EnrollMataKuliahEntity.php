<?php

namespace Modules\EnrollMataKuliah\Entity;

class EnrollMataKuliahEntity {
    public $id;
    public $idMahasiswa;
    public $idMataKuliah;
    public $semester;
    public $nilai;
}

class EnrollMataKuliahEntityDetails {
    public $id;
    public $semester;
    public $nilai;

    public $idMahasiswa;
    public $mahasiswa;
    public $idMataKuliah;
    public $mataKuliah;

    public function __construct(EnrollMataKuliahEntity $enroll, $mahasiswa, $mataKuliah) {
        if (is_null($mahasiswa)) {
            $this->idMahasiswa = null;
            $this->mahasiswa = null;
        } else {
            $this->idMahasiswa = $mahasiswa->id;
            $this->mahasiswa = $mahasiswa;
        }
        
        if (is_null($mataKuliah)) {
            $this->idMataKuliah = null;
            $this->mataKuliah = null;
        } else {
            $this->idMataKuliah = $mataKuliah->id;
            $this->mataKuliah = $mataKuliah;
        }

        $this->id = $enroll->id;
        $this->semester = $enroll->semester;
        $this->nilai = $enroll->nilai;
    }
}

