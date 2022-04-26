<?php

namespace Modules\Prodi\Entity;

class ProdiEntity {
    public $id;
    public $nama;
    public $idKaprodi;
    public $akreditasi;
    public $idJurusan;
}

class ProdiEntityDetails {
    public $id;
    public $nama;
    public $idKaprodi;
    public $akreditasi;
    public $idJurusan;

    public $kaprodi;
    public $jurusan;

    public function __construct(ProdiEntity $Prodi, $kaprodi, $jurusan) {
        if (is_null($kaprodi)) {
            $this->idKaprodi = null;
            $this->kaprodi = null;
        } else {
            $this->idKaprodi = $kaprodi->id;
            $this->kaprodi = $kaprodi;
        }

        if (is_null($jurusan)) {
            $this->idJurusan = null;
            $this->jurusan = null;
        } else {
            $this->idJurusan = $jurusan->id;
            $this->jurusan = $jurusan;
        } 

        $this->id = $Prodi->id;
        $this->nama = $Prodi->nama;
        $this->akreditasi = $Prodi->akreditasi;
    }
}