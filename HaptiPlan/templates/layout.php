<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
   <title><?= $title ?></title>
   <link href="style.css" rel="stylesheet" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <scrip src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
      </script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
      <style>
         .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
         }
      </style>
</head>

<body>

   <?php include_once('header.php'); ?>

   <?= $content ?>
   <div id="demo"></div>

   <?php include_once('footer.php'); ?>

   <script>
      /*
      function createMaschine() {
         let request = new XMLHttpRequest()
         request.open('POST', 'http://localhost/haptiplan-Frontend/data/data.json', true)
         let bodyParams = `{
                  "userId": 1,
                  "id": 1,
                  "title": "Maschine 6",
                  "body": "test"
               }`
         request.send(bodyParams)
         request.onload = function() {
            if (this.status >= 200 && this.status < 300) {
               maschine = request.response
               console.log(maschine)
            }
         }
      }

      function getMaschine() {
         fetch('http://localhost/haptiplan-Frontend/data/data.json')
            .then(response => response.json())
            .then(data => console.log(data))
      }

      function addMaschine() {
         const fs = require('fs');
         const data = fs.readFileSync('data.json');
         const jsonData = JSON.parse(data);
         jsonData.push({
            name: 'James',
            email: 'james@example.com',
         });
         fs.writeFileSync('data.json', JSON.stringify(jsonData));
      }
      */

      //getMaschine();
      //addMaschine();
   </script>
</body>

</html>