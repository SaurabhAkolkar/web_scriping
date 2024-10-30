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

    <title>Web Scriping!</title>
</head>

<body>
    @php
        $race_no = 0;   
    @endphp
    @foreach ($main as $key => $sub)
        <h1>{{ ucfirst($key) }} </h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Horse</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>P</th>
                    <th>C</th>
                    <th>F</th>
                    <th>1</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sub as $k => $item)
                    <tr>
                        <td>{{ ++$k }}</td>
                        @foreach ($item as $key => $d)

                            @if ($key == 6)
                                @continue
                            @endif
                            <td>{!! $d !!}</td>                           
                        @endforeach
                        <td>{{ $race_arr[$race_no][$k] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
         $race_no++   
        @endphp
    @endforeach

    <table class="table table-bordered">

        <tbody>

            @foreach ($race_arr as $key => $race)
                <tr>
                    <th>{{ $key }}</th>
                    @foreach ($race as $ja)
                        <td>{{ $ja }}</td>
                    @endforeach
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
