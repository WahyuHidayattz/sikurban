<?php
$user = $_SESSION['auth']['user'];
$id = $user['id'];

include "koneksi.php";

if (isset($_POST['update_profile'])) {
    $nama       = $_POST['nama'];
    $username   = $_POST['username'];
    $alamat     = $_POST['alamat'];
    $nomor_hp   = $_POST['nomor_hp'];

    $query      = "UPDATE users SET nama='$nama', username='$username', alamat='$alamat', nomor_hp='$nomor_hp' WHERE id='$id'";
    if (mysqli_query($koneksi, $query)) {
        $sukses     = true;
        $message    = "Profile berhasil di update";
        $user       = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'"));
        $_SESSION['auth']['user'] = $user;
    }
}

if (isset($_POST['update_password'])) {
    $password_lama  = $_POST['old_password'];
    $password_baru  = $_POST['new_password'];
    $confirmation   = $_POST['password_confirmation'];

    if ($password_baru == $confirmation) {
        if ($password_lama == $user['password']) {
            $query          = "UPDATE users set password='$password_baru' where id='$id'";
            mysqli_query($koneksi, $query);
            $sukses = true;
            $message = "Sukses, Password berhasil diganti.";
            $user       = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'"));
            $_SESSION['auth']['user'] = $user;
        } else {
            $error = true;
            $message  = "Password lama tidak cocok, sepertinya anda mencoba merubah password secara illegal!";
        }
    } else {
        $error     = true;
        $message  = "Gagal ubah password! Password baru dan Konfirmasi harus sama!";
    }
}
?>

<?php if (isset($error)): ?>
    <span class="px-3 py-2 bg-red-500 text-white text-sm rounded-md"><?= $message; ?></span>
<?php endif; ?>

<?php if (isset($sukses)): ?>
    <span class="px-3 py-2 bg-green-500 text-white text-sm rounded-md"><?= $message; ?></span>
<?php endif; ?>

<div class="flex flex-col bg-white rounded-lg shadow-sm p-8 gap-2 items-center justify-center">
    <h1 class="text-5xl font-bold text-black"><?= $user['nama']; ?></h1>
    <span class="text-xl">Role : <?= strtoupper($user['role']); ?></span>
</div>

<div class="flex flex-col gap-4 bg-white rounded-lg shadow-sm p-6">
    <span class="text-lg font-semibold text-black">Edit Profile</span>
    <form action="" method="post" class="grid grid-cols-2 gap-4 p-0 m-0">
        <div class="flex flex-col">
            <label for="nama">Nama</label>
            <input type="text" class="input" name="nama" id="nama" value="<?= $user['nama']; ?>">
        </div>
        <div class="flex flex-col">
            <label for="username">Username</label>
            <input type="text" class="input disabled:bg-gray-200" name="username" id="username" value="<?= $user['username']; ?>">
        </div>
        <div class="flex flex-col">
            <label for="alamat">Alamat</label>
            <input type="text" class="input" name="alamat" id="alamat" value="<?= $user['alamat']; ?>">
        </div>
        <div class="flex flex-col">
            <label for="nomor_hp">Nomor Hp</label>
            <input type="text" class="input" name="nomor_hp" id="nomor_hp" value="<?= $user['nomor_hp']; ?>">
        </div>
        <div class="col-span-2 flex flex-row items-center justify-end">
            <button type="submit" name="update_profile" class="button">Update Profile</button>
        </div>
    </form>

    <span class="text-lg font-semibold text-black mt-6">Update Password</span>
    <form action="" method="post" class="flex flex-col w-1/2 gap-4 p-0 m-0">
        <div class="flex flex-col">
            <label for="old_password">Password Lama</label>
            <input type="password" class="input" name="old_password" id="old_password" ">
        </div>
        <div class=" flex flex-col">
            <label for="new_password">Password Baru</label>
            <input type="password" class="input" name="new_password" id="new_password">
        </div>
        <div class="flex flex-col">
            <label for="password_confirmation">Password Baru</label>
            <input type="password" class="input" name="password_confirmation" id="password_confirmation">
        </div>

        <div class="flex flex-row items-start justify-end">
            <button type="submit" name="update_password" class="button">Update Password</button>
        </div>
</div>
</div>