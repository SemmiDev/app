<?php

namespace Modules\Jurusan\Service;

use Modules\Jurusan\Entity\JurusanEntity;
use Modules\Jurusan\Repository\JurusanRepository;
use Modules\Exception\ValidationException;
use Config\Database;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Fakultas\Repository\FakultasRepository;
use Modules\Jurusan\Entity\JurusanEntityDetails;

class JurusanService
{
    private JurusanRepository  $jurusanRepository;
    private FakultasRepository $fakultasRepository;
    private DosenRepository    $dosenRepository;

    public function __construct(
        JurusanRepository $jurusanRepository, 
        FakultasRepository $fakultasRepository,
        DosenRepository $dosenRepository)
    {
        $this->jurusanRepository = $jurusanRepository;
        $this->fakultasRepository = $fakultasRepository;
        $this->dosenRepository = $dosenRepository;
    }

    public function totalMahasiswaInJurusanId(int $id) {
        return $this->jurusanRepository->totalMahasiswaInJurusanId($id);
    }

    public function totalJurusanInFakultasId(int $id): int
    {
        return $this->jurusanRepository->totalJurusanInFakultas($id);
    }

    public function create(JurusanEntity $req): JurusanEntity
    {
        try {
            Database::beginTransaction();
            
            $this->jurusanRepository->save($req);
            
            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(JurusanEntity $req): JurusanEntity
    {
        try {
            Database::beginTransaction();

            $jurusan = new JurusanEntity();
            $jurusan->id = $req->id;
            $jurusan->nama = $req->nama;
            $jurusan->idKajur = $req->idKajur;
            $jurusan->akreditasi = $req->akreditasi;
            $jurusan->jenjang = $req->jenjang;
            $jurusan->idFakultas = $req->idFakultas;
            
            $this->jurusanRepository->update($jurusan);
            
            Database::commitTransaction();
            return $jurusan;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function delete(int $id): void
    {
        try {
            Database::beginTransaction();
            $jurusan = $this->jurusanRepository->findById($id);
            if ($jurusan == null) {
                throw new ValidationException("id jurusan tidak ada");
            }

            $this->jurusanRepository->delete($id);
            
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        $jurusan = $this->jurusanRepository->findAll();
        $jurusanDetails = [];
        foreach ($jurusan as $jurusan) {
            $jurusanDetails[] = new JurusanEntityDetails(
                $jurusan, 
                $this->dosenRepository->findById($jurusan->idKajur),
                $this->fakultasRepository->findById($jurusan->idFakultas));
        }
        return $jurusanDetails;
    }

    public function findById($id): ? JurusanEntityDetails
    {
        try {
            Database::beginTransaction();
            $jurusan = $this->jurusanRepository->findById($id);
            if ($jurusan == null) {
                throw new ValidationException("id Jurusan tidak ada");
            }

            $jurusanDetails = new JurusanEntityDetails(
                $jurusan, 
                $this->dosenRepository->findById($jurusan->idKajur),
                $this->fakultasRepository->findById($jurusan->idFakultas));
            
            Database::commitTransaction();
            return $jurusanDetails;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}