<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal Akademik</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-slate-100">
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center py-4 sm:py-4 px-4">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-semibold text-gray-800 no-underline">
                    <img src="../Assets/Images/riau.png" alt="logo" class="h-8">
                </a>
                <span class="ml-2 text-gray-600 text-md">Portal Akademik <span class="font-bold">Universitas Riau</span></span>
            </div>
        </div>
    </header>

    <div class="flex justify-center mt-10">
        <div class="w-full max-w-sm">
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


            <script>
                document.cookie = 'error=empty';
                document.cookie = 'success=empty';
            </script>

            <div class="flex flex-col break-words bg-white border-2 rounded shadow-md">
                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    <h1 class="text-center">Silahkan Login</h1>
                </div>
                <div class="w-full p-6">
                    <form class="user" action="AuthProses.php?act=login" method="POST">
                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                E-Mail
                            </label>
                            <input type="text" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="sammi@student.unri.ac.id">
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                                Password
                            </label>
                            <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="******************">
                        </div>
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-full">
                                <input type="text" id="captcha" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Captcha" name="captcha" required>
                            </div>

                            <div class="w-full ml-20">
                                <span class="text-gray-700 text-md font-bold">
                                    <img src="scripts/captcha.php" alt="PHP Captcha">
                                </span>
                            </div>
                        </div>

                        <div class="flex mb-6">
                            <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                                <input type="checkbox" name="remember" id="remember" class="form-checkbox">
                                <span class="ml-2">Ingat saya</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="login">
                                Login
                            </button>
                            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                                Lupa Password?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>