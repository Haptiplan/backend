<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/Haptiplan-Frontend/HaptiPlan/machine" method="post">
        <label for="id">ID</label>
        <input type="text" name="id">
        <br>
        <label for="name">Name</label>
        <input type="text" name="name">
        <br>
        <label for="kapazitaet">Kapazität</label>
        <input type="text" name="kapazitaet">
        <br>
        <label for="preis">Preis</label>
        <input type="text" name="preis">
        <br>
        <label for="laufzeit">Laufzeit</label>
        <input type="text" name="laufzeit">
        <br>
        <label for="periode">Periode</label>
        <input type="text" name="periode">
        <br>
        <input type="submit" name="submit" value ="create machine">
    </form>
</body>
</html>