<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Edit Data Ruangan</h1>

        <?php
            require_once './App.php';
            $id = $_GET['id'];
            $dataRuangan = $ruanganService->findById($id);
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="RuanganProsesData.php?act=update" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">
                        Nama
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Masukkan Nama Ruangan" value="<?= $dataRuangan->nama ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis">
                        Jenis
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenis" name="jenis" type="text" placeholder="Masukkan Jenis Ruangan" value="<?= $dataRuangan->jenis ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="kapasitas">
                        Kapasitas
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kapasitas" name="kapasitas" type="text" placeholder="Masukkan Kapasitas Ruangan" value="<?= $dataRuangan->kapasitas ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lantai">
                        Lantai
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lantai" name="lantai" type="number" placeholder="Masukkan Lantai Ruangan" value="<?= $dataRuangan->lantai ?>" required>
                </div>

                <div class="mb-4">
                    <label class="block text-pink-700 text-sm font-bold mb-2" for="notes">
                        Notes: <span class="font-thin italic">Untuk melihat kordinat lokasi, silahkan buka <a href="https://maps.google.com" target="_blank" class="font-bold">Google Maps</a>,
                        dan klik kanan dibagian lokasi kemudian copy kordinat nya</span>
                    </label>
                    <img src="./Assets/Images/contoh-map.png" alt="cool image" class="w-full rounded-lg shadow-md">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="latitude">
                        Latitude
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="latitude" name="latitude" type="text" placeholder="Masukkan Latitude" value="<?= $dataRuangan->latitude ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="longitude">
                        Longitude
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="longitude" name="longitude" type="text" placeholder="Masukkan Longitude" value="<?= $dataRuangan->longitude ?>" required>
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