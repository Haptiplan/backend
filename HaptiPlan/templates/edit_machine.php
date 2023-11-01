<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/Haptiplan-Frontend/HaptiPlan/machine/update" method="post">
    <label for="id">ID</label>
        <input type="text" name="id">
        <br>
        <label for="name">Name</label>
        <input type="text" name="name">
        <br>
        <label for="capacity">Capacity</label>
        <input type="text" name="capacity">
        <br>
        <label for="price">Price</label>
        <input type="text" name="price">
        <br>
        <label for="duration">Duration</label>
        <input type="text" name="duration">
        <br>
        <label for="period">Periode</label>
        <input type="text" name="period">
        <br>
        <input type="submit" name="submit" value ="edit machine">
    </form>
</body>

</html>