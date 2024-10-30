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

    <title>india!</title>
</head>

<body>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>LHN</th>
                <th>Length</th>
                <th>POR</th>
                <th>POR</th>
            </tr>
            @foreach ($last_page as $k => $item)
                <tr>
                    <td style="text-align: center;font-size: 2em;width: 4.33%"><b>{{ $item['no'] }}</b> </td>
                    
                    <td style="width: 10.33%">{{ $item['l1'] }}</td>
                    <td style="width: 8.33%">
                        @if(isset($item['phn1']) && isset($item['prtg1']))
                            {{ ($item['phn1'] - 1) + $item['prtg1'] }}
                        @endif
                    </td>
                    <td style="width: 4.33%"></td>
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
