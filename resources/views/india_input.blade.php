<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>att</title>
</head>

<body>

    <div class="container mt-5">

        <form action="/jay-shree-ram" method="POST">
            @csrf
          
            <div class="form-group">
                <label for="race_id">Race No</label>
                <input type="text" class="form-control" id="race_id" name="race_id">
            </div>

            <div class="form-group">
                <label for="center">Center</label>
                <input type="text" class="form-control" id="center" name="center">
            </div>

            <div class="form-group">
                <label for="start">Start</label>
                <input type="text" class="form-control" id="start" name="start">
            </div>
            <div class="form-group">
                <label for="End">End</label>
                <input type="text" class="form-control" id="end" name="end">
            </div>
           
            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>

    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
