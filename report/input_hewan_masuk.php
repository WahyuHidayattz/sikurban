<div class="flex flex-row items-center justify-between gap-16">
    <div class="flex flex-col gap-2 flex-1">
        <h1 class="text-4xl font-bold text-black">Input Hewan Masuk</h1>
        <span>Ini adalah halaman untuk menambahkan list hewan yang masuk dan datang dari supplier / penjual hewan.</span>
    </div>
    <div>
        <a href="?page=tambah_hewan" class="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-plus">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4.929 4.929a10 10 0 1 1 14.141 14.141a10 10 0 0 1 -14.14 -14.14zm8.071 4.071a1 1 0 1 0 -2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0 -2h-2v-2z" />
            </svg>
            Tambah Hewan
        </a>
    </div>
</div>
<div class="flex flex-col bg-white p-6 rounded-lg shadow-sm">
    <?php
    include 'koneksi.php';
    $hewan =  [];
    $query = mysqli_query($koneksi, "SELECT * FROM hewan WHERE `status`<>'DELETED' order by id desc");
    while ($d = mysqli_fetch_assoc($query)) {
        $hewan[] = $d;
    }

    $query = "SELECT * FROM supplier order by id desc";
    $row = mysqli_query($koneksi, $query);
    $supplier = [];
    while ($d = mysqli_fetch_assoc($row)) {
        $supplier[$d['id']] = $d;
    }
    ?>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Hewan</td>
                    <td>Jenis</td>
                    <td>Kualitas</td>
                    <td>Berat</td>
                    <td>Harga Total</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; ?>
                <?php foreach ($hewan as $d): ?>
                    <?php $no++; ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td>
                            <div class="flex flex-col items-start justify-start">
                                <span class="text-black font-medium text-xl">
                                    <?= $d['nama']; ?>
                                </span>
                                <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">
                                    <?= $supplier[$d['id_supplier']]['nama']; ?>
                                </span>
                            </div>
                        </td>
                        <td><?= $d['jenis']; ?></td>
                        <td><?= $d['kualitas']; ?></td>
                        <td><?= $d['berat']; ?></td>
                        <td>Rp.<?= number_format($d['harga'] * $d['berat']); ?></td>
                        <td><?= $d['status'];?></td>
                        <td>
                            <div class="flex flex-row items-center gap-2">
                                <a href="index.php?page=sembelih_hewan&id=<?= $d['id']; ?>" class="p-2 rounded-md bg-blue-500 text-white hover:bg-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-slice">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 19l15 -15l3 3l-6 6l2 2a14 14 0 0 1 -14 4" />
                                    </svg>
                                </a>
                                <a href="index.php?page=edit_hewan&id=<?= $d['id']; ?>" class="p-2 rounded-md bg-blue-500 text-white hover:bg-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>