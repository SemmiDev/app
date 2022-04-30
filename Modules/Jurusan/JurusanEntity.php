<?php

namespace Modules\Jurusan\Entity;

class JurusanEntity {
    public $id;
    public $nama;
    public $kode;
    public $idKajur;
    public $akreditasi;
    public $jenjang;
    public $idFakultas;
}

class JurusanEntityDetails {
    public $id;
    public $nama;
    public $kode;
    public $jenjang;
    public $akreditasi;
    
    public $idKajur;
    public $kajur;
    
    public $idFakultas;
    public $fakultas;

    public function __construct(JurusanEntity $jurusan, $dosen, $fakultas) {
        if (is_null($fakultas)) {
            $this->fakultas = null;
            $this->idFakultas = null;
        } else {
            $this->fakultas = $fakultas;
            $this->idFakultas = $fakultas->id;
        }

        if (is_null($dosen)) {
            $this->idKajur = null;
            $this->kajur = null;
        } else {
            $this->idKajur = $dosen->id;
            $this->kajur = $dosen;
        }

        $this->id = $jurusan->id;
        $this->nama = $jurusan->nama;
        $this->kode = $jurusan->kode;
        $this->akreditasi = $jurusan->akreditasi;
        $this->jenjang = $jurusan->jenjang;
    }
}