<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('machines.store') }}" method="POST">
         @csrf
        <div>
            <label for="machine_name">Machine name</label>
            <input type="text" name="machine_name" id="machine_name">
        </div>
        <button type="submit">create machine</button>
    </form>
</body>
</html>