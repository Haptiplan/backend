<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/Haptiplan-Frontend/HaptiPlan/machine/update" method="post">
        <div class="mb-3">
            <label for="" class="form-label">Maschine Nr:</label>
            <input type="text" class="form-control" id="machineNr" name="machineNr">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Beschreibung</label>
            <input type="text" class="form-control" id="beschreibung" name="beschreibung">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

</body>

</html>