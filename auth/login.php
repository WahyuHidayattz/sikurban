<?php

include "../koneksi.php";
session_start();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql    = "SELECT * FROM users where username='$username'";
    $data   = mysqli_query($koneksi, $sql);
    if(mysqli_affected_rows($koneksi)>0){
        $data_password = '';
        $users = [];
        while($d = mysqli_fetch_assoc($data)){
            $data_password = $d['password'];
            $users [] = $d;
        }
        $users = $users[0];
        if($data_password == $password){
            $_SESSION['auth'] = [
                'message' => 'Login berhasil, silahkan kelola barang masuk dan keluar.',
                'user' => $users
            ];
            header('Location: ../index.php?page=dashboard');
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | StockBarang</title>
    <link rel="stylesheet" href="../assets/app.css">
</head>

<body>
    <div class="flex items-center justify-center flex-col w-full min-h-screen bg-gray-100">
        <div class="max-w-lg w-full bg-white rounded-lg shadow-sm p-6 flex flex-col gap-4 text-slate-600">
            <h1 class="font-bold text-2xl text-black mx-auto flex flex-row items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                    <path d="M12 12l8 -4.5" />
                    <path d="M12 12l0 9" />
                    <path d="M12 12l-8 -4.5" />
                    <path d="M16 5.25l-8 4.5" />
                </svg>
                StockBarang
            </h1>
            <span class="text-xl font-semibold">Login</span>
            <form action="" method="post" class="p-0 m-0 flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <span>Username</span>
                    <input type="text" name="username" id="username" class="bg-white rounded-md border border-gray-300 px-3 py-2 focus:border focus:border-blue-500 focus:ring focus:ring-blue-300 outline-none transition duration-300">
                </div>
                <div class="flex flex-col gap-2">
                    <span>Password</span>
                    <input type="password" name="password" id="password" class="bg-white rounded-md border border-gray-300 px-3 py-2 focus:border focus:border-blue-500 focus:ring focus:ring-blue-300 outline-none transition duration-300">
                </div>
                <div class="flex flex-row items-center justify-end">
                    <button type="submit" name="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-400 transition duration-300">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>