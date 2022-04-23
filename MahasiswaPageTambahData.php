<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Tambah Data Mahasiswa</h1>

        <?php 
        require_once './App.php';
            $dataJurusan = $jurusanService->findAll();
            $dataDosen = $dosenService->findAll();
        ?>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="MahasiswaProsesData.php?act=create" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nim">
                        NIM
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nim" name="nim" type="text" placeholder="Masukkan NIM" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="namaDepan">
                        Nama Depan
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="namaDepan" name="namaDepan" type="text" placeholder="Masukkan Nama Depan" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="namaBelakang">
                        Nama Belakang
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="namaBelakang" name="namaBelakang" type="text" placeholder="Masukkan Nama Belakang" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Masukkan Email" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenisKelamin">
                        Jenis Kelamin
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenisKelamin" name="jenisKelamin" required>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="agama">
                        Agama
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="agama" name="agama" required>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenjang">
                        Jenjang
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenjang" name="jenjang" required>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggalLahir">
                        Tanggal Lahir
                    </label>
                    <!-- cool light input date with tailwind css -->
                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tanggalLahir" name="tanggalLahir" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="noHp">
                        No HP
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="noHp" name="noHp" type="text" placeholder="Masukkan No HP" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">
                        Alamat
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat" name="alamat" type="text" placeholder="Masukkan Alamat" required></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Cuti Akademik">Cuti Akademik</option>
                        <option value="Skorsing">Skorsing</option>
                        <option value="Drop Out">Drop Out</option>
                        <option value="Passing Out">Passing Out</option>
                        <option value="Non Aktif">Non Aktif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="totalSks">
                        Total SKS
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="totalSks" name="totalSks" type="number" placeholder="Masukkan Total SKS" value="0" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="semester">
                        Semester
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="semester" name="semester" type="number" placeholder="Masukkan Semester" value="1"  required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jurusan">
                        Jurusan
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jurusan" name="jurusan" required>
                        <option value="">Pilih Jurusan</option>
                        <?php foreach ($dataJurusan as $j) : ?>
                            <option value="<?= $j->id; ?>"><?= $j->nama; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dosen">
                        Dosen
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dosen" name="dosen" required>
                        <option value="">Pilih Dosen</option>
                        <?php foreach ($dataDosen as $d) : ?>
                            <option value="<?= $d->id; ?>"><?= $d->namaDepan . ' ' . $d->namaBelakang; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Tambahkan
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>