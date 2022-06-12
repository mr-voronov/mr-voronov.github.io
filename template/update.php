<?php
// update page template

$action = 'update';

if ( isset($_POST['submit']) ) {
    $id = $route[2];
    $cid = $_POST['cid']; 
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $descr_min = trim($_POST['descr_min']);
    $description = trim($_POST['description']);

    if ( isset($_FILES['image']['tmp_name']) AND $_FILES['image']['tmp_name'] !== '') {
        move_uploaded_file($_FILES['image']['tmp_name'], '/static/images/' . $_FILES['image']['name']);

        $image = $_FILES['image']['name'];
    } else {
        $image = $result['image'];
    }

    $update = updateArticle($id, $cid, $title, $url, $descr_min, $description, $image);

    if ($update) {
        setcookie('alert', 'article has been updated', time()+60*1);
        header('Location: ' . $_SERVER['REQUEST_URI']);
    } else {
        setcookie('alert', 'update error', time()+60*1);
        header('Location: ' . $_SERVER['REQUEST_URI']);
    }
}

if ( isset($_COOKIE['alert']) ) {
    $alert = $_COOKIE['alert'];

    setcookie('alert', '', time()-60*1);
    unset($_COOKIE['alert']);

    echo $alert;
}

?>

<main>
    <h1>Update</h1>
    <?php require_once "_form.php"; ?>
</main>
