<?php

use Config\Database;
use Modules\Dosen\Repository\DosenRepository;
use Modules\Dosen\Service\DosenService;
use Modules\EnrollMataKuliah\Repository\EnrollMataKuliahRepository;
use Modules\EnrollMataKuliah\Service\EnrollMataKuliahService;

require_once __DIR__ . '/Config/Database.php';

require_once __DIR__ . '/Modules/Exception/ValidationException.php';
require_once __DIR__ . '/Modules/Fakultas/FakultasEntity.php';
require_once __DIR__ . '/Modules/Fakultas/FakultasRepository.php';
require_once __DIR__ . '/Modules/Fakultas/FakultasService.php';

require_once __DIR__ . '/Modules/Jurusan/JurusanEntity.php';
require_once __DIR__ . '/Modules/Jurusan/JurusanRepository.php';
require_once __DIR__ . '/Modules/Jurusan/JurusanService.php';

require_once __DIR__ . '/Modules/Dosen/DosenEntity.php';
require_once __DIR__ . '/Modules/Dosen/DosenRepository.php';
require_once __DIR__ . '/Modules/Dosen/DosenService.php';

require_once __DIR__ . '/Modules/Mahasiswa/MahasiswaEntity.php';
require_once __DIR__ . '/Modules/Mahasiswa/MahasiswaRepository.php';
require_once __DIR__ . '/Modules/Mahasiswa/MahasiswaService.php';

require_once __DIR__ . '/Modules/Ruangan/RuanganEntity.php';
require_once __DIR__ . '/Modules/Ruangan/RuanganRepository.php';
require_once __DIR__ . '/Modules/Ruangan/RuanganService.php';

require_once __DIR__ . '/Modules/MataKuliah/MataKuliahEntity.php';
require_once __DIR__ . '/Modules/MataKuliah/MataKuliahRepository.php';
require_once __DIR__ . '/Modules/MataKuliah/MataKuliahService.php';

require_once __DIR__ . '/Modules/Mengajar/MengajarEntity.php';
require_once __DIR__ . '/Modules/Mengajar/MengajarRepository.php';
require_once __DIR__ . '/Modules/Mengajar/MengajarService.php';

require_once __DIR__ . '/Modules/Prodi/ProdiEntity.php';
require_once __DIR__ . '/Modules/Prodi/ProdiRepository.php';
require_once __DIR__ . '/Modules/Prodi/ProdiService.php';

require_once __DIR__ . '/Modules/EnrollMataKuliah/EnrollMataKuliahEntity.php';
require_once __DIR__ . '/Modules/EnrollMataKuliah/EnrollMataKuliahRepository.php';
require_once __DIR__ . '/Modules/EnrollMataKuliah/EnrollMataKuliahService.php';

require_once __DIR__ . '/Modules/Role/RoleEntity.php';
require_once __DIR__ . '/Modules/Role/RoleRepository.php';
require_once __DIR__ . '/Modules/Role/RoleService.php';

require_once __DIR__ . '/Modules/User/UserEntity.php';
require_once __DIR__ . '/Modules/User/UserRepository.php';
require_once __DIR__ . '/Modules/User/UserService.php';

use Modules\Fakultas\Repository\FakultasRepository;
use Modules\Fakultas\Service\FakultasService;
use Modules\Jurusan\Repository\JurusanRepository;
use Modules\Jurusan\Service\JurusanService;
use Modules\Mahasiswa\Repository\MahasiswaRepository;
use Modules\Mahasiswa\Service\MahasiswaService;
use Modules\MataKuliah\Repository\MataKuliahRepository;
use Modules\MataKuliah\Service\MataKuliahService;
use Modules\Mengajar\Repository\MengajarRepository;
use Modules\Mengajar\Service\MengajarService;
use Modules\Prodi\Repository\ProdiRepository;
use Modules\Prodi\Service\ProdiService;
use Modules\Role\Repository\RoleRepository;
use Modules\Ruangan\Repository\RuanganRepository;
use Modules\Ruangan\Service\RuanganService;
use Modules\User\Repository\UserRepository;
use Modules\User\Service\UserService;

$fakultasRepository = new FakultasRepository(Database::getConnection());
$jurusanRepository = new JurusanRepository(Database::getConnection());
$dosenRepository = new DosenRepository(Database::getConnection());
$mahasiswaRepository = new MahasiswaRepository(Database::getConnection());
$ruanganRepository = new RuanganRepository(Database::getConnection());
$mataKuliahRepository = new MataKuliahRepository(Database::getConnection());
$mengajarRepository = new MengajarRepository(Database::getConnection());
$prodiRepository = new ProdiRepository(Database::getConnection());
$enrollMataKuliahRepository = new EnrollMataKuliahRepository(Database::getConnection());
$roleRepository = new RoleRepository(Database::getConnection()); 
$userRepository = new UserRepository(Database::getConnection());

$fakultasService = new FakultasService($fakultasRepository, $dosenRepository, $jurusanRepository);

$roleService = new RoleService($roleRepository);
$userService = new UserService($userRepository, $roleRepository);

$jurusanService = new JurusanService(
    $jurusanRepository, 
    $fakultasRepository,
    $dosenRepository);
$dosenService = new DosenService($dosenRepository);
$mahasiswaService = new MahasiswaService(
    $mahasiswaRepository, 
    $prodiRepository,
    $jurusanRepository, 
    $dosenRepository,
    $userService);
$ruanganService = new RuanganService($ruanganRepository);

$mataKuliahService = new MataKuliahService($mataKuliahRepository, $dosenRepository, $jurusanRepository);

$mengajarService = new MengajarService(
    $mengajarRepository,
    $dosenRepository,
    $mataKuliahRepository
);

$prodiService = new ProdiService(
    $prodiRepository,
    $mahasiswaRepository,
    $dosenRepository,
    $jurusanRepository,
);

$enrollMataKuliahService = new EnrollMataKuliahService(
    $enrollMataKuliahRepository,
    $mahasiswaRepository,
    $mataKuliahRepository
);
