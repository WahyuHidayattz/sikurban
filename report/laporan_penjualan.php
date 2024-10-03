<?php

include "koneksi.php";

$hewan = [];
$data = mysqli_query($koneksi, "SELECT * FROM hewan");
while ($d = mysqli_fetch_assoc($data)) {
    $hewan[$d['id']] = $d;
}

$supplier = [];
$data = mysqli_query($koneksi, "SELECT * FROM supplier");
while ($d = mysqli_fetch_assoc($data)) {
    $supplier[$d['id']] = $d;
}

$potongan = [];
$data = mysqli_query($koneksi, "SELECT * FROM hewan_potong");
while ($d = mysqli_fetch_assoc($data)) {
    $potongan[$d['id']] = $d;
}

$terjual = [];
$data = mysqli_query($koneksi, "SELECT * FROM hewan_keluar order by id desc");
while ($d = mysqli_fetch_assoc($data)) {
    $terjual[$d['id']] = $d;
}



?>

<?php if (isset($sukses)): ?>
    <span class="text-white bg-green-600 px-4 py-2 text-sm rounded-md">
        <?= $message; ?>
    </span>
<?php endif; ?>

<?php if (isset($error)): ?>
    <span class="text-white bg-red-600 px-4 py-2 text-sm rounded-md">
        <?= $message; ?>
    </span>
<?php endif; ?>

<div class="max-w-2xl w-full flex flex-col gap-4 mx-auto text-center py-8">
    <span class="text-2xl font-bold text-black">Laporan Penjualan Daging</span>
    <span>
        Menu ini adalah menu untuk melihat laporan penjualan / pengeluaran atas daging yang sudah disembelih.
    </span>
</div>

<div class="flex flex-col gap-4 p-6 mt-6 bg-white shadow-sm rounded-lg">
    <h3 class="text-black text-xl font-semibold">Laporan Daging Keluar</h3>
    <div class="flex overflow-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Hewan</td>
                    <td>Bagian</td>
                    <td>Supplier</td>
                    <td>Berat (Kg)</td>
                    <td>Harga/Kg</td>
                    <td>Total</td>
                    <td>Penerima</td>
                    <td>Tanggal</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                <?php foreach ($terjual as $d): ?>
                    <?php $no++; ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td>
                            <div class="flex flex-col">
                                <span class="text-lg"><?= $hewan[$potongan[$d['id_potong']]['id_hewan']]['nama'];?></span>
                                <span class="text-sm">by <?= $supplier[$hewan[$potongan[$d['id_potong']]['id_hewan']]['id_supplier']]['nama'];?></span>
                            </div>
                        </td>
                        <td class="text-black font-semibold"><?= $potongan[$d['id_potong']]['nama_bagian']; ?></td>
                        <td>Supplier</td>
                        <td><?= $d['berat']; ?></td>
                        <td>Rp.<?= number_format($d['harga']); ?></td>
                        <td>Rp.<?= number_format($d['total_harga']); ?></td>
                        <td><?= $d['nama_penerima']; ?></td>
                        <td>
                            <div class="flex flex-col items-center justify-center">
                                <span><?= date('d M Y',strtotime($d['tanggal'])); ?></span>
                                <span class="text-sm"><?= date('H:i:s',strtotime($d['tanggal'])); ?></span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>