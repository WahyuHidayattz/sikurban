<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include 'koneksi.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM supplier where id='$id'";
    $data = mysqli_query($koneksi, $query);
    $supplier = mysqli_fetch_assoc($data);

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $bank = $_POST['bank'];
        $rekening = $_POST['rekening'];
        $nomor = $_POST['nomor'];

        $query = "UPDATE supplier set nama='$nama', alamat='$alamat', rekening='$bank', nomor_rekening='$rekening',nomor_hp='$nomor' where id='$id'";

        if (mysqli_query($koneksi, $query)) {
            $success = true;
        }
    }

    if (isset($_POST['delete'])) {
        $query = "UPDATE supplier SET `status`='deleted' where id='$id'";
        if (mysqli_query($koneksi, $query)) {
            $success = true;
            echo '<script type="text/javascript">window.location.href = "index.php?page=kelola_supplier";</script>';
        }
    }
}

if (isset($success)) {
    echo "<span class='w-full px-4 py-2 bg-blue-500 text-white rounded-md'>Sukses! RekeningBerhasil di Update.</span>";
}

?>

<div class="flex flex-row items-center justify-between gap-16">
    <div class="flex flex-col gap-2 flex-1">
        <h1 class="text-4xl font-bold text-black">Edit Supplier</h1>
        <span>Ini adalah halaman untuk melakukan edit dan hapus data supplier. Kamu bisa melakukan edit semua kolom yang ada di data supplier. Perlu diketahui, jika kamu menghapus data supplier, maka data yang ter-relasi dengan supplier ini akan terhapus juga.</span>
    </div>
    <div>
        <a href="?page=kelola_supplier" class="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l14 0" />
                <path d="M5 12l6 6" />
                <path d="M5 12l6 -6" />
            </svg>
            Kembali
        </a>
    </div>
</div>
<form action="" method="post" class="flex flex-col bg-white p-6 rounded-lg shadow-sm gap-4 m-0">
    <div class="flex flex-col gap-2">
        <label for="nama">Nama Supplier</label>
        <input type="text" name="nama" id="nama" class="input" value="<?= $supplier['nama']; ?>">
    </div>
    <div class="flex flex-col gap-2">
        <label for="alamat">Alamat</label>
        <textarea type="text" name="alamat" id="alamat" class="input" rows="3"><?= $supplier['alamat']; ?></textarea>
    </div>
    <div class="flex flex-col gap-2">
        <label for="nomor">Nomor HP</label>
        <input type="number" name="nomor" id="nomor" class="input" value="<?= $supplier['nomor_hp'];?>">
    </div>
    <div class="flex flex-col gap-2">
        <label for="bank">Bank Rekening</label>
        <select name="bank" id="bank" class="input">
            <option>-- Pilih Bank --</option>
            <option <?= $supplier['rekening'] == 'BCA' ? 'selected' : ''; ?>>BCA</option>
            <option <?= $supplier['rekening'] == 'BRI' ? 'selected' : ''; ?>>BRI</option>
            <option <?= $supplier['rekening'] == 'BNI' ? 'selected' : ''; ?>>BNI</option>
            <option <?= $supplier['rekening'] == 'BJB' ? 'selected' : ''; ?>>BJB</option>
            <option <?= $supplier['rekening'] == 'DKI' ? 'selected' : ''; ?>>DKI</option>
        </select>
    </div>
    <div class="flex flex-col gap-2">
        <label for="rekening">Nomor Rekening</label>
        <input type="number" name="rekening" id="nama" class="input" value="<?= $supplier['nomor_rekening']; ?>">
    </div>
    <div class="flex flex-row items-center justify-end gap-4">
        <button class="button" type="submit" name="submit">Update</button>
        <button class="button-danger" type="submit" name="delete">Delete</button>
    </div>
</form>