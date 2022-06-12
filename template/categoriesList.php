<?php
// categoriesList page template

echo '';

foreach ($result as $key => $value) {
    $out .= '<section>';
    $out .= '<h3>' . $value['title'] . '</h3>';
    $out .= '<p>' . $value['descr_min'] . '</p>';
    $out .= '<div><a href="/categories/' . $value['url'] . '">See all articles in the category</a></div>';
    $out .= '</section>';
}

?>

<article class="categories-list-grid">
    <h2>Categories</h2>
    <?php echo $out; ?>
</article>