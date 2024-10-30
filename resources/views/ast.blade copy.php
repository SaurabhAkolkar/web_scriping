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

    <title>ast!</title>
</head>

<body>
    
    <table class="table table-bordered">
        <tbody>
          
            @foreach ($last_page as $k => $item)
                @if ($item["no"] == "1")
                <tr>
                    <td colspan="12">Race : </td>
                </tr>
                <tr>
                    <th>Horse Name</th>
                    <th>PPHN</th>
                    <th>PPFR</th>
                    <th>PPOR</th>
                    <th></th>
                    <th style="text-align: right;">PHN</th>
                    <th>PFR</th>
                    <th>POR</th>
                    <th></th>
                    <th>LHN</th>
                    <th>LOR</th>
                    <th></th>
                    <th>form</th>
                    <th></th>
                </tr>
                
                @endif
                @php
                    if(isset($item["pphn"])) {
                        $pphn = $item["pphn"];
                    } else {
                            $pphn = 0;
                    }
                    if(isset($item["ppor"])) {
                        $ppor = $item["ppor"];
                    } else {
                            $ppor = 0;
                    }

                    if(isset($item["phn"])) {
                        $phn = $item["phn"];
                    } else {
                        $phn = 0;
                    }
                    if(isset($item["por"])) {
                        $por = $item["por"];
                    } else {
                        $por = 0;
                    }


                @endphp
                <tr>
                    <td style="width: 8.33%">{{ $item["hourse_name"] }}</td>

                    <td style="text-align: center;font-size: 2em;width: 4.33%">{{ $pphn }}</td>
                    <td style="text-align: center;font-size: 2em;width: 4.33%">
                        @if (isset($item["ppfr"]))
                        {{ $item["ppfr"] }}
                        @else
                            NA
                        @endif
                    </td>
                    <td style="width: 4.33%"> {{ $ppor }} </td>
                    <td style="background-color: rgb(241, 228, 37);width: 4.33%">
                        <b style="color: black" ><h2>{{ (intval($pphn)-1) + intval(substr($ppor,(strpos($ppor,"Rtg")+3),3)) }}</h2></b>
                    </td>
                    <td style="text-align: right;font-size: 2em;width: 4.33%">{{ $phn }}</td>
                    <td style="text-align: center;font-size: 2em;width: 4.33%">
                        @if (isset($item["pfr"]))
                        {{ $item["pfr"] }}
                        @else
                            NA
                        @endif
                    </td>
                    <td style="width: 4.33%"> {{ $por }} </td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 4.33%">
                        <b style="color: black" ><h2>
                            {{ (intval($phn)-1) + intval(substr($por,(strpos($por,"Rtg")+3),3)) }}</h2></b>
                    </td>
                    <td style="text-align: center;font-size: 2em;width: 4.33%"><b>{{ $item["no"] }}</b> </td>
                    <td style="width: 4.33%">{{ $item["rt"] }}</td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 4.33%">
                    
                        <b style="color: black" ><h2>{{ ($item["no"]-1) + $item["rt"] }}</h2></b>
                    </td>
                    <td style="width: 8.33%">{{ $item["form"] }}</td>
                    <td style="width: 10.33%"></td>
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
