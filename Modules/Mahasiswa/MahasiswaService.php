<?php

namespace Modules\Mahasiswa\Service;

use Config\Database;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Exception\ValidationException;
use Modules\Jurusan\Repository\JurusanRepository;
use Modules\Mahasiswa\Entity\MahasiswaEntity;
use Modules\Mahasiswa\Entity\MahasiswaEntityDetails;
use Modules\Mahasiswa\Repository\MahasiswaRepository;
use Modules\Prodi\Repository\ProdiRepository;
use Modules\User\Entity\UserEntity;
use Modules\User\Service\UserService;

class MahasiswaService
{
    private MahasiswaRepository $mahasiswaRepository;
    private ProdiRepository $prodiRepository;
    private JurusanRepository $jurusanRepository;
    private DosenRepository $dosenRepository;
    
    private UserService $userService;

    public function __construct(
        MahasiswaRepository $mahasiswaRepository,
        ProdiRepository $prodiRepository,
        JurusanRepository $jurusanRepository,
        DosenRepository $dosenRepository,
        UserService $userService,
    ) {
        $this->mahasiswaRepository = $mahasiswaRepository;
        $this->prodiRepository = $prodiRepository;
        $this->jurusanRepository = $jurusanRepository;
        $this->dosenRepository = $dosenRepository;

        $this->userService = $userService;
    }

    public function totalMahasiswaInJurusanId(int $id) {
        return $this->mahasiswaRepository->totalMahasiswaInJurusanId($id);
    }

    public function totalMahasiswaInProdiId(int $id) {
        return $this->mahasiswaRepository->totalMahasiswaInProdiId($id);
    }

    public function listProdiInJurusan($prodiID) {
        return $this->prodiRepository->prodiInJurusan($prodiID);
    }

    public function create(MahasiswaEntity $req): MahasiswaEntity
    {
        try {
            Database::beginTransaction();
            $this->mahasiswaRepository->save($req);
            Database::commitTransaction();
            return $req;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function update(MahasiswaEntity $req): MahasiswaEntity
    {
        try {
            Database::beginTransaction();

            $this->mahasiswaRepository->update($req);
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
            $jurusan = $this->mahasiswaRepository->findById($id);
            if ($jurusan == null) {
                throw new ValidationException("id mahasiswa tidak ada");
            }

            $this->mahasiswaRepository->delete($id);

            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findAll(): array
    {
        $listMahasiswa = $this->mahasiswaRepository->findAll();
        $mahasiswaDetails = [];
        foreach ($listMahasiswa as $mhs) {
            $m = new MahasiswaEntityDetails(
                $mhs,
                $this->jurusanRepository->findById($mhs->idJurusan),
                $this->prodiRepository->findById($mhs->idProdi),
                $this->dosenRepository->findById($mhs->idDosenPA)
            );
            array_push($mahasiswaDetails, $m);
        }
        return $mahasiswaDetails;
    }

    public function updateProdi($id, $prodiID) {
        try {
            Database::beginTransaction();

            $this->mahasiswaRepository->updateProdi($id, $prodiID);
            Database::commitTransaction();
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findById(int $id): ?MahasiswaEntityDetails
    {
        try {
            Database::beginTransaction();
            $mhs = $this->mahasiswaRepository->findById($id);
            if ($mhs == null) {
                throw new ValidationException("id mahasiswa tidak ada");
            }

            $mhsDetails = new MahasiswaEntityDetails(
                $mhs,
                $this->prodiRepository->findById($mhs->idProdi),
                $this->jurusanRepository->findById($mhs->idJurusan),
                $this->dosenRepository->findById($mhs->idDosenPA)
            );

            Database::commitTransaction();
            return $mhsDetails;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function findByEmail($email): ?MahasiswaEntityDetails
    {
        try {
            Database::beginTransaction();
            $mhs = $this->mahasiswaRepository->findByEmail($email);
            if ($mhs == null) {
                throw new ValidationException("email mahasiswa tidak terdaftar");
            }

            $mhsDetails = new MahasiswaEntityDetails(
                $mhs,
                $this->prodiRepository->findById($mhs->idProdi),
                $this->jurusanRepository->findById($mhs->idJurusan),
                $this->dosenRepository->findById($mhs->idDosenPA)
            );

            Database::commitTransaction();
            return $mhsDetails;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}
