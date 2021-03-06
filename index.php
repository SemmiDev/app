<?php include('./Layouts/Header.php'); ?>


<script>
    document.cookie = 'error=empty';
    document.cookie = 'success=empty';
</script>

<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <h1 class="text-3xl md:text-5xl mb-4 font-extrabold" id="home">Selamat Datang</h1>
    </main>
</div>

<?php include('./Layouts/Footer.php'); ?>