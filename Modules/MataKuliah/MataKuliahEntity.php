<?php

namespace Modules\MataKuliah\Entity;

class MataKuliahEntity {
    public $id;
    public $nama;
    public $kode;
    public $sks;
    public $semester;
    public $idDosenPengampu;
    public $idJurusan;
}

class MataKuliahEntityDetails {
    public $id;
    public $nama;
    public $kode;
    public $sks;
    public $semester;

    public $idDosenPengampu;
    public $idJurusan;

    public $dosenPengampu;
    public $jurusan;

    public function __construct(MataKuliahEntity $mataKuliah, $dosenPengampu, $jurusan) {
        if (is_null($dosenPengampu)) {
            $this->dosenPengampu = null;
        } else {
            $this->idDosenPengampu = $dosenPengampu->id;
            $this->dosenPengampu = $dosenPengampu;
        }

        if (is_null($jurusan)) {
            $this->jurusan = null;
        } else {
            $this->idJurusan = $jurusan->id;
            $this->jurusan = $jurusan;
        }

        $this->id = $mataKuliah->id;
        $this->nama = $mataKuliah->nama;
        $this->kode = $mataKuliah->kode;
        $this->sks = $mataKuliah->sks;
        $this->semester = $mataKuliah->semester;
    }
}