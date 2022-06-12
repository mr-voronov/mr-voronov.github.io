<?php
// create page template

$action = 'create';

if ( isset($_POST['submit']) ) {
    $cid = $_POST['cid']; 
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $descr_min = trim($_POST['descr_min']);
    $description = trim($_POST['description']);
    
    move_uploaded_file($_FILES['image']['tmp_name'], '/static/images/' . $_FILES['image']['name']);

    $image = $_FILES['image']['name'];

    $create = createArticle($cid, $title, $url, $descr_min, $description, $image);

    if ($create) {
        header('Location: /admin');
    } else {
        setcookie('alert', 'create error', time()+60*1);
    }

    if ( isset($_COOKIE['alert']) ) {
        $alert = $_COOKIE['alert'];

        setcookie('alert', 'create error', time()-60*1);
        unset($_COOKIE['alert']);

        echo $alert;
    }
} else {
    $result = array(
        "cid" => "", 
        "title" => "",
        "url" => "",
        "descr_min" => "",
        "description" => "",
        "image" => "",
    );
}

?>

<main>
    <h1>Create</h1>
    <?php require_once "_form.php"; ?>
</main>
