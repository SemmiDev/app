<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-slate-100">
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center py-4 sm:py-4 px-4 mr-2">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-semibold text-gray-800 no-underline">
                    <img src="../Assets/Images/riau.png" alt="logo" class="h-8">
                </a>
                <span class="ml-2 text-gray-600 text-md">Sistem Informasi Akademik <span class="font-bold">Universitas Riau</span></span>
            </div>
            
            
            <?php
                require_once './App.php';
                if (mustSectionAuthorizedInRoles('admin')) { 
            ?>
            <div class="flex items-center">
                <span class="text-gray-600 text-sm font-bold"> Admin </span>
                <a href="../AuthProses.php?act=logout" class="text-gray-600 text-sm no-underline">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/logout.svg" class="w-7 sm:mx-2 mx-4 inline" />
                </a>
            </div>
            <?php } else if (mustSectionAuthorizedInRoles('mahasiswa')) {?>
                <div class="flex items-center">
                <span class="text-gray-600 text-sm font-bold"> <?= $sessionService->current()->email ?> </span>
                <a href="../AuthProses.php?act=logout" class="text-gray-600 text-sm no-underline">
                    <img src="//cdn.jsdelivr.net/npm/heroicons@1.0.6/outline/logout.svg" class="w-7 sm:mx-2 mx-4 inline" />
                </a>
            </div>
            <?php }?>
        </div>
    </header>