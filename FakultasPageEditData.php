<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Edit Data Fakultas</h1>

        <?php
        require_once './App.php';
        $id = $_GET['id'];
        $dataFakultas = $fakultasService->findById($id);
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="FakultasProsesData.php?act=update" method="POST">
                <div class="mb-4">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                        Nama Fakultas
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Masukkan Nama Fakultas" value="<?= $dataFakultas->nama ?>" required>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>