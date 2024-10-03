<?php

include "koneksi.php";

$hewan = [];
$query = "SELECT * FROM hewan WHERE `status`='SEMBELIH' order by id desc";
$data = mysqli_query($koneksi, $query);
while ($d = mysqli_fetch_assoc($data)) {
    $hewan[$d['id']] = $d;
}

$potongan = [];
$harga_potong =  [];
$query = "SELECT * FROM hewan_potong order by id desc";
$data = mysqli_query($koneksi, $query);
while ($d = mysqli_fetch_assoc($data)) {
    $potongan[$d['id']] = $d;
    @$harga_potong[$d['id_hewan']] += $d['harga'] * $d['berat'];
}

$supplier = [];
$query = "SELECT * FROM supplier order by id desc";
$data = mysqli_query($koneksi, $query);
while ($d = mysqli_fetch_assoc($data)) {
    $supplier[$d['id']] = $d;
}

$terjual = [];
$query = "SELECT * FROM hewan_keluar order by id desc";
$data = mysqli_query($koneksi, $query);
while ($d = mysqli_fetch_assoc($data)) {
    @$terjual[$d['id_potong']] += $d['berat'];
}

if (isset($_POST['submit'])) {
    $idbagian = $_POST['id_bagian'];
    $berat = $_POST['berat'];
    $penerima = $_POST['penerima'];
    $databagian = $potongan[$idbagian];
    $harga = $databagian['harga'];
    $total = $databagian['berat'] * $harga;

    $berat_terual = isset($terjual[$idbagian]) ? $terjual[$idbagian] : 0;
    $sisa_berat = $databagian['berat'] - $berat_terual;

    if ($berat > $sisa_berat) {
        $error = true;
        $message = "Gagal proses, berat yang dijual tidak boleh lebih dari sisa berat bagian";
    } else {
        $tanggal = date("Y-m-d H:i:s");
        $query = "INSERT INTO hewan_keluar (id_potong, berat, harga, total_harga, nama_penerima, tanggal) values ('$idbagian','$berat','$harga','$total','$penerima', '$tanggal')";
        if (mysqli_query($koneksi, $query)) {
            $sukses = true;
            $daging = $databagian['nama_bagian'];
            $message = "Berhasil daging bagian $daging berhasil dijual seberta $berat Kg!";

            $terjual = [];
            $query = "SELECT * FROM hewan_keluar order by id desc";
            $data = mysqli_query($koneksi, $query);
            while ($d = mysqli_fetch_assoc($data)) {
                @$terjual[$d['id_potong']] += $d['berat'];
            }
        }
    }
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

<div class="max-w-2xl w-full flex flex-col gap-4 mx-auto text-center">
    <span class="text-2xl font-bold text-black">Hewan Keluar / Jual</span>
    <span>
        Menu ini adalah pencatatan hewan keluar, hewan yang bisa keluar / dijual adalah hewan yang statusnya sudah di sembelih dan dibagi menjadi beberapa bagian daging/tulang/jeroan.
    </span>
    <div class="flex flex-row items-center justify-center">
        <a href="index.php?page=laporan_penjualan" class="bg-gray-200 rounded-full px-3 py-2 text-sm hover:bg-black hover:text-white transition duration-300">Lihat History Penjualan</a>
    </div>
</div>

<div class="flex flex-col gap-6 mt-6 divide-y-2 divide-gray-300">
    <?php foreach ($hewan as $d): ?>
        <div class="flex flex-col gap-4 py-4">
            <div class="flex flex-row items-center justify-between">
                <div class="flex flex-col">
                    <span class="text-xl font-semibold text-black"><?= $d['nama']; ?></span>
                    <span class="text-sm">by <?= $supplier[$d['id_supplier']]['nama']; ?> - Harga Utuh : Rp. <?= number_format(($d['berat'] * $d['harga'])); ?></span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm">Berat : <?= $d['berat']; ?></span>
                    <span class="text-sm">Total Rph potong : Rp.<?= number_format($harga_potong[$d['id']]); ?></span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <?php foreach ($potongan as $p): ?>
                    <?php if ($p['id_hewan'] == $d['id']): ?>
                        <?php
                        $berat_terual = isset($terjual[$p['id']]) ? $terjual[$p['id']] : 0;
                        $sisa_berat = $p['berat'] - $berat_terual;
                        ?>
                        <div class="px-3 py-2 bg-white shadow-sm rounded-md flex flex-col gap-2">
                            <div class="flex flex-row items-center justify-between border-b border-b-gray-300 border-dashed py-2">
                                <span class="text-lg font-medium text-black"><?= $p['nama_bagian']; ?></span>
                                <span class="text-sm">Harga/Kg : Rp.<?= number_format($p['harga']); ?></span>
                            </div>
                            <div class="flex flex-row items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-sm">Total : <?= $p['berat']; ?> Kg</span>
                                    <span class="text-sm">Sisa : <?= $sisa_berat; ?> Kg</span>
                                </div>

                                <?php if ($sisa_berat == 0): ?>
                                    <span class="text-sm text-slate-400">Habis Terjual</span>
                                <?php else: ?>
                                    <div x-data="{ modelOpen: false }">
                                        <button @click="modelOpen =!modelOpen" class="p-2 rounded-md bg-green-600 text-white shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package-export">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                                <path d="M12 12l8 -4.5" />
                                                <path d="M12 12v9" />
                                                <path d="M12 12l-8 -4.5" />
                                                <path d="M15 18h7" />
                                                <path d="M19 15l3 3l-3 3" />
                                            </svg>
                                        </button>
                                        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                                    x-transition:enter="transition ease-out duration-300 transform"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="transition ease-in duration-200 transform"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0"
                                                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                                                <div x-cloak x-show="modelOpen"
                                                    x-transition:enter="transition ease-out duration-300 transform"
                                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave="transition ease-in duration-200 transform"
                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                                                    <div class="flex items-center justify-between space-x-4">
                                                        <h1 class="text-xl font-medium text-gray-800 ">Jual / Keluargakn Daging</h1>

                                                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <p class="mt-2 text-sm text-gray-500 ">
                                                        Jual / keluarkan bagian daging hewan yang sudah disembelih.
                                                    </p>

                                                    <form action="" method="post" class="w-full p-0 m-0 flex flex-col gap-4 mt-6">
                                                        <div class="flex flex-col gap-1">
                                                            <label for="nama_bagian">Nama Bagian</label>
                                                            <input type="hidden" name="id_bagian" id="id_bagian" value="<?= $p['id']; ?>">
                                                            <input type="text" name="nama_bagian" id="nama_bagian" class="input" value="<?= $p['nama_bagian']; ?>" disabled>
                                                        </div>
                                                        <div class="flex flex-col gap-1">
                                                            <label for="berat">Berat</label>
                                                            <input type="text" name="berat" id="berat" class="input" placeholder="Max : <?= $sisa_berat; ?>" required>
                                                        </div>
                                                        <div class="flex flex-col gap-1">
                                                            <label for="penerima">Penerima</label>
                                                            <input type="text" name="penerima" id="penerima" class="input" required>
                                                        </div>
                                                        <div class="flex flex-row items-center justify-end">
                                                            <button name="submit" class="button">Jual / Bagikan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>