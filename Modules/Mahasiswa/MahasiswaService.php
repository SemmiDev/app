<?php

namespace Modules\Mahasiswa\Service;

use Modules\Mahasiswa\Entity\MahasiswaEntity;
use Modules\Mahasiswa\Repository\MahasiswaRepository;
use Modules\Exception\ValidationException;
use Config\Database;
use Modules\Fakultas\Repository\FakultasRepository;
use Modules\Mahasiswa\Entity\MahasiswaEntityDetails;

class MahasiswaService
{
    // private MahasiswaRepository $jurusanRepository;
    // private FakultasRepository $fakultasRepository;

    // public function __construct(JurusanRepository $jurusanRepository, FakultasRepository $fakultasRepository)
    // {
    //     $this->jurusanRepository = $jurusanRepository;
    //     $this->fakultasRepository = $fakultasRepository;
    // }

    // public function totalJurusan(int $id): int
    // {
    //     return $this->jurusanRepository->totalJurusanInFakultas($id);
    // }

    // public function create(JurusanEntity $req): JurusanEntity
    // {
    //     try {
    //         Database::beginTransaction();

    //         $jurusan = new JurusanEntity();
    //         $jurusan->nama = $req->nama;
    //         $jurusan->akreditasi = $req->akreditasi;
    //         $jurusan->jenjang = $req->jenjang;
    //         $jurusan->idFakultas = $req->idFakultas;
            
    //         $this->jurusanRepository->save($jurusan);
            
    //         Database::commitTransaction();
    //         return $jurusan;
    //     } catch (\Exception $exception) {
    //         Database::rollbackTransaction();
    //         throw $exception;
    //     }
    // }

    // public function update(JurusanEntity $req): JurusanEntity
    // {
    //     try {
    //         Database::beginTransaction();

    //         $jurusan = new JurusanEntity();
    //         $jurusan->id = $req->id;
    //         $jurusan->nama = $req->nama;
    //         $jurusan->akreditasi = $req->akreditasi;
    //         $jurusan->jenjang = $req->jenjang;
    //         $jurusan->idFakultas = $req->idFakultas;
            
    //         $this->jurusanRepository->update($jurusan);
            
    //         Database::commitTransaction();
    //         return $jurusan;
    //     } catch (\Exception $exception) {
    //         Database::rollbackTransaction();
    //         throw $exception;
    //     }
    // }

    // public function delete(int $id): void
    // {
    //     try {
    //         Database::beginTransaction();
    //         $jurusan = $this->jurusanRepository->findById($id);
    //         if ($jurusan == null) {
    //             throw new ValidationException("id jurusan tidak ada");
    //         }

    //         $this->jurusanRepository->delete($id);
            
    //         Database::commitTransaction();
    //     } catch (\Exception $exception) {
    //         Database::rollbackTransaction();
    //         throw $exception;
    //     }
    // }

    // public function findAll(): array
    // {
    //     $jurusan = $this->jurusanRepository->findAll();
    //     $jurusanDetails = [];
    //     foreach ($jurusan as $jurusan) {
    //         $jurusanDetails[] = new JurusanEntityDetails($jurusan, $this->fakultasRepository->findById($jurusan->idFakultas));
    //     }
    //     return $jurusanDetails;
    // }

    // public function findById(int $id): ? JurusanEntityDetails
    // {
    //     try {
    //         Database::beginTransaction();
    //         $jurusan = $this->jurusanRepository->findById($id);
    //         if ($jurusan == null) {
    //             throw new ValidationException("id Jurusan tidak ada");
    //         }

    //         $jurusanDetails = new JurusanEntityDetails($jurusan, $this->fakultasRepository->findById($jurusan->idFakultas));
            
    //         Database::commitTransaction();
    //         return $jurusanDetails;
    //     } catch (\Exception $exception) {
    //         Database::rollbackTransaction();
    //         throw $exception;
    //     }
    // }
}