<?php

session_start();
if (!$_SESSION['auth']) {
    header('location: auth/login.php');
}
if ($_SESSION['auth']) {
    $user = $_SESSION['auth']['user'];
    $role = $user['role'];
    $name = $user['nama'];
    $data = [
        'dashboard' => [
            'title' => 'Dashboard',
            'link'  => 'dashboard.php',
            'role' => ['admin', 'kasir'],
        ],
        'hewan_masuk' => [
            'title' => 'Hewan Masuk',
            'link' => 'input_hewan_masuk.php',
            'role' => ['admin'],
        ],
        'hewan_keluar' => [
            'title' => 'Hewan Keluar',
            'link' => 'input_hewan_keluar.php',
            'role' => ['admin', 'kasir'],
        ],
        'kelola_supplier' => [
            'title' => 'Kelola Supplier',
            'link' => 'kelola_supplier.php',
            'role' => ['admin'],
        ],
        'tambah_supplier' => [
            'title' => 'Tambah Supplier',
            'link' => 'supplier/tambah.php',
            'role' => ['admin'],
        ],
        'edit_supplier' => [
            'title' => 'Edit Supplier',
            'link' => 'supplier/edit.php',
            'role' => ['admin'],
        ],
        'tambah_hewan' => [
            'title' => 'Tambah Hewan',
            'link' => 'hewan/tambah.php',
            'role' => ['admin'],
        ],
        'edit_hewan' => [
            'title' => 'Edit Hewan',
            'link' => 'hewan/edit.php',
            'role' => ['admin'],
        ],
        'laporan_penjualan' => [
            'title' => 'Laporan Penjualan',
            'link' => 'laporan_penjualan.php',
            'role' => ['admin', 'kasir'],
        ],
        'sembelih_hewan' => [
            'title' => 'Sembelih Hewan',
            'link' => 'hewan/sembelih.php',
            'role' => ['admin'],
        ],
        'profile' => [
            'title' => 'Profile',
            'link' => 'profile.php',
            'role' => ['admin', 'kasir'],
        ],
    ];
}

if (isset($_POST['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: auth/login.php');
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Barang</title>
    <link rel="stylesheet" href="assets/app.css">
    <script src="assets/alpinejs.js"></script>
</head>

<body>
    <div class="w-full h-screen bg-gray-100 flex">
        <div class="w-80 bg-blue-600 text-white px-3 py-6 overflow-auto">
            <div class="flex flex-col w-full gap-4">
                <div class="flex flex-col gap-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-deer">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 3c0 2 1 3 4 3c2 0 3 1 3 3" />
                        <path d="M21 3c0 2 -1 3 -4 3c-2 0 -3 .333 -3 3" />
                        <path d="M12 18c-1 0 -4 -3 -4 -6c0 -2 1.333 -3 4 -3s4 1 4 3c0 3 -3 6 -4 6" />
                        <path d="M15.185 14.889l.095 -.18a4 4 0 1 1 -6.56 0" />
                        <path d="M17 3c0 1.333 -.333 2.333 -1 3" />
                        <path d="M7 3c0 1.333 .333 2.333 1 3" />
                        <path d="M7 6c-2.667 .667 -4.333 1.667 -5 3" />
                        <path d="M17 6c2.667 .667 4.333 1.667 5 3" />
                        <path d="M8.5 10l-1.5 -1" />
                        <path d="M15.5 10l1.5 -1" />
                        <path d="M12 15h.01" />
                    </svg>
                    <h1 class="flex flex-row items-center gap-4">
                        <span class="font-semibold text-2xl">SIKURBAN</span>
                    </h1>
                    <span class="text-center">
                        Sistem Informasi Kurban Hewan
                    </span>
                </div>
                <div class="flex flex-col rounded-xl bg-white/10 py-4">
                    <a href="?page=dashboard" class="flex flex-row items-center gap-4 px-4 py-3 hover:bg-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-gauge">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M13.41 10.59l2.59 -2.59" />
                            <path d="M7 12a5 5 0 0 1 5 -5" />
                        </svg>
                        Dashboard
                    </a>
                </div>
                <div class="flex flex-col rounded-xl bg-white/10 py-4">
                    <a href="?page=hewan_keluar" class="flex flex-row items-center gap-4 px-4 py-3 hover:bg-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package-export">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                            <path d="M12 12l8 -4.5" />
                            <path d="M12 12v9" />
                            <path d="M12 12l-8 -4.5" />
                            <path d="M15 18h7" />
                            <path d="M19 15l3 3l-3 3" />
                        </svg>
                        Input Hewan Keluar
                    </a>
                    <?php if ($role == 'admin'): ?>
                        <a href="?page=hewan_masuk" class="flex flex-row items-center gap-4 px-4 py-3 hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package-import">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                <path d="M12 12l8 -4.5" />
                                <path d="M12 12v9" />
                                <path d="M12 12l-8 -4.5" />
                                <path d="M22 18h-7" />
                                <path d="M18 15l-3 3l3 3" />
                            </svg>
                            Input Hewan Masuk
                        </a>
                    <?php endif; ?>
                    <a href="?page=laporan_penjualan" class="flex flex-row items-center gap-4 px-4 py-3 hover:bg-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report-search">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                            <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2" />
                            <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                            <path d="M8 11h4" />
                            <path d="M8 15h3" />
                            <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" />
                            <path d="M18.5 19.5l2.5 2.5" />
                        </svg>
                        Laporan Penjualan
                    </a>
                </div>
                <?php if ($role == 'admin'): ?>
                    <div class="flex flex-col rounded-xl bg-white/10 py-4">
                        <a href="?page=kelola_supplier" class="flex flex-row items-center gap-4 px-4 py-3 hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-truck">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                            </svg>
                            Master Supplier
                        </a>
                    </div>
                <?php endif; ?>
                <div class="flex flex-col rounded-xl bg-white/10 py-4">
                    <!-- <?php if ($role == 'admin'): ?>
                        <a href="?page=kelola_user" class="flex flex-row items-center gap-4 px-4 py-3 hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                            Kelola User
                            <?php endif; ?> -->
                    </a>
                    <a href="?page=profile" class="flex flex-row items-center gap-4 px-4 py-3 hover:bg-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                        </svg>
                        Profile
                    </a>
                    <form action="" method="post" class="p-0 m-0 w-full flex">
                        <button type="submit" name="logout" class="flex flex-row items-center gap-4 px-4 py-3 hover:bg-white/10 w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M9 12h12l-3 -3" />
                                <path d="M18 15l3 -3" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $routes = [];
        if (isset($_GET['page'])) {
            $routes = $data[$_GET['page']];
        }
        ?>
        <div class="flex-1 flex flex-col text-slate-600 overflow-auto">
            <div class="flex flex-row items-center justify-between gap-6 px-6 py-4 border-b border-b-gray-300">
                <span class="font-semibold text-xl"><?= $routes['title'] ?? 'Stock Hewan'; ?></span>
                <div class="flex flex-row items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-sm">
                            <?= $name; ?>
                        </span>
                        <span class="text-xs text-slate-500"><?= $role; ?></span>
                    </div>
                </div>
            </div>
            <div class="p-6 flex flex-col gap-6">
                <?php
                if (isset($_GET['page'])) {
                    $routes = $data[$_GET['page']];
                    if (in_array($role, $routes['role'])) {
                        include "report/" . $routes['link'];
                    } else {
                        echo "Tidak ada akses";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>