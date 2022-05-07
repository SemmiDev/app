<?php require_once './App.php' ?>

<?php if (mustSectionAuthorizedInRoles("admin")) { ?>

<div class="sm:w-1/5 md:h-1/5 w-full flex-shrink flex-grow-0 p-4 mt-4">
    <div class="sticky top-0 p-4 bg-gray-100 rounded-xl w-full">
        <ul class="flex sm:flex-col overflow-hidden content-center justify-between">
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="index.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.1/outline/home.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Home</span>
                </a>
            </li>

            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="Fakultas.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/office-building.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Fakultas</span>
                </a>
            </li>       

            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="Jurusan.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/academic-cap.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Jurusan</span>
                </a>
            </li>  
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="Prodi.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/badge-check.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Prodi</span>
                </a>
            </li>
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="Dosen.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/user.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Dosen</span>
                </a>
            </li> 
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="Mahasiswa.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/user-group.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Mahasiswa</span>
                </a>
            </li>
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="Ruangan.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/library.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Ruangan</span>
                </a>
            </li>
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="MataKuliah.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/clipboard-list.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Mata Kuliah</span>
                </a>
            </li>
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="Mengajar.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/template.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Mengajar</span>
                </a>
            </li>
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="EnrollMataKuliah.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/book-open.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Enroll Matkul</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } else if (mustSectionAuthorizedInRoles("mahasiswa")) { ?>
    <div class="sm:w-1/5 md:h-1/5 w-full flex-shrink flex-grow-0 p-4 mt-4">
    <div class="sticky top-0 p-4 bg-gray-100 rounded-xl w-full">
        <ul class="flex sm:flex-col overflow-hidden content-center justify-between">
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="M_AccountDetails.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/user.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Account</span>
                </a>
            </li><li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="M_MahasiswaDetails.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/credit-card.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Biodata</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php } else if (mustSectionAuthorizedInRoles("dosen")) { ?>
    <div class="sm:w-1/5 md:h-1/5 w-full flex-shrink flex-grow-0 p-4 mt-4">
    <div class="sticky top-0 p-4 bg-gray-100 rounded-xl w-full">
        <ul class="flex sm:flex-col overflow-hidden content-center justify-between">
            <li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="D_AccountDetails.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/user.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Account</span>
                </a>
            </li><li class="py-2 hover:bg-indigo-300 rounded">
                <a class="truncate" href="D_DosenDetails.php">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/credit-card.svg" class="w-7 sm:mx-2 mx-4 inline"/>
                    <span class="hidden sm:inline">Biodata</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<?php } ?>
