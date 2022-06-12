<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stage2_project</title>

    <!-- external css -->
    <link rel="stylesheet" href="/static/css/reset.css">

    <!-- custom css -->
    <link rel="stylesheet" href="/static/css/style.css">
    <link rel="stylesheet" href="/static/css/header.css">
    <link rel="stylesheet" href="/static/css/article.css">
    <link rel="stylesheet" href="/static/css/form.css">
    <link rel="stylesheet" href="/static/css/categories.css">
    <link rel="stylesheet" href="/static/css/footer.css">
    
</head>
<body>
    <div class="root-grid">

    <?php

    // config and core files
    require_once 'config/db.php';
    require_once 'core/function_db.php';
    require_once 'core/function.php';

    // routing logic
    $conn = connect();
    $route = $_GET['route'];
    $route = explodeURL($route);

    switch ($route) {
        case ($route[0] == ''):
            $query = 'SELECT * FROM info';
            $result = select($query);

            require_once 'layout/header.php';
            require_once 'template/main.php';

            break;
        case ($route[0] == 'article' AND empty($route[1])):
            $result = getCategoriesList();

            require_once 'layout/header.php';
            require_once 'template/categoriesList.php';

            break;
        case ($route[0] == 'article' AND isset($route[1])):
            $url = $route[1];
            $result = getArticle($url);

            require_once 'layout/header.php';
            require_once 'template/article.php';

            break;
        case ($route[0] == 'categories' AND empty($route[1])):
            $result = getCategoriesList();

            require_once 'layout/header.php';
            require_once 'template/categoriesList.php';

            break;
        case ($route[0] == 'categories' AND isset($route[1])):
            $url = $route[1];
            $category = getCategory($url);
            $result = getCategoryArticles($category['id']);

            require_once 'layout/header.php';
            require_once 'template/category.php';

            break;
        case ($route[0] == 'register'):
            require_once 'layout/header.php';
            require_once 'template/register.php';

            break;
        case ($route[0] == 'login'):
            require_once 'layout/header.php';
            require_once 'template/login.php';

            break;
        case ($route[0] == 'admin' AND $route[1] == 'delete' AND isset($route[2])):
            if ( getUser() ) {
                $query = "DELETE FROM info WHERE id=" . $route[2];

                echo $query;
                execQuery($query);

                // special header for admin
                require_once 'layout/headerAdmin.php';

                header('Location: /admin');
                exit();
            }

            header('Location: /login');

            break;
        case ($route[0] == 'admin' AND $route[1] == 'create'):
            if ( getUser() ) {
                $query = "SELECT id, title FROM categories";

                $categories = select($query);

                // special header for admin
                require_once 'layout/headerAdmin.php';
                require_once 'template/create.php';
            } else {
                header('Location: /login');
            }

            break;
        case ($route[0] == 'admin' AND $route[1] == 'update' AND isset($route[2])):
            if ( getUser() ) {
                $query = "SELECT id, title FROM categories";
                $categories = select($query);

                $query = "SELECT * FROM info WHERE id=" . $route[2];
                $result = select($query)[0];

                // special header for admin
                require_once 'layout/headerAdmin.php';
                require_once 'template/update.php';
            } else {
                header('Location: /login');
            }

            break;
        case ($route[0] == 'admin'):
            $query = "SELECT * FROM info";
            $result = select($query);
            
            // special header for admin
            require_once 'layout/headerAdmin.php';
            require_once 'template/admin.php';

            break;
        case ($route[0] == 'logout'):
            require_once 'template/logout.php';
            
            break;
        default:
            require_once 'template/404.php';
    }

    // footer is the same in all the cases
    require_once 'layout/footer.php';

    ?>

    </div>
</body>
</html>