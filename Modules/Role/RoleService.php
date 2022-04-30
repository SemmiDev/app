<?php

use Modules\Role\Entity\RoleEntity;
use Modules\Role\Repository\RoleRepository;
use Modules\Exception\ValidationException;
use Config\Database;

class RoleService
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository) {
        $this->roleRepository = $roleRepository;
    }

    public function create(RoleEntity $req): RoleEntity
    {
        try {
            Database::beginTransaction();
            $this->roleRepository->save($req);
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
            $jurusan = $this->roleRepository->findById($id);
            if ($jurusan == null) {
                throw new ValidationException("id role tidak ada");
            }
            $this->roleRepository->delete($id);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        return $this->mahasiswaRepository->findAll();
    }

    public function findById(int $id): ?RoleEntity
    {
        try {
            Database::beginTransaction();
            $role = $this->roleRepository->findById($id);
            if ($role == null) {
                throw new ValidationException("id role tidak ada");
            }
            Database::commitTransaction();
            return $role;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}
