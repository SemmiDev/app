<?php

namespace Modules\Jurusan\Entity;

class JurusanEntity {
    public $id;
    public $nama;
    public $idKajur;
    public $akreditasi;
    public $jenjang;
    public $idFakultas;
}

class JurusanEntityDetails {
    public $id;
    public $nama;
    public $id_kajur;
    public $idKajur;
    public $kajur;
    public $akreditasi;
    public $jenjang;
    public $fakultas;

    public function __construct(JurusanEntity $jurusan, $dosen, $fakultas) {
        if (is_null($fakultas)) {
            $this->fakultas = null;
        } else {
            $this->fakultas = $fakultas;
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
        $this->akreditasi = $jurusan->akreditasi;
        $this->jenjang = $jurusan->jenjang;
    }
}