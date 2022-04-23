<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Tambah Data Dosen</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="DosenProsesData.php?act=create" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nip">
                        NIP
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nip" name="nip" type="text" placeholder="Masukkan NIP" required>
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="golongan">
                        Golongan
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="golongan" name="golongan" required>
                        <option value="">Pilih Golongan</option>

                        <option value="Golongan I A">Golongan I A</option>
                        <option value="Golongan I B">Golongan I B</option>
                        <option value="Golongan I C">Golongan I C</option>
                        <option value="Golongan I D">Golongan I D</option>

                        <option value="Golongan II A">Golongan II A</option>
                        <option value="Golongan II B">Golongan II B</option>
                        <option value="Golongan II C">Golongan II C</option>
                        <option value="Golongan II D">Golongan II D</option>

                        <option value="Golongan III A">Golongan III A</option>
                        <option value="Golongan III B">Golongan III B</option>
                        <option value="Golongan III C">Golongan III C</option>
                        <option value="Golongan III D">Golongan III D</option>

                        <option value="Golongan IV A">Golongan IV A</option>
                        <option value="Golongan IV B">Golongan IV B</option>
                        <option value="Golongan IV C">Golongan IV C</option>
                        <option value="Golongan IV D">Golongan IV D</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="Kontrak">Kontrak</option>
                        <option value="Tetap">Tetap</option>
                        <option value="Honorer">Honorer</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" placeholder="Masukkan Email" required>
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="noTelp">
                        No Telp
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="noTelp" name="noTelp" type="text" placeholder="Masukkan No Telp" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="noHP">
                        No HP
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="noHP" name="noHP" type="text" placeholder="Masukkan No HP" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">
                        Alamat
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat" name="alamat" type="text" placeholder="Masukkan Alamat" required>
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