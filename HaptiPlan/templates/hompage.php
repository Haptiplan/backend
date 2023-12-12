<?php $title = "JADE HS Project"; ?>

<?php ob_start();  ?>

<?php

 $path = '../data/test.json';
 $jsonString = file_get_contents($path);
 $json_data = json_decode($jsonString);
 
 var_dump($json_data);


 ?>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>