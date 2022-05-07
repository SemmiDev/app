<?php

namespace Modules\Dosen\Service;

use Config\Database;
use Modules\Dosen\Entity\DosenEntity;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Exception\ValidationException;

class DosenService
{
    private DosenRepository $dosenRepository;

    public function __construct(DosenRepository $dosenRepository)
    {
        $this->dosenRepository = $dosenRepository;
    }

    public function create(DosenEntity $req): DosenEntity
    {
        try {
            Database::beginTransaction();

            $dosen = new DosenEntity();
            $dosen->nip = $req->nip;
            $dosen->namaDepan = $req->namaDepan;
            $dosen->namaBelakang = $req->namaBelakang;
            $dosen->golonganPNS = $req->golonganPNS;
            $dosen->status = $req->status;
            $dosen->email = $req->email;
            $dosen->jenisKelamin = $req->jenisKelamin;
            $dosen->noTelp = $req->noTelp;
            $dosen->noHP = $req->noHP;
            $dosen->alamat = $req->alamat;

            $this->dosenRepository->save($dosen);
            
            Database::commitTransaction();
            return $dosen;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(DosenEntity $req): DosenEntity
    {
        try {
            Database::beginTransaction();
            $this->dosenRepository->update($req);
            
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
            $user = $this->dosenRepository->findById($id);
            if ($user == null) {
                throw new ValidationException("id Dosen tidak ada");
            }

            $this->dosenRepository->delete($id);
            
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        return $this->dosenRepository->findAll();
    }

    public function findById(int $id): ? DosenEntity
    {
        try {
            Database::beginTransaction();
            $dos = $this->dosenRepository->findById($id);
            if ($dos == null) {
                throw new ValidationException("id dosen tidak ada");
            }

            $dosen = new DosenEntity();
            $dosen->id = $dos->id;
            $dosen->nip = $dos->nip;
            $dosen->namaDepan = $dos->namaDepan;
            $dosen->namaBelakang = $dos->namaBelakang;
            $dosen->golonganPNS = $dos->golonganPNS;
            $dosen->status = $dos->status;
            $dosen->email = $dos->email;
            $dosen->jenisKelamin = $dos->jenisKelamin;
            $dosen->noTelp = $dos->noTelp;
            $dosen->noHP = $dos->noHP;
            $dosen->alamat = $dos->alamat;

            Database::commitTransaction();
            return $dosen;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findByEmail($email): ? DosenEntity
    {
        try {
            Database::beginTransaction();
            $dos = $this->dosenRepository->findByEmail($email);
            if ($dos == null) {
                throw new ValidationException("id dosen tidak ada");
            }

            $dosen = new DosenEntity();
            $dosen->id = $dos->id;
            $dosen->nip = $dos->nip;
            $dosen->namaDepan = $dos->namaDepan;
            $dosen->namaBelakang = $dos->namaBelakang;
            $dosen->golonganPNS = $dos->golonganPNS;
            $dosen->status = $dos->status;
            $dosen->email = $dos->email;
            $dosen->jenisKelamin = $dos->jenisKelamin;
            $dosen->noTelp = $dos->noTelp;
            $dosen->noHP = $dos->noHP;
            $dosen->alamat = $dos->alamat;

            Database::commitTransaction();
            return $dosen;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}