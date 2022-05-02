<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Access Denied</title>
    <link rel="stylesheet" href="style.css">
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
        </div>
    </header>


    <script>
        document.cookie = 'error=empty';
        document.cookie = 'success=empty';
    </script>


    <div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
        <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
            <h1 class="text-3xl md:text-5xl mb-4 font-extrabold text-center" id="home">Access Denied</h1>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <p class="text-gray-700 text-sm font-bold mb-2 text-center">
                        You don't have permission to access this page.
                    </p>
                    <p class="text-gray-700 text-sm font-bold mb-2 text-center">
                        Please contact your administrator.
                    </p>
                </div>
            </div>

        </main>
    </div>

    <?php include './Layouts/Footer.php'; ?>