<?php
// article page template

$out = '';

foreach ($result as $key => $value) {
    $out .= '<section class="article-item">';
    $out .= '<h3 class="article-item__title">' . $value['title'] . '</h3>';
    $out .= '<img src="/static/images/' . $value['image'] . '" class="article-item__img alt="no picture is available">';
    $out .= '<p class="article-item__descr-max">' . $value['description'] . '</p>';
    $out .= '</section>';
}

?>

<main>
    <h1>Full article</h1>
    <article class="article-grid">
        <?php echo $out; ?>
    </article>
</main>