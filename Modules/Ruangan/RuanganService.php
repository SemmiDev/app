<?php

namespace Modules\Ruangan\Service;

use Config\Database;
use Modules\Exception\ValidationException;
use Modules\Ruangan\Entity\RuanganEntity;
use Modules\Ruangan\Repository\RuanganRepository;

class RuanganService
{
    private RuanganRepository $ruanganRepository;

    public function __construct(
        RuanganRepository $ruanganRepository)
    {
        $this->ruanganRepository = $ruanganRepository;
    }

    public function create(RuanganEntity $req): RuanganEntity
    {
        try {
            Database::beginTransaction();
            $this->ruanganRepository->save($req);

            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(RuanganEntity $req): RuanganEntity
    {
        try {
            Database::beginTransaction();
            $this->ruanganRepository->update($req);
            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function delete(int $id): void
    {
        try {
            Database::beginTransaction();
            $user = $this->ruanganRepository->findById($id);
            if ($user == null) {
                throw new ValidationException("id Ruangan tidak ada");
            }
            $this->ruanganRepository->delete($id);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        return $this->ruanganRepository->findAll();
    }

    public function findById(int $id): ? RuanganEntity
    {
        try {
            Database::beginTransaction();
            $dosen = $this->ruanganRepository->findById($id);
            if ($dosen == null) {
                throw new ValidationException("id Ruangan tidak ada");
            }
            Database::commitTransaction();
            return $dosen;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}