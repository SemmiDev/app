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

require_once __DIR__ . '/Modules/Session/SessionEntity.php';
require_once __DIR__ . '/Modules/Session/SessionRepository.php';
require_once __DIR__ . '/Modules/Session/SessionService.php';

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
use Modules\Session\Repository\SessionRepository;
use Modules\Session\Repository\SessionService;
use Modules\User\Repository\UserRepository;
use Modules\User\Service\UserService;

$fakultasRepository = new FakultasRepository(Database::getPDOConnection());
$jurusanRepository = new JurusanRepository(Database::getPDOConnection());
$dosenRepository = new DosenRepository(Database::getPDOConnection());
$mahasiswaRepository = new MahasiswaRepository(Database::getPDOConnection());
$ruanganRepository = new RuanganRepository(Database::getPDOConnection());
$mataKuliahRepository = new MataKuliahRepository(Database::getPDOConnection());
$mengajarRepository = new MengajarRepository(Database::getPDOConnection());
$prodiRepository = new ProdiRepository(Database::getPDOConnection());
$enrollMataKuliahRepository = new EnrollMataKuliahRepository(Database::getPDOConnection());
$roleRepository = new RoleRepository(Database::getPDOConnection()); 
$userRepository = new UserRepository(Database::getPDOConnection());

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
$sessionRepository = new SessionRepository(Database::getPDOConnection());
$sessionService = new SessionService($sessionRepository, $userRepository, $roleRepository);


function mustLogin() {
    global $sessionService;

    $sessDetails = $sessionService->current();
    if (is_null($sessDetails)) {
        header('Location: Login.php');
    }     
}

function mustSectionAuthorizedInRoles(...$roles) : bool {
    global $sessionService;

    $sessDetails = $sessionService->current();
    if (is_null($sessDetails)) {
        header('Location: Login.php');
    }
    
    $num = 0;
    foreach ($roles as $role) {
        if ($role == $sessDetails->role) {
            $num += 1;
        }
    }
    
    if ($num == 0) {
        return false;
    }

    return true;
}


function mustFullAuthorizedInRoles(...$roles) {
    global $sessionService;

    $sessDetails = $sessionService->current();
    if (is_null($sessDetails)) {
        header('Location: Login.php');
    }
    
    $num = 0;
    foreach ($roles as $role) {
        if ($role == $sessDetails->role) {
            $num += 1;
        }
    }
    
    if ($num == 0) {
        header('Location: AccessDenied.php');
    }
}