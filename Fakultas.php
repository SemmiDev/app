<?php include('./Layouts/Header.php'); ?>
    <div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
        <?php include('./Layouts/Navigation.php'); ?>
        <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
            <h1 class="text-3xl md:text-5xl font-extrabold mb-5" id="home">Data Fakultas</h1>

            <?php
                require_once 'App.php';
                $dataFakultas = $fakultasService->findAll();
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
                    <a href="./FakultasPageTambahData.php"
                       class="bg-blue-500 hover:bg-blue-700 text-slate-50 font-bold py-2 px-3 rounded">
                        Tambah Data
                    </a>
                </div>

                <?php if (count($dataFakultas) == 0) { ?>
                    <div class="bg-green-200 text-slate-900 px-4 py-3 rounded relative mb-5 w-2/3" id="div-error" role="alert">
                        <span class="block sm:inline">Ups! Data Kosong</span>
                    </div>
                <?php } else { ?>
                    
                    <table class="table-auto text-center">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Fakultas</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no = 1;
                    foreach ($dataFakultas as $fakultas) : ?>
                        <tr>
                            <td class="border px-4 py-2"><?= $no++ ?></td>
                            <td class="border px-4 py-2"><?= $fakultas->nama ?></td>
                            <td class="border px-4 py-2">
                                <a href="FakultasPageEditData.php?id=<?= $fakultas->id ?>" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                <a href="FakultasProsesData.php?act=delete&id=<?= $fakultas->id ?>" class="text-red-500 hover:text-red-700">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </main>
    </div>
<?php // include('./Layouts/footer.php'); ?>