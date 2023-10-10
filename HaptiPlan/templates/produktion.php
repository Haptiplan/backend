<?php $title = "Unternehmsplanspiel"; ?>

<?php ob_start(); 

 //$path = '../data/test.json';
 //$jsonString = file_get_contents($path);
 //$json_data = json_decode($jsonString);
 
 //var_dump($json_data);
 echo 'Produktion';

 $content = ob_get_clean(); ?>

<?php require('layout.php') ?>