<?php
// main page template

$out = '';

foreach ($result as $key => $value) {
    $out .= '<section class="article-item">';
    $out .= '<h3 class="article-item__title">' . $value['title'] . '</h3>';
    $out .= '<p class="article-item__descr-min">' . $value['descr_min'] . '</p>';
    $out .= '<img src="/static/images/' . $value['image'] . '" class="article-item__img alt="no picture is available">';
    $out .= '<div class="article-item__action">';
    $out .= '<a href="/article/' . $value['url'] . '">Read full article</a>';
    $out .= '</div>';
    $out .= '</section>';
}

?>

<main>
    <h1>Main</h1>
    <article class="article-grid">
        <?php echo $out; ?>
    </article>
</main>
