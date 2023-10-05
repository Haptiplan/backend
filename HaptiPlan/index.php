<?php
if (isset($_GET['page'])) {
    $requested_page = $_GET['page'];
} else {
    $requested_page = 'home';
}
// a better way would be to put this into an array, but I think a switch is easier to read for this example
switch ($requested_page) {
    case "blog":
        include(__DIR__ . "/templates/blog.php");
        break;
    case "home":
        include(__DIR__ . "/templates/home.php");
        break;
    default:
        include(__DIR__ . "/templates/404.php");
}


