<?php

function explodeURL($url) {
    return explode('/', $url);
}

function getArticle($url) {
    $query = "SELECT * FROM info WHERE url='".$url."'";

    return select($query);
}

function getCategoriesList() {
    $query = "SELECT * FROM categories";

    return select($query);
}

function getCategory($url) {
    $query = "SELECT * FROM categories WHERE url='".$url."'";

    return select($query)[0];
}

function getCategoryArticles($cid) {
    $query = "SELECT * FROM info WHERE cid=".$cid;

    return select($query);
}

function isLoginExist($login) {
    $query = "SELECT id FROM users WHERE login='".$login."'";

    $result = select($query);

    if ( count($result) === 0 ) return false;
    return true;
}

function createUser($login, $password) {
    $login = trim($login);
    $password = md5( md5 ( trim($password) ) );

    $query = "INSERT INTO users SET login='".$login."', password='".$password."'";

    return execQuery($query);
}

function login($login, $password) {
    $login = trim($login);
    $password = md5( md5 ( trim($password) ) );

    $query = "SELECT * FROM users WHERE login='".$login."' AND password='".$password."'";

    $result = select($query);

    if ( count($result) === 0) return false;
    return $result;
}

function generateCode($lenth = 8) {
    $chars = 'qwertyuiop[]QWERTYUIOP{}1234567890';
    $code = '';
    $codLen = strlen($chars) - 1;

    while (strlen($code) < $lenth) {
        $code .= $chars[mt_rand(0, $codLen)];
    }

    return $code;
}

function updateUser($id, $hash, $ip) {
    $query = "UPDATE users SET hash='".$hash."' WHERE id=".$id;

    return execQuery($query);
}

function getUser() {
    if ( isset($_COOKIE['id']) AND isset($_COOKIE['hash']) ) {

        $query = "SELECT id, login, hash FROM users WHERE id=" . intval($_COOKIE['id']) . " LIMIT 1";

        $user = select($query);

        if ( count($user) === 0) {
            return false;
        } else {
            $user = $user[0];

            if ($user['hash'] !== $_COOKIE['hash']) {
                clearCookies();
                return false;
            }

            $_GET['login'] = $user['login'];

            return true;
        }

    } else {
        clearCookies();

        return false;
    }
}

function clearCookies() {
    setcookie('id', '', time()-60*60*24*30, "/");
    setcookie('hash', '', time()-60*60*24*30, "/", null, true);

    unset($_GET['login']);
}

function createArticle($cid, $title, $url, $descr_min, $description, $image) {
    $query = "INSERT INTO `info`(`cid`, `title`, `url`, `descr_min`, `description`, `image`) VALUES ('".$cid."', '".$title."', '".$url."', '".$descr_min."', '".$description."', '".$image."')";

    return execQuery($query);
}

function updateArticle($id, $cid, $title, $url, $descr_min, $description, $image) {
    $query = "UPDATE `info` SET `cid`='".$cid."',`title`='".$title."',`url`='".$url."',`descr_min`='".$descr_min."',`description`='".$description."',`image`='".$image."' WHERE `id`='".$id."'";

    return execQuery($query);
}

function logout() {
    clearCookies();

    header('Location: /');
    exit();
}

?>