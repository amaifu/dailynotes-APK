<?php
    session_start();
    require_once 'api/conn.php';

    if(isset($_SESSION['login'])) {
        header('Location: index.php');
    }

    if(isset($_POST['username']) && isset($_POST['password'])) {

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if(mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if(password_verify($password, $user['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $user['id_user'];

                var_dump('Login Success!');
                var_dump($_SESSION['id_user']);
                header('Location: index.php');
            } else {
                var_dump('Wrong password!');
            }
        } else {
            var_dump('Account not found!');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Log in to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="" method="POST">
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Username</label>
                <div class="mt-2">
                <input id="username" name="username" type="text" autocomplete="username" required class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                <div class="text-sm">
                    <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                </div>
                </div>
                <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                </div>
            </div>

            <div>
                <button type="submit" name="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log in</button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>