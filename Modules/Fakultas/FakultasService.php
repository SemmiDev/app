<?php

namespace Modules\Fakultas\Service;

use Modules\Fakultas\Entity\FakultasEntity;
use Modules\Fakultas\Repository\FakultasRepository;
use Modules\Exception\ValidationException;
use Config\Database;
use Modules\Jurusan\Repository\JurusanRepository;

class FakultasService
{
    private FakultasRepository $fakultasRepository;
    private JurusanRepository $jurusanRepository;

    public function __construct(
        FakultasRepository $fakultasRepository,
        JurusanRepository $jurusanRepository)
    {
        $this->fakultasRepository = $fakultasRepository;
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

    public function delete(int $id): void
    {
        try {
            Database::beginTransaction();
            $user = $this->fakultasRepository->findById($id);
            if ($user == null) {
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
        return $this->fakultasRepository->findAll();
    }

    public function findById(int $id): ? FakultasEntity
    {
        try {
            Database::beginTransaction();
            $fak = $this->fakultasRepository->findById($id);
            if ($fak == null) {
                throw new ValidationException("id Fakultas tidak ada");
            }

            $fakultas = new FakultasEntity();
            $fakultas->id = $fak->id;
            $fakultas->nama = $fak->nama;

            Database::commitTransaction();
            return $fakultas;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}