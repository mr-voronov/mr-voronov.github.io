<?php
// register page template

if ( isset($_POST['submit']) ) {
    $errors = [];

    if ( strlen($_POST['login']) < 4 OR strlen($_POST['login'] ) > 10) {
        $errors[] = "Login must NOT be < 4 or > 10";
    }

    if ( isLoginExist($_POST['login']) ) {
        $errors[] = "Login is already being used";
    }

    if ( count($errors) == 0 ) {
        createUser($_POST['login'], $_POST['password']);

        header('Location: /login');
        exit();
    } else {
        $out = '';

        $out .= '<h4>Login errors</h4>';

        foreach ($errors as $key => $value) {
            $out .= $value . '<br>';
        }

        echo $out;
    }
}

?>

<main>
    <h2>Register</h2>
    <form method="POST" class="form--register">
        <div>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" value="admin-1" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="password" required>
        </div>
        <div>
            <input type="submit" name="submit" value="register">
        </div>
    </form>
</main>
