<?php

namespace Modules\Fakultas\Service;

use Modules\Fakultas\Entity\FakultasEntity;
use Modules\Fakultas\Repository\FakultasRepository;
use Modules\Exception\ValidationException;
use Config\Database;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Fakultas\Entity\FakultasEntityDetails;
use Modules\Jurusan\Repository\JurusanRepository;

class FakultasService
{
    private FakultasRepository $fakultasRepository;
    private DosenRepository $dosenRepository;
    private JurusanRepository $jurusanRepository;

    public function __construct(
        FakultasRepository $fakultasRepository,
        DosenRepository $dosenRepository,
        JurusanRepository $jurusanRepository)
    {
        $this->fakultasRepository = $fakultasRepository;
        $this->dosenRepository = $dosenRepository;
        $this->jurusanRepository = $jurusanRepository;
    }

    public function create(FakultasEntity $req): FakultasEntity
    {
        try {
            Database::beginTransaction();

            $fakultas = new FakultasEntity();
            $fakultas->nama = $req->nama;

            $this->fakultasRepository->save($fakultas);
            
            Database::commitTransaction();
            return $fakultas;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(FakultasEntity $req): FakultasEntity
    {
        try {
            Database::beginTransaction();

            $fakultas = new FakultasEntity();
            $fakultas->id = $req->id;
            $fakultas->nama = $req->nama;

            $this->fakultasRepository->update($fakultas);
            
            Database::commitTransaction();
            return $fakultas;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function delete($id): void
    {
        try {
            Database::beginTransaction();
            $fak = $this->fakultasRepository->findById($id);
            if ($fak == null) {
                throw new ValidationException("id Fakultas tidak ada");
            }

            $this->fakultasRepository->delete($id);
            
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        $fakultas = $this->fakultasRepository->findAll();
        $fakultasDetails = [];
        foreach ($fakultas as $fak) {
            $detail = new FakultasEntityDetails($fak, 
            $this->dosenRepository->findById($fak->idDekan),
            $this->dosenRepository->findById($fak->idWakilDekan1),
            $this->dosenRepository->findById($fak->idWakilDekan2),
            $this->dosenRepository->findById($fak->idWakilDekan3));
            array_push($fakultasDetails, $detail);
        }
        return $fakultasDetails;
    }

    public function findById(int $id): ? FakultasEntityDetails
    {
        try {
            Database::beginTransaction();
            $fak = $this->fakultasRepository->findById($id);
            if ($fak == null) {
                throw new ValidationException("id Fakultas tidak ada");
            }

            $fakDetail = new FakultasEntityDetails($fak, 
            $this->dosenRepository->findById($fak->idDekan),
            $this->dosenRepository->findById($fak->idWakilDekan1),
            $this->dosenRepository->findById($fak->idWakilDekan2),
            $this->dosenRepository->findById($fak->idWakilDekan3));

            Database::commitTransaction();
            return $fakDetail;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}