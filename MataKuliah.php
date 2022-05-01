<?php
    require_once './App.php';
    mustLogin();
    mustFullAuthorizedInRoles("admin");
?>

<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-5" id="home">Data Mata Kuliah</h1>

        <?php
        $dataMataKuliah = $mataKuliahService->findAll();
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
                <a href="./MataKuliahPageTambahData.php" class="bg-blue-500 hover:bg-blue-700 text-slate-50 font-bold py-2 px-3 rounded">
                    Tambah Data
                </a>
            </div>

            <?php if (count($dataMataKuliah) == 0) { ?>
                <div class="bg-green-200 text-slate-900 px-4 py-3 rounded relative mb-5 w-2/3" id="div-error" role="alert">
                    <span class="block sm:inline">Ups! Data Kosong</span>
                </div>
            <?php } else { ?>

                <div class="table-responsive">
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama Mata Kuliah</th>
                                <th class="px-4 py-2">Kode</th>
                                <th class="px-4 py-2">SKS</th>
                                <th class="px-4 py-2">Jurusan</th>
                                <th class="px-4 py-2">Semester</th>
                                <th class="px-4 py-2">Dosen Pengampu</th>
                                <th class="px-4 py-2">Total Mahasiswa</th>
                                <th class="px-4 py-2">Dosen Pengajar</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dataMataKuliah as $mataKuliah) : ?>
                                <tr>
                                    <td class="border px-4 py-2"><?= $i ?></td>
                                    <td class="border px-4 py-2"><?= $mataKuliah->nama ?></td>
                                    <td class="border px-4 py-2"><?= $mataKuliah->kode ?></td>
                                    <td class="border px-4 py-2"><?= $mataKuliah->sks ?></td>
                                    <td class="border px-4 py-2"><?= $mataKuliah->jurusan->nama ?></td>
                                    <td class="border px-4 py-2"><?= $mataKuliah->semester ?></td>
                                    <td class="border px-4 py-2"><?= $mataKuliah->dosenPengampu->namaDepan . ' ' . $mataKuliah->dosenPengampu->namaBelakang ?></td>
                                    <td class="border px-4 py-2"><?= $mataKuliahService->totalMahasiswaInMataKuliahId($mataKuliah->id) . ' orang' ?></td>

                                    <td class="border px-4 py-2">
                                        <?php foreach ($mataKuliahService->dosenPengajar($mataKuliah->id) as $dosenPengajar) : ?>
                                            <li class="ml-2">
                                                <a href="./DosenPage.php?id=<?= $dosenPengajar->namaDepan ?>" class="text-blue-500 hover:text-blue-700">
                                                    <?= $dosenPengajar->namaDepan . ' ' . $dosenPengajar->namaBelakang ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <div class="flex">
                                            <a href="./MataKuliahPageEditData.php?id=<?= $mataKuliah->id ?>" class="bg-green-500 hover:bg-green-700 text-slate-50 font-bold py-2 px-3 rounded mr-2">
                                                Edit
                                            </a>
                                            <a href="./MataKuliahProsesData.php?act=delete&id=<?= $mataKuliah->id ?>" class="bg-red-500 hover:bg-red-700 text-slate-50 font-bold py-2 px-3 rounded">
                                                Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>