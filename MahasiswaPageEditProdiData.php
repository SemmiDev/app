<?php
    require_once './App.php';
    mustLogin();
    mustFullAuthorizedInRoles("admin");
?>


<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Pilih Prodi</h1>
        <?php

        $id = $_GET['id'];
        $jurusanId = $_GET['jurusan_id'];

        $listProdiAvailableInJurusan = $prodiService->listProdiInJurusan($jurusanId);
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="MahasiswaProsesData.php?act=update-prodi" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="prodi">
                        Prodi
                    </label>
                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="prodi" id="prodi">
                        <?php foreach ($listProdiAvailableInJurusan as $prodi) : ?>
                            <option value="<?= $prodi['id_prodi'] ?>"><?= $prodi['nama_prodi'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>