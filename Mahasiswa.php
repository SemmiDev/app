<?php
    require_once './App.php';
    mustLogin();
    mustFullAuthorizedInRoles("admin");
?>

<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-5" id="home">Data Mahasiswa</h1>

        <?php
        $dataMhs = $mahasiswaService->findAll();
        ?>

        <div class="container">
            <?php if (isset($_COOKIE['error'])  && $_COOKIE['error'] != 'empty') : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" id="div-error" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline"><?= $_COOKIE['error'] ?></span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <script>
                            setTimeout(function() {
                                document.querySelector('#div-error').remove();
                            }, 2000);
                        </script>
                    </span>
                </div>
            <?php endif; ?>

            <?php if (isset($_COOKIE['success']) && $_COOKIE['success'] != 'empty') : ?>
                <div class="bg-red-100 border border-green-500 text-green-700 px-4 py-3 rounded relative mb-5" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline"><?= $_COOKIE['success'] ?></span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <script>
                            setTimeout(function() {
                                document.querySelector('.bg-red-100').remove();
                            }, 2000);
                        </script>
                    </span>
                </div>
            <?php endif; ?>


            <script>
                document.cookie = 'error=empty';
                document.cookie = 'success=empty';
            </script>

            <div class="flex mb-5">
                <a href="./MahasiswaPageTambahData.php" class="bg-blue-500 hover:bg-blue-700 text-slate-50 font-bold py-2 px-3 rounded">
                    Tambah Data
                </a>
            </div>

            <?php if (count($dataMhs) == 0) { ?>
                <div class="bg-green-200 text-slate-900 px-4 py-3 rounded relative mb-5 w-2/3" id="div-error" role="alert">
                    <span class="block sm:inline">Ups! Data Kosong</span>
                </div>
            <?php } else { ?>

                <div class="table-responsive">
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">NIM</th>
                                <th class="px-4 py-2">Nama Depan</th>
                                <th class="px-4 py-2">Nama Belakang</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Jenis Kelamin</th>
                                <th class="px-4 py-2">Agama</th>
                                <th class="px-4 py-2">Jenjang</th>
                                <th class="px-4 py-2">Tanggal Lahir</th>
                                <th class="px-4 py-2">No HP</th>
                                <th class="px-4 py-2">Alamat</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Angkatan</th>
                                <th class="px-4 py-2">Jalur Masuk</th>
                                <th class="px-4 py-2">Total SKS</th>
                                <th class="px-4 py-2">Semester</th>
                                <th class="px-4 py-2">Jurusan</th>
                                <th class="px-4 py-2">Prodi</th>
                                <th class="px-4 py-2">Dosen PA</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($dataMhs as $mhs) : ?>
                                <tr>
                                    <td class="border px-4 py-2"><?= $no++ ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->nim ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->namaDepan ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->namaBelakang ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->email ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->jenisKelamin ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->agama ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->jenjang ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->tanggalLahir ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->noHP ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->alamat ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->status ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->angkatan ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->jalurMasuk ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->totalSKS ?></td>
                                    <td class="border px-4 py-2"><?= $mhs->semester ?></td>

                                    <?php if (!is_null($mhs->jurusan)) { ?>
                                        <td class="border px-4 py-2"><?= $mhs->jurusan->nama ?></td>
                                    <?php } else { ?>
                                        <td class="border px-4 py-2">
                                            <div class="flex justify-center">
                                                <svg class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </td>
                                    <?php } ?>

                                    <td class="border px-4 py-2">
                                        <div class="flex justify-center mb-2">
                                            <?php if (!is_null($mhs->prodi)) { ?>
                                                <span class="text-gray-700 text-sm"><?= $mhs->prodi->nama ?></span>
                                            <?php } else { ?>
                                                <span class="text-gray-700 text-sm">-</span>
                                            <?php } ?>
                                        </div>

                                        <div class="flex justify-center">
                                            <a href="./MahasiswaPageEditProdiData.php?id=<?= $mhs->id ?>&jurusan_id=<?= $mhs->jurusan->id ?>" class="bg-blue-500 hover:bg-blue-700 text-slate-50 font-bold py-2 px-3 rounded">
                                                Prodi
                                            </a>
                                        </div>
                                    </td>

                                    <?php if (!is_null($mhs->dosenPA)) { ?>
                                        <td class="border px-4 py-2"><?= $mhs->dosenPA->namaDepan . ' '. $mhs->dosenPA->namaBelakang ?></td>
                                    <?php } else { ?>
                                        <td class="border px-4 py-2">
                                            <div class="flex justify-center">
                                                <svg class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </td>
                                    <?php } ?>

                                    <td class="border px-4 py-2">
                                        <div class="flex">
                                            <a href="./MahasiswaPageEditData.php?id=<?= $mhs->id ?>" class="bg-green-500 hover:bg-green-700 text-slate-50 font-bold py-2 px-3 rounded mr-2">
                                                Edit
                                            </a>
                                            <a href="./MahasiswaProsesData.php?act=delete&id=<?= $mhs->id ?>" class="bg-red-500 hover:bg-red-700 text-slate-50 font-bold py-2 px-3 rounded">
                                                Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>