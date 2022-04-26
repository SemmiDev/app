<?php

namespace Modules\Fakultas\Entity;

class FakultasEntity {
    public $id;
    public $nama;
    
    public $idDekan;
    public $idWakilDekan1;
    public $idWakilDekan2;
    public $idWakilDekan3;
}

class FakultasEntityDetails {
    public $id;
    public $nama;
    
    public $idDekan;
    public $idWakilDekan1;
    public $idWakilDekan2;
    public $idWakilDekan3;

    public $dekan;
    public $wakilDekan1;
    public $wakilDekan2;
    public $wakilDekan3;


    public function __construct(FakultasEntity $fakultas, $dekan, $wakilDekan1, $wakilDekan2, $wakilDekan3) {
        if (is_null($dekan)) {
            $this->idDekan = null;
            $this->dekan = null;
        } else {
            $this->idDekan = $dekan->id;
            $this->dekan = $dekan;
        }

        if (is_null($wakilDekan1)) {
            $this->idWakilDekan1 = null;
            $this->wakilDekan1 = null;
        } else {
            $this->idWakilDekan1 = $wakilDekan1->id;
            $this->wakilDekan1 = $wakilDekan1;
        }

        if (is_null($wakilDekan2)) {
            $this->idWakilDekan2 = null;
            $this->wakilDekan2 = null;
        } else {
            $this->idWakilDekan2 = $wakilDekan2->id;
            $this->wakilDekan2 = $wakilDekan2;
        }

        if (is_null($wakilDekan3)) {
            $this->idWakilDekan3 = null;
            $this->wakilDekan3 = null;
        } else {
            $this->idWakilDekan3 = $wakilDekan3->id;
            $this->wakilDekan3 = $wakilDekan3;
        }

        $this->id = $fakultas->id;
        $this->nama = $fakultas->nama;
    }
}