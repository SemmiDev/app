<?php

namespace Modules\Jurusan\Entity;

use Modules\Fakultas\Entity\FakultasEntity;

class JurusanEntity {
    public int $id;
    public string $nama;
    public string $akreditasi;
    public string $jenjang;
    public int $idFakultas;
}

class JurusanEntityDetails {
    public int $id;
    public string $nama;
    public string $akreditasi;
    public string $jenjang;
    public FakultasEntity $fakultas;

    public function __construct(JurusanEntity $jurusan, FakultasEntity $fakultas) {
        $this->id = $jurusan->id;
        $this->nama = $jurusan->nama;
        $this->akreditasi = $jurusan->akreditasi;
        $this->jenjang = $jurusan->jenjang;
        $this->fakultas = $fakultas;
    }
}