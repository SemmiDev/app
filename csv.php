
<?php include('./Layouts/Header.php'); ?>
<?php include('./Layouts/Navigation.php'); ?>

<div class="flex flex-wrap -mx-2">
    <div class="w-full px-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-csv">
            Pilih File
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-csv" type="file" name="csv" accept=".csv">
    </div>
</div>


<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-5" id="home">Import Data</h1>

        <?php $dataDosen = $dosenService->findAll() ?>

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
                <a href="./DosenPageTambahData.php" class="bg-blue-500 hover:bg-blue-700 text-slate-50 font-bold py-2 px-3 rounded">
                    Tambah Data
                </a>
            </div>

            <?php if (count($dataDosen) == 0) { ?>
                <div class="bg-green-200 text-slate-900 px-4 py-3 rounded relative mb-5 w-2/3" id="div-error" role="alert">
                    <span class="block sm:inline">Ups! Data Kosong</span>
                </div>
            <?php } else { ?>

            <div class="table-responsive">
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">NIP</th>
                            <th class="px-4 py-2">Nama Depan</th>
                            <th class="px-4 py-2">Nama Belakang</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Jenis Kelamin</th>
                            <th class="px-4 py-2">No Telp</th>
                            <th class="px-4 py-2">No HP</th>
                            <th class="px-4 py-2">Golongan</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataDosen as $dosen) : ?>
                            <tr>
                                <td class="border px-4 py-2"><?= $no++ ?></td>
                                <td class="border px-4 py-2"><?= $dosen->nip ?></td>
                                <td class="border px-4 py-2"><?= $dosen->namaDepan ?></td>
                                <td class="border px-4 py-2"><?= $dosen->namaBelakang ?></td>
                                <td class="border px-4 py-2"><?= $dosen->email ?></td>
                                <td class="border px-4 py-2"><?= $dosen->jenisKelamin ?></td>
                                <td class="border px-4 py-2"><?= $dosen->noTelp ?></td>
                                <td class="border px-4 py-2"><?= $dosen->noHP ?></td>
                                <td class="border px-4 py-2"><?= $dosen->golonganPNS ?></td>
                                <td class="border px-4 py-2"><?= $dosen->status ?></td>
                                <td class="border px-4 py-2"><?= $dosen->alamat ?></td>
                                <td class="border px-4 py-2">
                                    <div class="flex">
                                        <a href="./DosenPageEditData.php?id=<?= $dosen->id ?>" class="bg-green-500 hover:bg-green-700 text-slate-50 font-bold py-2 px-3 rounded mr-2">
                                            Edit
                                        </a>
                                        <a href="./DosenProsesData.php?act=delete&id=<?= $dosen->id ?>" class="bg-red-500 hover:bg-red-700 text-slate-50 font-bold py-2 px-3 rounded">
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