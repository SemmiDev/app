<?php

namespace Modules\Mengajar\Entity;

class MengajarEntity {
    public $id;
    public $idDosen;
    public $idMataKuliah;
    public $hari;
    public $jamMulai;
    public $jamSelesai;
}

class MengajarEntityDetails {
    public $id;
    public $idDosen;
    public $idMataKuliah;
    public $hari;
    public $jamMulai;
    public $jamSelesai;
    
    public $dosen;
    public $mataKuliah;

    public function __construct(MengajarEntity $mengajar, $dosen, $mataKuliah) {
        if (is_null($dosen)) {
            $this->idDosen = null;
            $this->dosen = null;
        } else {
            $this->idDosen = $dosen->id;
            $this->dosen = $dosen;
        }

        if (is_null($mataKuliah)) {
            $this->idMataKuliah = null;
            $this->mataKuliah = null;
        } else {
            $this->idMataKuliah = $mataKuliah->id;
            $this->mataKuliah = $mataKuliah;
        }

        $this->id = $mengajar->id;
        $this->hari = $mengajar->hari;
        $this->jamMulai = $mengajar->jamMulai;
        $this->jamSelesai = $mengajar->jamSelesai;
    }
}