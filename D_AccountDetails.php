<?php

use Modules\User\Entity\UserUpdatePassword;

require_once './App.php';
mustLogin();
mustFullAuthorizedInRoles("dosen");
$current = $sessionService->current();

if (isset($_POST['submit'])) {
    if (isset($_POST['password'])) {
        $password = $_POST['password'];

        $req = new UserUpdatePassword();
        $req->email = $current->email;
        $req->newPassword = $password;
        $userService->updatePasswordDirectly($req);
        $sessionService->destroy();
    }
}
?>

<?php include('./Layouts/Header.php'); ?>
<div class="w-full flex flex-col sm:flex-row flex-grow overflow-hidden">
    <?php include('./Layouts/Navigation.php'); ?>
    <main role="main" class="w-full h-full flex-grow p-3 overflow-auto mt-4">
        <div class="table-responsive">
            <form action="D_AccountDetails.php" method="POST">
                <table class="table-auto w-full font-semibold border-collapse">
                    <tr>
                        <td class="border p-3">Email</td>
                        <td class="border p-3"><?php echo $current->email; ?></td>

                    </tr>
                    <tr>
                        <td class="border p-3">Password</td>
                        <td class="border p-3">
                            <input type="password" id="password" name="password" class="form-control p-3" placeholder="Masukkan Password Baru">
                            <input type="checkbox" onclick="showPassword()" id="check">
                            <label for="check">Show Password</label>
                            <script>
                                function showPassword() {
                                    var x = document.getElementById("password");
                                    if (x.type === "password") {
                                        x.type = "text";
                                    } else {
                                        x.type = "password";
                                    }
                                }
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-3">
                            <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </main>
</div>
<?php include('./Layouts/Footer.php'); ?>