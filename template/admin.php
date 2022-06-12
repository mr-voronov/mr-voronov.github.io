<?php
// admin page template

if (!getUser()) {
    header('Location: /login');
}

$out = '';

foreach ($result as $key => $value) {
    $out .= '<section class="article-item">';
    $out .= '<h3 class="article-item__title">' . $value['title'] . '</h3>';
    $out .= '<img src="/static/images/' . $value['image'] . '" class="article-item__img alt="no picture is available">';
    $out .= '<div class="article-item__action">';
    $out .= '<a href="/admin/delete/' . $value['id'] . '" onclick="return confirm(\'Are you sure to DELETE?\')">Delete</a>';
    $out .= '<a href="/admin/update/' . $value['id'] . '" onclick="return confirm(\'Are you sure to UPDATE?\')">Update</a>';
    $out .= '</div>';
    $out .= '</section>';
}

?>

<main>
    <h1>Admin panel</h1>
    <article class="article-grid">
        <?php echo $out; ?>
    </article>
</main>