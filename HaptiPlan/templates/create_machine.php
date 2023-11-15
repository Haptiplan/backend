<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/haptiplan-backend/HaptiPlan/machine" method="post">
        <div class="mb-3">
            <label for="" class="form-label">Maschine Nr:</label>
            <input type="text" class="form-control" id="machineNr" name="machineId" disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">create Machine</button>
    </form>

</body>

</html>