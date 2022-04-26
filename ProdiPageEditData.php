<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Edit Data Prodi</h1>

        <?php 
        require_once './App.php';
            $id = $_GET['id'];
            $dataProdi = $prodiService->findById($id);
            $dataDosen = $dosenService->findAll();
            $dataJurusan = $jurusanService->findAll();
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="ProdiProsesData.php?act=update" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">    
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                        Nama Prodi
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Masukkan Nama Mahasiswa" value="<?= $dataProdi->nama ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="kaprodi">
                        Kaprodi
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kaprodi" name="kaprodi" required>
                    <?php foreach ($dataDosen as $j) : ?>
                        <option value="<?= $j->id; ?>" <?php if ($j->id == $dataProdi->kaprodi->id) echo 'selected'; ?>><?= $j->namaDepan . ' ' . $j->namaBelakang; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="akreditasi">
                        Akreditasi
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="akreditasi" name="akreditasi" required>
                        <option value="A" <?php if ($dataProdi->akreditasi == 'A') echo 'selected'; ?>>A</option>
                        <option value="B" <?php if ($dataProdi->akreditasi == 'B') echo 'selected'; ?>>B</option>
                        <option value="C" <?php if ($dataProdi->akreditasi == 'C') echo 'selected'; ?>>C</option>
                        <option value="D" <?php if ($dataProdi->akreditasi == 'D') echo 'selected'; ?>>D</option>
                        <option value="E" <?php if ($dataProdi->akreditasi == 'E') echo 'selected'; ?>>E</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jurusan">
                        Jurusan
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jurusan" name="jurusan" required>
                    <?php foreach ($dataJurusan as $j) : ?>
                        <option value="<?= $j->id; ?>" <?php if ($j->id == $dataProdi->jurusan->id) echo 'selected'; ?>><?= $j->nama; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>