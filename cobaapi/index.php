<?php
    session_start();

    if(!isset($_SESSION['id_user'])) {
        header('Location: login.php');
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
    <nav class="fixed bg-gray-500 w-screen h-20 flex items-center justify-between z-50">
        <div class="m-6">
            <a class="bg-green-500 p-3 w-fit text-white fs-bold rounded" href="note.php">Tambah Catatan</a>
        </div>
        <div class="m-6">
            <button type="button" name="logout" class="bg-red-500 p-3 w-fit text-white fs-bold rounded" href="note.php">log out</button>
        </div>
    </nav>

    <main clas s="w-screen h-screen">
        <div id="main-index" class="text-black p-5 container mx-auto grid gap-y-5 pt-[6em]">
            <!-- Notes here --> 
        </div>
    </main>

    <!-- Form Update -->
     <div class="fixed top-0 left-0 bg-[rgba(0,0,0,0.5)] w-screen h-screen z-40 grid place-items-center hidden">
        <form id="form-update-note" action="api/updatenote.php" method="POST" class="w-fit h-fit bg-white p-5 rounded shadow-xl">
                <div class="col-span-full">
                    <label for="note" class="block text-sm/6 font-medium text-gray-900">Note</label>
                    <div class="mt-2">
                        <textarea id="note" name="note" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6 p-3"></textarea>
                    </div>
                </div>
        
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button id="btn-cancel-update" type="button" class="text-sm/6 font-semibold text-gray-900">Batal</button>
                    <button id="btn-update-note" type="submit" name="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan</button>
                </div>
            </form>
     </div>

<script src="js/index.js"></script>
</body>
</html> 