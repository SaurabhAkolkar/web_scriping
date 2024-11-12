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
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            @foreach ($last_page as $k => $item)
                @if ($item['no'] == '1')
                    <tr>
                        <td colspan="12">Race : </td>
                    </tr>
                    <tr>
                        <th>Horse Name</th>
                        <th>##</th>
                        <th></th>
                        <th>PPHN</th>
                        <th>PPFR</th>
                        <th>PPOR</th>
                        <th>**</th>
                        <th></th>
                        <th style="text-align: right;">PHN</th>
                        <th>PFR</th>
                        <th>POR</th>
                        <th>LHN</th>
                        <th>LOR</th>
                        <th></th>
                        <th>form</th>
                        <th></th>
                    </tr>
                @endif
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr1']['a4'])) {
                        $high_weight1 = explode('kg', $item['arr1']['a4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($pphn) - 1 + intval(substr($ppor, strpos($ppor, 'Rtg') + 3, 3));
                    if ($pphn == 1) {
                        $yellow1_pphn = $yellow1;
                    } else {
                        $yellow1_pphn = $yellow1 - $pphn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_pphn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_pphn - abs($newrt_hw1);
                        $sing1 = 'Demosition';
                    } else {
                        $a1 = $yellow1_pphn + abs($newrt_hw1);
                        $sing1 = 'Promosition';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr1']['a3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr1']['a2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }
                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    try {
                        $dddd = $item['arr2'];
                        $is_true = true;
                    } catch (\Throwable $th) {
                        $is_true = false;
                        $item['arr2'] = [];
                    }

                @endphp
                <tr>
                    <td style="width: 8.33%">{{ $item['hourse_name'] }}</td>
                    <td style="width: 50.33%">
                        @if (count($item['arr1']) < 0)
                            {{ $item['arr1']['a1'][0] }} {{ $item['arr1']['a1'][1] }}
                            {{ explode('kg', $item['arr1']['a1'][2])[0] }} <br>
                            {{ $item['arr1']['a2'][0] }} {{ $item['arr1']['a2'][1] }}
                            {{ $third_position_w1 }} <br>
                            {{ $item['arr1']['a3'][0] }} {{ $item['arr1']['a3'][1] }}
                            {{ $position_w1 }} <br>
                        @endif
                        @isset($item['arr1']['a4'])
                            <h5 style="color: green">
                                {{ $item['arr1']['a4'][0] }} {{ $item['arr1']['a4'][1] }} {{ $high_weight1 }}
                            </h5>
                        @endisset
                        <h4 style="color: red"><b>{{ $new_rt }} - {{ $high_weight1 }} </b></h4>
                        <h4 style="color: royalblue"><b>{{ $yellow1_pphn }} {{ $newrt_hw1 }}</b></h4>
                        <h4 style="color: rgb(225, 110, 65)"><b>{{ $a1 }} {{ $a3 }}</b></h4>
                        <h4 style="color: green"><b>{{ $a5 }}</b></h4>
                        <h4 style="color: red"><b>{{ $sing1 }}</b></h4>
                    </td>
                    <td style="background-color: rgb(241, 228, 37);width: 4.33%">
                        <b style="color: black">
                            <h2>{{ $yellow1 }}</h2>
                        </b>
                    </td>
                    <td style="text-align: center;font-size: 2em;width: 4.33%">{{ $pphn }}</td>
                    <td style="text-align: center;font-size: 2em;width: 4.33%">
                        @if (isset($item['ppfr']))
                            {{ $item['ppfr'] }}
                        @else
                            NA
                        @endif
                    </td>
                    <td style="width: 4.33%"> {{ $ppor }} </td>
                    <td style="width: 100%">
                        @if ($is_true)
                            {{ $item['arr2']['b1'][0] }} {{ $item['arr2']['b1'][1] }}
                            {{ explode('kg', $item['arr2']['b1'][2])[0] }} <br>

                            {{ $item['arr2']['b2'][0] ?? 0 }} {{ $item['arr2']['b2'][1] ?? 0 }}
                            {{ $third_position_w2 }} <br>
                            {{ $item['arr2']['b3'][0] ?? 0 }} {{ $item['arr2']['b3'][1] ?? 0 }}
                            {{ $position_w2 }} <br>
                        @endif

                        @isset($item['arr2']['b4'])
                            <h5 style="color: green">{{ $item['arr2']['b4'][0] }} {{ $item['arr2']['b4'][1] }}
                                {{ $high_weight2 }} </h5>
                        @endisset
                        <h4 style="color: red"><b>{{ $new_rt }} - {{ $high_weight2 }} </b></h4>
                        <h4 style="color: royalblue"><b>{{ $yellow2_phn }} {{ $newrt_hw2 }}</b></h4>
                        <h4 style="color: rgb(225, 110, 65)"><b>{{ $a2 }} {{ $a4 }}</b></h4>
                        <h4 style="color: green"><b>{{ $a6 }}</b></h4>
                        <h4 style="color: red"><b>{{ $sing2 }}</b></h4>
                    </td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 4.33%">
                        <b style="color: black">
                            <h2>{{ $yellow2 }}</h2>
                        </b>
                    </td>
                    <td style="text-align: right;font-size: 2em;width: 4.33%">{{ $phn }}</td>

                    <td style="text-align: center;font-size: 2em;width: 4.33%">
                        @if (isset($item['pfr']))
                            {{ $item['pfr'] }}
                        @else
                            NA
                        @endif
                    </td>
                    <td style="width: 4.33%"> {{ $por }} </td>

                    <td style="text-align: center;font-size: 2em;width: 4.33%"><b>{{ $item['no'] }}</b> </td>
                    <td style="width: 4.33%">{{ $item['rt'] }}</td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 4.33%">
                        <b style="color: black">
                            <h2>{{ intval($item['no']) - 1 + intval($item['rt']) }}</h2>
                        </b>
                    </td>
                    <td style="width: 8.33%">{{ $item['form'] }}</td>
                    <td style="width: 10.33%"></td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <br><br> <br><br>
    <h1>Formula: 1 | {{ $new_rt }}</h1>
    <h1>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr1']['a4'])) {
                        $high_weight1 = explode('kg', $item['arr1']['a4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($pphn) - 1 + intval(substr($ppor, strpos($ppor, 'Rtg') + 3, 3));
                    if ($pphn == 1) {
                        $yellow1_pphn = $yellow1;
                    } else {
                        $yellow1_pphn = $yellow1 - $pphn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_pphn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_pphn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_pphn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    if ($item['arr1']) {
                        $position_w1 = explode('kg', $item['arr1']['a3'][2])[0];
                        $third_position_w1 = explode('kg', $item['arr1']['a2'][2])[0];
                        $first_position = explode('kg', $item['arr1']['a1'][2])[0];
                    } else {
                        $position_w1 = 0;
                        $third_position_w1 = 0;
                        $first_position = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                    }

                @endphp
                <tr>
                    <td style="width: 1%">{{ $first_position }}</td>
                    <td style="width: 1%">{{ $item['no'] }}</td>
                    <td style="width: 1%">{{ $high_weight1 }}</td>
                    <td style="width: 1%">{{ $third_position_w1 }}</td>
                    <td style="width: 1%;color: brown">
                        <h4><b>{{ $a5 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $high_weight1 - $first_position }}</td>
                    <td style="width: 1%">{{ $a5 - $third_position_w1 }}</td>
                    <td style="width: 1%;color: darkviolet">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $a5 + $z3 }}</td>
                    <td style="width: 1%">==</td>
                    <td style="width: 1%">{{ $high_weight1 }}</td>
                    <td style="width: 1%;color: darkviolet">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $third_position_w1 }}</td>
                    <td style="width: 1%">**</td>
                    <td style="width: 1%">{{ $z5 }}</td>
                    <td style="width: 1%">{{ $z4 }}</td>
                    <td style="width: 1%">{{ $z9 }}</td>
                    <td style="width: 1%">{{ $z8 }}</td>
                    <td style="width: 5%"></td>
                    <td style="width: 5%"></td>
                    <td style="width: 5%"></td>
                    <td style="font-size: 10px"> {{ $ppor }} </td>
                    <td style="width: 1%;color:yellow;background-color: rgb(241, 228, 37);">
                        <b style="color: black"> {{ intval($item['no']) - 1 + intval($item['rt']) }} </b>
                    </td>
                    <td style="width: 1%">{{ $sing1 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br><br><br>

    <h1>Formula: 2 | {{ $new_rt }} </h1>
    <h1>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</h1>

    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }
                    if (isset($item['arr1']['a4'])) {
                        $high_weight1 = explode('kg', $item['arr1']['a4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($pphn) - 1 + intval(substr($ppor, strpos($ppor, 'Rtg') + 3, 3));
                    if ($pphn == 1) {
                        $yellow1_pphn = $yellow1;
                    } else {
                        $yellow1_pphn = $yellow1 - $pphn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_pphn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_pphn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_pphn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    if ($item['arr1']) {
                        $position_w1 = isset($item['arr1']['a3'][2]) ? explode('kg', $item['arr1']['a3'][2])[0] : 0;
                        $third_position_w1 = explode('kg', $item['arr1']['a2'][2])[0];
                        $first_position = explode('kg', $item['arr1']['a1'][2])[0];
                    } else {
                        $position_w1 = 0;
                        $third_position_w1 = 0;
                        $first_position = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }
                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $a5 - $third_position_w1;
                    $z2 = $high_weight1 - $a5;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                    }

                @endphp
                <tr>
                    <td style="width: 1%">{{ $first_position }}</td>
                    <td style="width: 1%">{{ $item['no'] }}</td>
                    <td style="width: 1%">{{ $high_weight1 }}</td>
                    <td style="width: 1%">{{ $third_position_w1 }}</td>
                    <td style="width: 1%;color: brown">
                        <h4><b>{{ $a5 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $z1 }}</td>
                    <td style="width: 1%">{{ $z2 }}</td>
                    <td style="width: 1%;color: darkviolet">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $a5 + $z3 }}</td>
                    <td style="width: 1%">==</td>
                    <td style="width: 1%">{{ $high_weight1 }}</td>
                    <td style="width: 1%;color: darkviolet">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td>{{ $third_position_w1 }}</td>
                    <td style="width: 1%">**</td>
                    <td style="width: 1%">{{ $z5 }}</td>
                    <td style="width: 1%">{{ $z4 }}</td>
                    <td style="width: 1%">{{ $z9 }}</td>
                    <td style="width: 1%">{{ $z8 }}</td>
                    <td style="width: 5%"></td>
                    <td style="width: 5%"></td>
                    <td style="width: 5%"></td>
                    <td style="font-size: 10px"> {{ $ppor }} </td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 1%">
                        <b style="color: black"> {{ intval($item['no']) - 1 + intval($item['rt']) }}
                        </b>
                    </td>
                    <td style="width: 1%">{{ $sing1 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Formula: 3 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>

    <br><br> <br><br>

    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>1 (1 st)</td>
                <td>2</td>
                <td>3 <b>(T)</b> </td>
                <td>4 <b>(3rd)</b></td>
                <td>5 <b>(F)</b></td>
                <td>6</td>
                <td>7</td>
                <td>6</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>
                <td>19</td>
                <td>20</td>
                <td>21</td>
                <td>22</td>
                <td>23</td>
                <td>24</td>
                <td>25<b>(F)</b></td>
                <td>26<b>(D)</b></td>
                <td>27<b>(A)</b></td>
                <td>28</td>
                <td>29</td>
                <td>30</td>
                <td>31 <b>(3rd)</b></td>
                <td>32</td>
                <td>33</td>
                <td>34</td>
                <td>35</td>
                <td>36</td>
                <td>37</td>
                <td>38</td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                @endphp
                <tr>
                    <td style="width: 1%;">{{ $first_position }}</td>
                    <td style="width: 1%;">{{ $item['no'] }}</td>
                    <td style="width: 1%;">{{ $high_weight1 }}</td>
                    <td style="width: 1%;">{{ $third_position_w1 }}</td>
                    <td style="width: 1%;color: brown">
                        <h4><b>{{ $a5 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $high_weight1 - $first_position }}</td>
                    <td style="width: 1%">{{ $a5 - $third_position_w1 }}</td>
                    <td style="width: 1%; color: darkviolet">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $a5 + $z3 }}</td>
                    <td style="width: 1%">==</td>
                    <td style="width: 1%">{{ $high_weight1 }}</td>
                    <td style="width: 1%;color: darkviolet">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $third_position_w1 }}</td>
                    <td style="width: 1%">***</td>
                    <td style="width: 1%">{{ $z5 }}</td>
                    <td style="width: 1%">{{ $z4 }}</td>
                    <td style="width: 1%">{{ $s1 }}{{ $z9 }}</td>
                    <td style="width: 1%">{{ $s2 }}{{ $z8 }}</td>
                    <td style="width: 1%;color: orange">
                        <h4>{{ $s3 }}</h4>
                    </td>
                    <td style="width: 1%;color:violet">{{ $s4 }}</td>
                    <td style="width: 1%"></td>
                    <td style="font-size: 10px;width: 400px"> {{ $por }} </td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 1%">
                        <b style="color: black"> {{ intval($item['no']) - 1 + intval($item['rt']) }}
                        </b>
                    </td>
                    <td style="width: 1%">{{ $sing1 }}</td>
                    <td>
                        <h4><b>{{ $a5 }}</b></h4>
                    </td>
                    <td>
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%; color: rgb(0, 211, 63)">
                        <h4><b>{{ $a5 - $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%; color: rgb(0, 211, 63)">
                        <h4><b>{{ $s4 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $s4 - ($a5 - $z3) }}</td>
                    <td style="width: 500px"></td>
                    <td style="width: 1%">{{ $third_position_w1 }}</td>
                    <td> {{ $s4 }} </td>
                    <td style="width: 1%;">{{ $item['no'] }}</td>
                    <td>{{ intval($item['no']) - 1 + intval($item['rt']) - $new_rt }}</td>
                    <td style="width: 10%"></td>
                    <td style="width: 1%; color: rgb(0, 211, 63)">
                        <h4><b>{{ $s4 - $third_position_w1 }}</b></h4>
                    </td>

                    <td style="width: 1%">{{ $high_weight1 - $first_position }}</td>
                    <td style="width: 1%">{{ $a5 - $third_position_w1 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br><br><br>

    <h1>Formula: 4 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }
                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }
                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }
                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }
                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }
                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $a5 - $third_position_w1;
                    $z2 = $high_weight1 - $a5;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                    }

                @endphp
                <tr>
                    <td style="width: 1%;">{{ $first_position }}</td>
                    <td style="width: 1%;">{{ $item['no'] }}</td>
                    <td style="width: 1%;">{{ $high_weight1 }}</td>
                    <td style="width: 1%;">{{ $third_position_w1 }}</td>
                    <td style="width: 1%;color: brown">
                        <h4><b>{{ $a5 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $z1 }}</td>
                    <td style="width: 1%">{{ $z2 }}</td>
                    <td style="width: 1%;color: darkviolet">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $a5 + $z3 }}</td>
                    <td style="width: 1%">==</td>
                    <td style="width: 1%">{{ $high_weight1 }}</td>
                    <td style="width: 1%;color: darkviolet">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $third_position_w1 }}</td>
                    <td style="width: 1%">***</td>
                    <td style="width: 1%">{{ $z5 }}</td>
                    <td style="width: 1%">{{ $z4 }}</td>
                    <td style="width: 1%">{{ $z9 }}</td>
                    <td style="width: 1%">{{ $z8 }}</td>
                    <td style="width: 5%"></td>
                    <td style="width: 5%"></td>
                    <td style="width: 5%"></td>
                    <td style="font-size: 10px"> {{ $por }} </td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 4.33%">
                        <b style="color: black">
                            <h2>{{ intval($item['no']) - 1 + intval($item['rt']) }}</h2>
                        </b>
                    </td>
                    <td style="width: 1%">{{ $sing1 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 5 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>2</td>
                <td>22</td>
                <td>23</td>
                <td>26<b>(D)</b></td>
                <td>25<b>(F)</b></td>
                <td></td>
                <td><b>(3rd)</b></td>
                <td>31</td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                @endphp
                <tr>

                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;">{{ $item['no'] }}</td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 1%">
                        <b style="color: black"> {{ intval($item['no']) - 1 + intval($item['rt']) }}
                        </b>
                    </td>
                    <td style="width: 1%;">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%;">
                        <h4><b>{{ $a5 }}</b></h4>
                    </td>
                    <td style="width: 5%;"></td>
                    <td style="width: 1%;">{{ $third_position_w1 }}</td>
                    <td style="width: 1%;">{{ $a5 + $z3 }}</td>
                    <td style="width: 2%;"></td>
                    <td style="width: 2%;"></td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Formula: 6 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>2</td>
                <td>22</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>23</td>
                <td>26<b>(D)</b></td>
                <td>25<b>(F)</b></td>
                <td></td>
                <td><b>(3rd)</b></td>
                <td>31</td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                @endphp
                <tr>

                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item['no'] }}</b></td>
                    <td>{{ $s5 }}</td>
                    <td>{{ $s6 }}</td>
                    <td style="color: blue">
                        @if (isset($item['pfr']))
                            <b>{{ $item['pfr'] }}</b>
                        @else
                            NA
                        @endif
                    </td>
                    <td></td>
                    <td>{{ $s56_sing }} {{ $s7 }}</td>
                    <td style="width: 4%"></td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 1%">
                        <b style="color: black"> {{ intval($item['no']) - 1 + intval($item['rt']) }}
                        </b>
                    </td>
                    <td style="width: 1%;">
                        <h4><b>{{ $z3 }}</b></h4>
                    </td>
                    <td style="width: 1%;">
                        <h4><b>{{ $a5 }}</b></h4>
                    </td>
                    <td style="width: 5%;"></td>
                    <td style="width: 1%;">{{ $third_position_w1 }}</td>
                    <td style="width: 1%;">{{ $a5 + $z3 }}</td>
                    <td style="width: 2%;"></td>
                    <td style="width: 2%;"></td>

                </tr>
            @endforeach
        </tbody>
    </table>



    <h1>Formula: 7 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>2</td>
                <td>22</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                @endphp
                <tr>

                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;color: brown">
                        <h4><b>{{ $a5 }}</b></h4>
                    </td>
                    <td style="width: 1%">{{ $z2 }}</td>
                    <td></td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item['no'] }}</b></td>
                    <td>
                        {{ $az52 }}
                    </td>
                    <td></td>
                    <td style="color:yellow;background-color: rgb(241, 228, 37);width: 1%">
                        <b style="color: black"> {{ intval($item['no']) - 1 + intval($item['rt']) }}
                        </b>
                    </td>
                    <td style="color: blue">
                        @if (isset($item['pfr']))
                            <b>{{ $item['pfr'] }}</b>
                        @else
                            NA
                        @endif
                    </td>
                    <td style="width: 10%"></td>
                    <td style="width: 10%"></td>

                </tr>
            @endforeach
        </tbody>
    </table>




    <h1>Formula: 8 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }

                @endphp
                <tr>

                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="width: 3%"></td>
                    <td>{{ $position_w2 }}</td>
                    <td style="width: 3%"></td>
                    <td>{{ $arr2_b3_1 }}</td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b>
                        <br><b style="width: 5%;font-size: 30px;color: crimson">{{ $arr2_3_1__item_no }} </b>
                    </td>
                    <td style="width: 3%"></td>
                    <td>{{ $item['arr2']['b3'][0] ?? 0 }} <br>
                        <b style="width: 5%;font-size: 20px;color: rgb(117, 220, 20)">{{ $arr2_b3_0 - $arr2_3_1__item_no }}
                        </b>
                    </td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 9 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                @endphp
                <tr>

                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="width: 3%"></td>
                    <td style="width: 5%;font-size: 30px;color: rgb(180, 20, 220)">
                        {{ $position_w2 - $current_weight }}</td>
                    <td>{{ $position_w2 }}</td>
                    <td style="width: 3%">{{ $current_weight }}</td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%;font-size: 30px"><b>{{ $sp1 }}</b></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                    <td style="width: 5%;font-size: 30px;color: rgb(180, 20, 220)">{{ $sp2 }}</td>
                    <td>{{ $arr2_b3_1 }}</td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b>
                        <br><b style="width: 5%;font-size: 30px;color: crimson">{{ $arr2_3_1__item_no }} </b>
                    </td>
                    <td style="width: 3%"></td>
                    <td>{{ $item['arr2']['b3'][0] ?? 0 }} <br>
                        <b style="width: 5%;font-size: 20px;color: rgb(117, 220, 20)">{{ $arr2_b3_0 - $arr2_3_1__item_no }}
                        </b>
                    </td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Formula: 10 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>
                <td>19</td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                    $sp3 = intval($item['arr2']['b3'][0] ?? 0);
                    $sp4 = intval($arr2_b3_1) - $sp3;
                    $sp5 = intval($current_weight) - intval($position_w2);

                @endphp
                <tr>

                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="width: 3%"></td>
                    <td>{{ $position_w2 }}</td>
                    <td style="width: 3%">{{ $current_weight }}</td>
                    <td style="width: 3%"></td>
                    <td>{{ $arr2_b3_1 }}</td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b>
                        <br><b style="width: 5%;font-size: 30px;color: crimson">{{ $arr2_3_1__item_no }} </b>
                    </td>
                    <td style="width: 3%"></td>
                    <td>{{ $sp3 }} <br>
                        <b style="width: 5%;font-size: 20px;color: rgb(117, 220, 20)">{{ $arr2_b3_0 - $arr2_3_1__item_no }}
                        </b>
                    </td>

                    <td style="width: 3%"></td>
                    <td style="width: 1%;font-size: 15px;color: rgb(20, 123, 220)"> <b>{{ $item_no }}</b></td>
                    <td style="width: 3%">{{ $sp4 }}</td>
                    <td style="width: 3%">{{ $sp5 }}</td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%">{{ $sp3 }}</td>
                    <td style="width: 3%"><br><b
                            style="width: 5%;font-size: 30px;color: crimson">{{ $arr2_3_1__item_no }} </b></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>


                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 11 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>Class</td>
                <td>LTG</td>
                <td>T/S</td>
                <td>F/P</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                    $sp3 = intval($item['arr2']['b3'][0] ?? 0);
                    $sp4 = intval($arr2_b3_1) - $sp3;
                    $sp5 = intval($current_weight) - intval($position_w2);

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern = '/\b(\d+(?:\.\d+)?L)\b/';
                    // Initialize an array to store matched weights
                    $weights = [];
                    // Perform the regex match
                    preg_match_all($pattern, $por, $weights);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights = $weights[1];
                @endphp
                <tr>
                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="width: 3%"></td>
                    <td style="width: 5%"></td>
                    <td style="width: 5%"></td>
                    <td>
                        <b style="width: 5%;font-size: 30px;color: crimson">{{ $arr2_3_1__item_no }} </b>
                    </td>
                    <td style="width: 3%">
                        <b style="width: 5%;font-size: 30px;">{{ $sp3 - $arr2_b3_1 }}</b>
                    </td>
                    <td style="width: 3%"><b>{{ $arr2_3_1__item_no + ($sp3 - $arr2_b3_1) }}</b></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%">{{ str_replace('L', '', $extractedWeights[0]) }}</td>
                    <td style="width: 3%">
                        <b style="font-size: 50px;">{{ $sp3 }}</b>
                    </td>

                    <td style="width: 3%">
                        <b
                            style="font-size: 10px;"><b>{{ $sp3 - str_replace('L', '', $extractedWeights[0]) }}</b></b>
                    </td>
                    <td style="width: 3%">
                        <b style="font-size: 10px;">{{ $sp3 }}</b>
                    </td>
                    <td style="width: 3%">
                        <b style="font-size: 10px;">{{ $sp3 }}</b>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 12 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>1</td>
                <td>2</td>
                <td>*</td>
                <td>**</td>
                <td>***</td>
                <td>****</td>
                <td>*****</td>
                <td>3</td>
                <td>Class</td>
                <td>Q</td>
                <td>HNO</td>
                <td>C</td>
                <td>BUDEN</td>
                <td>FA</td>
                <td>A</td>
                <td>P.ODDS</td>

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                    $sp3 = intval($item['arr2']['b3'][0] ?? 0);
                    $sp4 = intval($arr2_b3_1) - $sp3;
                    $sp5 = intval($current_weight) - intval($position_w2);

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern = '/\b(\d+(?:\.\d+)?L)\b/';
                    // Initialize an array to store matched weights
                    $weights = [];
                    // Perform the regex match
                    preg_match_all($pattern, $por, $weights);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights = $weights[1];

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern_for_m = '/\b(\d+(?:\.\d+)?m)\b/';
                    // Initialize an array to store matched weights
                    $weights_for_m = [];
                    // Perform the regex match
                    preg_match_all($pattern_for_m, $por, $weights_for_m);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights_m = $weights_for_m[1];
                @endphp
                <tr>
                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>

                    <td style="font-size: 10px;"> <b> </b></td>
                    <td style="font-size: 25px;"> <b> {{ $extractedWeights_m[0] }} </b></td>
                    <td style="font-size: 10px;"> <b> </b></td>
                    <td style="font-size: 10px;"> <b> </b></td>
                    <td style="font-size: 20px;"> <b> {{ intval(substr($por, strpos($por, 'Rtg') + 3, 3)) }} </b>
                    </td>

                    <td style="width: 3%;font-size: 40px;"><b>{{ $a5 }}</b></td>
                    <td style="width: 5%;font-size: 40px;">
                        <b>{{ $a5 - intval(substr($por, strpos($por, 'Rtg') + 3, 3)) }}</b>
                    </td>
                    <td style="font-size: 10px;"> <b> </b></td>
                    <td style="font-size: 15px;"> <b> {{ $sp3 }} </b></td>
                    <td style="font-size: 10px;"> <b> </b></td>
                    <td style="width: 3%;font-size: 50px;"><b>{{ $arr2_3_1__item_no + ($sp3 - $arr2_b3_1) }}</b></td>

                    <td style="width: 3%">
                        <b
                            style="font-size: 30px;"><b>{{ $sp3 - str_replace('L', '', $extractedWeights[0]) }}</b></b>
                    </td>
                    <td style="width: 3%;color: red">
                        <b
                            style="font-size: 20px;">{{ $arr2_3_1__item_no + ($sp3 - $arr2_b3_1) - ($sp3 - str_replace('L', '', $extractedWeights[0])) }}</b>
                    </td>
                    <td style="width: 3%">
                        <b style="font-size: 25px;"> {{ explode("$", $por)[count(explode("$", $por)) - 1] }} </b>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 13 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>distance</td>
                <td>1</td>
                <td>2</td>
                <td>**</td>
                <td>***</td>
                <td>ANS</td>
                <td>F/P</td>
                <td></td>
                <td></td>
                <td>RTG</td>
                <td>BUDEN .A</td>
                <td>P.ODDS</td>
                <td>C.ODDS</td>
                <td></td>

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                    $sp3 = intval($item['arr2']['b3'][0] ?? 0);
                    $sp4 = intval($arr2_b3_1) - $sp3;
                    $sp5 = intval($current_weight) - intval($position_w2);

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern = '/\b(\d+(?:\.\d+)?L)\b/';
                    // Initialize an array to store matched weights
                    $weights = [];
                    // Perform the regex match
                    preg_match_all($pattern, $por, $weights);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights = $weights[1];

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern_for_m = '/\b(\d+)m\b/';
                    // Initialize an array to store matched weights
                    $weights_for_m = [];
                    // Perform the regex match
                    preg_match_all($pattern_for_m, $por, $weights_for_m);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights_m = $weights_for_m[1];

                    try {
                        $race_dis = $item['race_dis'];
                    } catch (\Throwable $th) {
                        $race_dis = 0;
                    }

                @endphp
                <tr>
                    <td style="font-size: 25px;width: 5%;"> <b>
                            {{ str_replace('0', '', $race_dis - $extractedWeights_m[0]) }} </b></td>
                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="font-size: 25px;"> <b> {{ $extractedWeights_m[0] }} </b></td>
                    <td style="font-size: 25px;width: 5%;"> <b> {{ $race_dis }} </b></td>
                    <td style="font-size: 25px;width: 5%;"> <b>
                            {{ str_replace('0', '', $race_dis - $extractedWeights_m[0]) }} </b></td>
                    <td style="font-size: 25px;width: 15%;"> <b> {{ $sp3 }} /
                            {{ $a5 -
                                intval(substr($por, strpos($por, 'Rtg') + 3, 3)) +
                                ($arr2_3_1__item_no + ($sp3 - $arr2_b3_1)) -
                                ($sp3 - str_replace('L', '', $extractedWeights[0])) }}</b>
                    </td>
                    <td style="width: 5%;font-size: 15px;"> <b> </b></td>
                    <td style="width: 5%;font-size: 15px;"> <b> </b></td>
                    <td style="font-size: 15px;"><b>{{ $a5 - intval(substr($por, strpos($por, 'Rtg') + 3, 3)) }}</b>
                    </td>
                    <td style="width: 3%;font-size: 50px;"><b>{{ $arr2_3_1__item_no + ($sp3 - $arr2_b3_1) }}</b></td>
                    <td style="width: 3%">
                        <b style="font-size: 25px;"> {{ explode("$", $por)[count(explode("$", $por)) - 1] }} </b>
                    </td>
                    <td style="width: 5%">
                        <b style="font-size: 25px;"> </b>
                    </td>
                    <td style="width: 5%">
                        <b style="font-size: 25px;"> </b>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Formula: 14 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>Distance</td>
                <td>1</td>
                <td>2</td>
                <td>ANS</td>
                <td>F/P</td>
                <td></td>
                <td>P.ODDS</td>
                <td>C.ODDS</td>
                <td></td>

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                    $sp3 = intval($item['arr2']['b3'][0] ?? 0);
                    $sp4 = intval($arr2_b3_1) - $sp3;
                    $sp5 = intval($current_weight) - intval($position_w2);

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern = '/\b(\d+(?:\.\d+)?L)\b/';
                    // Initialize an array to store matched weights
                    $weights = [];
                    // Perform the regex match
                    preg_match_all($pattern, $por, $weights);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights = $weights[1];

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern_for_m = '/\b(\d+)m\b/';
                    // Initialize an array to store matched weights
                    $weights_for_m = [];
                    // Perform the regex match
                    preg_match_all($pattern_for_m, $por, $weights_for_m);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights_m = $weights_for_m[1];

                    try {
                        $race_dis = $item['race_dis'];
                    } catch (\Throwable $th) {
                        $race_dis = 0;
                    }

                @endphp
                <tr>
                    <td style="font-size: 25px;width: 5%;"> <b>
                            {{ str_replace('0', '', $race_dis - $extractedWeights_m[0]) }} </b></td>
                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="font-size: 25px;width: 5%;"> <b>
                            {{ str_replace('0', '', $race_dis - $extractedWeights_m[0]) }} </b></td>
                    <td style="font-size: 25px;width: 9%;"> <b> {{ $sp3 }} /
                            {{ $a5 -
                                intval(substr($por, strpos($por, 'Rtg') + 3, 3)) +
                                ($arr2_3_1__item_no + ($sp3 - $arr2_b3_1)) -
                                ($sp3 - str_replace('L', '', $extractedWeights[0])) }}</b>
                    </td>
                    <td style="width: 5%;font-size: 15px;"> <b> </b></td>
                    <td style="width: 3%">
                        <b style="font-size: 25px;"> {{ explode("$", $por)[count(explode("$", $por)) - 1] }} </b>
                    </td>
                    <td style="width: 5%">
                        <b style="font-size: 25px;"> </b>
                    </td>
                    <td style="width: 5%">
                        <b style="font-size: 25px;"> </b>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Formula: 15 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>Distance</td>
                <td>1</td>
                <td>2</td>
                <td>ANS</td>
                <td>F/P</td>
                <td></td>
                <td></td>
                <td>P.ODDS</td>
                <td>C.ODDS</td>
                <td></td>

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                    $sp3 = intval($item['arr2']['b3'][0] ?? 0);
                    $sp4 = intval($arr2_b3_1) - $sp3;
                    $sp5 = intval($current_weight) - intval($position_w2);

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern = '/\b(\d+(?:\.\d+)?L)\b/';
                    // Initialize an array to store matched weights
                    $weights = [];
                    // Perform the regex match
                    preg_match_all($pattern, $por, $weights);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights = $weights[1];

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern_for_m = '/\b(\d+)m\b/';
                    // Initialize an array to store matched weights
                    $weights_for_m = [];
                    // Perform the regex match
                    preg_match_all($pattern_for_m, $por, $weights_for_m);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights_m = $weights_for_m[1];

                    try {
                        $race_dis = $item['race_dis'];
                    } catch (\Throwable $th) {
                        $race_dis = 0;
                    }

                    $podds = explode("$", $por)[count(explode("$", $por)) - 1];
                    if ($podds > $sp3) {
                        $pods_relt = $podds - $sp3;
                    } else {
                        $pods_relt = $podds + $sp3;
                    }

                @endphp
                <tr>
                    <td style="font-size: 25px;width: 5%;"> <b>
                            {{ str_replace('0', '', $race_dis - $extractedWeights_m[0]) }} </b></td>
                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="font-size: 25px;width: 5%;"> <b> {{ $sp3 }} </b></td>
                    <td style="font-size: 25px;width: 9%;"> <b></td>
                    <td style="font-size: 25px;width: 9%;"> <b></td>
                    <td style="width: 5%;font-size: 15px;"> <b> {{ $pods_relt }} </b></td>
                    <td style="width: 3%">
                        <b style="font-size: 25px;"> {{ explode("$", $por)[count(explode("$", $por)) - 1] }} </b>
                    </td>
                    <td style="width: 5%">
                        <b style="font-size: 25px;"> </b>
                    </td>
                    <td style="width: 5%">
                        <b style="font-size: 25px;"> </b>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Formula: 16 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>2</td>
                <td>ANS</td>
                <td>F/P</td>
                <td></td>
                <td></td>
                <td>P.ODDS</td>
                <td>C.ODDS</td>
                <td></td>

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                    $sp3 = intval($item['arr2']['b3'][0] ?? 0);
                    $sp4 = intval($arr2_b3_1) - $sp3;
                    $sp5 = intval($current_weight) - intval($position_w2);

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern = '/\b(\d+(?:\.\d+)?L)\b/';
                    // Initialize an array to store matched weights
                    $weights = [];
                    // Perform the regex match
                    preg_match_all($pattern, $por, $weights);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights = $weights[1];

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern_for_m = '/\b(\d+)m\b/';
                    // Initialize an array to store matched weights
                    $weights_for_m = [];
                    // Perform the regex match
                    preg_match_all($pattern_for_m, $por, $weights_for_m);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights_m = $weights_for_m[1];

                    try {
                        $race_dis = $item['race_dis'];
                    } catch (\Throwable $th) {
                        $race_dis = 0;
                    }

                    $podds = explode("$", $por)[count(explode("$", $por)) - 1];
                    if ($podds > $sp3) {
                        $pods_relt = $podds - $sp3;
                    } else {
                        $pods_relt = $podds + $sp3;
                    }

                @endphp
                <tr>

                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="font-size: 25px;width: 5%;"> <b> {{ $sp3 }} </b></td>
                    <td style="font-size: 25px;width: 9%;"> <b></td>
                    <td style="font-size: 25px;width: 9%;"> <b></td>
                    <td style="width: 5%;font-size: 45px;"> <b> <b>{{ $pods_relt }}</b> </b></td>
                    <td style="width: 3%">
                        <b style="font-size: 25px;"> {{ explode("$", $por)[count(explode("$", $por)) - 1] }} </b>
                    </td>
                    <td style="width: 5%">
                        <b style="font-size: 25px;"> </b>
                    </td>
                    <td style="width: 5%">
                        <b style="font-size: 25px;"> </b>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 17 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>1</td>
                <td>2</td>
                <td>PO</td>
                <td>CO</td>
                <td>Barrier P</td>
                <td>Barrier C</td>
                <td>###</td>
                <td>PR</td>
                <td>CR</td>
                <td>A</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }
                    

                    if (isset($item['barrier'])) {
                        $barrier = $item['barrier'];
                    } else {
                        $barrier = 0;
                    }

                
                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                    $sp3 = intval($item['arr2']['b3'][0] ?? 0);
                    $sp4 = intval($arr2_b3_1) - $sp3;
                    $sp5 = intval($current_weight) - intval($position_w2);

                    // Define the regex pattern to match weights (digits with optional decimal followed by 'kg')
                    $pattern = '/\b(\d+(?:\.\d+)?L)\b/';
                    // Initialize an array to store matched weights
                    $weights = [];
                    // Perform the regex match
                    preg_match_all($pattern, $por, $weights);
                    // Extracted weights will be in $weights[1]
                    $extractedWeights = $weights[1];

                    $pattern_barrier = '/(?<=Barrier )\d{1,2}/';
                    $weights_barrier = [];
                    preg_match_all($pattern_barrier, $por, $weights_barrier);
                    $p_barrier = $weights_barrier[0][0];

                @endphp
                <tr>
                    <td style="font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="width: 3%">
                        <b style="width: 5%;font-size: 30px;">
                            {{ explode("$", $por)[count(explode("$", $por)) - 1] }}
                        </b>
                    </td>
                    <td style="width: 5%"></td>
                    <td style="width: 5%">
                        <b style="width: 5%;font-size: 30px;">
                            {{ $p_barrier }}
                        </b>
                    </td>
                    <td style="width: 5%">
                        <b style="width: 5%;font-size: 30px;">
                            {{ $barrier }}
                        </b>
                    </td>
                    <td style="width: 5%"></td>
                    <td>
                        <b style="width: 5%;font-size: 30px;color: crimson">
                            {{ intval(substr($por, strpos($por, 'Rtg') + 3, 3)) }}
                        </b>
                    </td>
                    <td style="width: 3%">
                        <b style="width: 5%;font-size: 30px;">{{ $item['rt'] }}</b>
                    </td>
                    <td style="width: 3%">
                        <b style="width: 5%;font-size: 30px;">
                            {{ $item['rt'] - intval(substr($por, strpos($por, 'Rtg') + 3, 3)) }}
                        </b>
                    </td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%">{{ str_replace('L', '', $extractedWeights[0]) }}</td>
                    <td style="width: 3%">
                        <b style="font-size: 50px;">{{ $sp3 }}</b>
                    </td>

                    <td style="width: 3%">
                        <b
                            style="font-size: 10px;"><b>{{ $sp3 - str_replace('L', '', $extractedWeights[0]) }}</b></b>
                    </td>
                    <td style="width: 3%">
                        <b style="font-size: 10px;">{{ $sp3 }}</b>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    {{-- 18 --}}

    <h1>Formula: 18 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            @php
                $new_rt = intval($last_page[0]['rt']);
            @endphp
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    if (isset($item['pphn'])) {
                        $pphn = $item['pphn'];
                    } else {
                        $pphn = 0;
                    }
                    if (isset($item['ppor'])) {
                        $ppor = $item['ppor'];
                    } else {
                        $ppor = 0;
                    }

                    if (isset($item['phn'])) {
                        $phn = $item['phn'];
                    } else {
                        $phn = 0;
                    }
                    if (isset($item['por'])) {
                        $por = $item['por'];
                    } else {
                        $por = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight1 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight1 = 0;
                    }

                    if (isset($item['arr2']['b4'])) {
                        $high_weight2 = explode('kg', $item['arr2']['b4'][2])[0];
                    } else {
                        $high_weight2 = 0;
                    }

                    $yellow1 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow1_phn = $yellow1;
                    } else {
                        $yellow1_phn = $yellow1 - $phn;
                    }
                    $newrt_hw1 = $new_rt - $high_weight1;

                    if ($newrt_hw1 == 0) {
                        $a1 = $yellow1_phn;
                        $sing1 = 'SC';
                    } elseif ($newrt_hw1 < 0) {
                        $a1 = $yellow1_phn - abs($newrt_hw1);
                        $sing1 = 'D';
                    } else {
                        $a1 = $yellow1_phn + abs($newrt_hw1);
                        $sing1 = 'P';
                    }

                    $yellow2 = intval($phn) - 1 + intval(substr($por, strpos($por, 'Rtg') + 3, 3));
                    if ($phn == 1) {
                        $yellow2_phn = $yellow2;
                    } else {
                        $yellow2_phn = $yellow2 - $phn;
                    }
                    $newrt_hw2 = $new_rt - $high_weight2;

                    if ($newrt_hw2 == 0) {
                        $a2 = $yellow2_phn;
                        $sing2 = 'SC';
                    } elseif ($newrt_hw2 < 0) {
                        $a2 = $yellow2_phn - abs($newrt_hw2);
                        $sing2 = 'Demosition';
                    } else {
                        $a2 = $yellow2_phn + abs($newrt_hw2);
                        $sing2 = 'Promosition';
                    }

                    try {
                        $position_w1 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w1 = 0;
                    }

                    try {
                        $third_position_w1 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w1 = 0;
                    }

                    if ($position_w1 == 1) {
                        $a3 = 0;
                    } elseif ($position_w1 == 3) {
                        $a3 = 0;
                    } else {
                        $a3 = $position_w1 - $third_position_w1;
                    }

                    try {
                        $position_w2 = explode('kg', $item['arr2']['b3'][2])[0];
                    } catch (\Throwable $th) {
                        $position_w2 = 0;
                    }

                    try {
                        $third_position_w2 = explode('kg', $item['arr2']['b2'][2])[0];
                    } catch (\Throwable $th) {
                        $third_position_w2 = 0;
                    }

                    try {
                        $first_position = explode('kg', $item['arr2']['b1'][2])[0];
                    } catch (\Throwable $th) {
                        $first_position = 0;
                    }

                    if ($position_w2 == 1) {
                        $a4 = 0;
                    } elseif ($position_w2 == 3) {
                        $a4 = 0;
                    } else {
                        $a4 = $position_w2 - $third_position_w2;
                    }

                    if ($a3 == 0) {
                        $a5 = $a1;
                    } elseif ($a3 < 0) {
                        $a5 = $a1 - abs($a3);
                    } else {
                        $a5 = $a1 + abs($a3);
                    }

                    if ($a4 == 0) {
                        $a6 = $a2;
                    } elseif ($a4 < 0) {
                        $a6 = $a2 - abs($a4);
                    } else {
                        $a6 = $a2 + abs($a4);
                    }

                    // use start

                    $z1 = $high_weight1 - $first_position;
                    $z2 = $a5 - $third_position_w1;
                    if ($z2 == 0) {
                        $z3 = $z1;
                    } elseif ($z2 < 0) {
                        $z3 = abs($z2) - $z1;
                    } else {
                        $z3 = abs($z2) + $z1;
                    }

                    $z4 = $third_position_w1 - $a5;
                    $z5 = $high_weight1 - $z3 - $a5;

                    $z6 = abs($z4);
                    $z7 = abs($z5);
                    if ($z5 < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }
                    if ($z4 < 0) {
                        $s2 = '-';
                    } else {
                        $s2 = '';
                    }

                    if ($z6 > $z7) {
                        $z8 = $z6 - $z7;
                        if ($s1 == '-') {
                            $s4 = $a5 - abs($z8);
                        } else {
                            $s4 = $a5 + abs($z8);
                        }
                        $z9 = '';
                    } else {
                        $z8 = '';
                        $z9 = $z7 - $z6;
                        if ($s2 == '-') {
                            $s4 = $a5 - abs($z9);
                        } else {
                            $s4 = $a5 + abs($z9);
                        }
                    }

                    if ($z5 < 0) {
                        $s3 = $third_position_w1 - abs($z5);
                    } else {
                        $s3 = $third_position_w1 + abs($z5);
                    }

                    $s5 = intval($item['no']) - 1 + intval($item['rt']) - $third_position_w1;
                    $s6 = $a5 + $z3 - $third_position_w1;
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    if ($z2 < 0) {
                        $az52 = $a5 + abs($z2);
                    } else {
                        $az52 = $a5;
                    }

                    if (isset($item['arr2'])) {
                        $arr2_b3_1 = intval($item['arr2']['b3'][1]);
                        $arr2_b3_0 = intval($item['arr2']['b3'][0]);
                        $item_no = intval($item['no']);
                        $arr2_3_1__item_no = $arr2_b3_1 - $item_no;
                    } else {
                        $arr2_b3_1 = 0;
                        $arr2_b3_0 = 0;
                        $item_no = 0;
                        $arr2_3_1__item_no = 0;
                    }
                    $current_weight = explode('kg', $item['weight'])[0];
                    if ($arr2_3_1__item_no < 0) {
                        $sp1 = $current_weight - abs($arr2_3_1__item_no);
                    } else {
                        $sp1 = $current_weight + $arr2_3_1__item_no;
                    }
                    $sp2 = $position_w2 - $sp1;

                    $sp3 = intval($item['arr2']['b3'][0] ?? 0);
                    $sp4 = intval($arr2_b3_1) - $sp3;
                    $sp5 = intval($current_weight) - intval($position_w2);

                @endphp
                <tr>

                    <td style="width: 20%;font-size: 20px;"> {{ $por }} </td>
                    <td style="width: 1%;font-size: 15px;"> <b>{{ $item_no }}</b></td>
                    <td style="width: 3%">{{ $item['hourse_name'] }}</td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%">{{ $sp3 }}</td>
                    <td style="width: 3%"><br><b
                            style="width: 5%;font-size: 30px;color: crimson">{{ $arr2_3_1__item_no }} </b></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>


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
