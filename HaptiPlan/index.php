<?php

require_once('src/controllers/homepage.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
    if ($_GET['action'] === 'test') {
        # code...
      
    }else {
        echo 'Error 404: the page does not exist!';
    }
}else {
    homepage();
}