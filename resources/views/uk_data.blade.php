<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <title>UK!</title>
</head>

<body>

    <table class="table table-bordered" style="page-break-after: always;">
        <thead>
            <tr>
                <th>#</th>
                <th>Horse Name</th>
                <th>form</th>
                <th>ptp</th>
                <th>hurdle</th>
                <th>rules_races</th>
                <th>chase</th>
                <th>nhf</th>
                <th>all_wheater_races</th>
                <th>flat_races</th>
           
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            
                <tr>
                    <td>{{ $item["no"] }}</td>
                    <td>{{ $item["horse_name"] }}</td>
                    <td>{{ $item["form"] }}</td>
                    <td>{{ $item["ptp"] }}</td>
                    <td>{{ $item["hurdle"] }}</td>
                    <td>{{ $item["rules_races"] }}</td>
                    <td>{{ $item["chase"] }}</td>
                    <td>{{ $item["nhf"] }}</td>
                    <td>{{ $item["all_wheater_races"] }}</td>
                    <td>{{ $item["flat_races"] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
</body>

</html>
