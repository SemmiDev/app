<?php

namespace Modules\Jurusan\Entity;

class JurusanEntity {
    public $id;
    public $nama;
    public $akreditasi;
    public $jenjang;
    public $idFakultas;
}

class JurusanEntityDetails {
    public $id;
    public $nama;
    public $akreditasi;
    public $jenjang;
    public $fakultas;

    public function __construct(JurusanEntity $jurusan, $fakultas) {
        if (is_null($fakultas)) {
            $this->fakultas = null;
        } else {
            $this->fakultas = $fakultas;
        }

        $this->id = $jurusan->id;
        $this->nama = $jurusan->nama;
        $this->akreditasi = $jurusan->akreditasi;
        $this->jenjang = $jurusan->jenjang;
    }
}