<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine List</title>
</head>
<body>
    <h1>Machine List</h1>

    <ul>
        @foreach($machines as $machine)
            <li>{{ $machine->machine_name }}</li>
        @endforeach
    </ul>
</body>
</html>
