<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title><?= $title ?></title>
      <link href="style.css" rel="stylesheet" /> 
   </head>

   <body>
      
      <?php include_once('header.php'); ?>
     
      <?= $content ?>

      <?php include_once('footer.php'); ?>
     
   </body>
</html>