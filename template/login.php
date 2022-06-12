<?php
// login page template

if ( isset($_POST['submit']) ) {
    $user = login($_POST['login'], $_POST['password']);

    if ($user) {
        $user = $user[0];
        $hash = md5( generateCode(10) );
        $ip = null;

        if (!empty($_POST['ip'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        updateUser($user['id'], $hash, $ip);
        setcookie('id', $user['id'], time()+60*60*24*30, "/");
        setcookie('hash', $hash, time()+60*60*24*30, "/");

        header('Location: /admin');
        exit();
    } else {
        echo 'Wrong login or password';
    }
}

?>

<main>
    <h2>Login</h2>
    <form method="POST" class="form--login">
        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" value="admin-1" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="password" required>
        </div>
        <!-- temporary disabled feature -->
        <div style="display: none">
            <label for="ip">Assign to IP:</label>
            <input type="checkbox" id="ip" name="ip">
        </div>
        <div>
            <input type="submit" name="submit" value="login">
        </div>
    </form>
</main>
