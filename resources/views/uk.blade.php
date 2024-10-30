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

                <th>Horse Name</th>
                <th>{{ $time }}</th>
                <th>PPRD</th>
                <th>PPHN</th>
                <th>PPOR</th>
                <th></th>
                <th>PRD</th>
                <th style="text-align: right;">PHN</th>
                <th>POR</th>
                <th></th>
                <th>LHN</th>
                <th>LOR</th>
                <th>form</th>
            </tr>
        </thead>
        <tbody>
            @php
                // dd($last_page);
                $new_rt = intval($last_page[0]['LOR']);
            @endphp
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'Demotion';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'Promotion';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'Demotion';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'Promotion';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'Demotion';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'Promotion';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }

                @endphp
                <tr>

                    <td style="width: 2%">{{ $item['HNAME'] }}
                        <br> <br> {{ $rc2 }}
                    </td>
                    <td style="width: 2.33%">
                        {!! $item[$item['PHN'] . '2'] !!}
                    </td>
                    <td style="width: 2%">{{ $pprd }}
                        <br> <br> {{ $pprc }}
                    </td>
                    <td style="text-align: center;font-size: 2em;width: 2%">
                        {{ $pphn }} <br>
                        <b style="color: brown">{{ $ps1 }}</b> <br>
                        <b style="color: green">{{ $ps2 }}</b>
                    </td>
                    <td style="width: 2%">
                        <b>{{ $ppor }}</b>
                        <br> <b>{{ $pphn_form }} - 0 </b> <br> <br>
                        <br> <b
                            style="color: rgb(2, 0, 128)">{{ isset($item['first_rtg_line2']) ? $item['first_rtg_line2'] : 0 }}</b>
                        <br> <b style="color: rgb(2, 0, 128)">{{ isset($_1_3_rtg_1[2]) ? $_1_3_rtg_1[2] : 0 }}</b>
                        <br> <b style="color: rgb(2, 0, 128)">{{ $from_rtg1 }}</b>
                        <br><br> <b style="color: rgb(128, 0, 117);text-align: center">{{ $new_rt }} -
                            {{ $first_rtg_2 }} </b>
                        <br> <b style="color: rgb(128, 4, 0)">{{ $sign2 }}</b>
                        <br> <b style="color: rgb(0, 128, 64)">{{ $nnaps2 }}</b>
                        <br> <b style="color: rgb(128, 119, 0)">{{ $sgn2 }}</b>
                        <br> <b style="color: rgb(153, 51, 148)">{{ $vv2 }}</b>


                    </td>
                    <td style="width: 3.33%">
                        @if (isset($item[$item['PHN'] . '1']))
                        {!! $item[$item['PHN'] . '1'] !!}    
                        @else
                        {{-- {!! $item[$item['PHN'] . '1'] !!} --}}
                        @endif
                        
                    </td>
                    <td style="width: 2%">
                        {{ $prd }}
                        <br><br> {{ $prc }}

                    </td>

                    <td style="text-align: center;font-size: 2em;width: 2%">
                        {{ $phn }} <br>
                        <b style="color: brown">{{ $s1 }}</b> <br>
                        <b style="color: green">{{ $s2 }}</b>

                    </td>
                    <td style="width: 2.33%">
                        <b>{{ $por }}</b>
                        <br> <b>{{ $phn_form }} - 0</b> <br>
                        <br> <b style="color: rgb(2, 0, 128)">{{ $item['first_rtg_line1'] }}</b>
                        <br> <b style="color: rgb(2, 0, 128)">{{ $_1_3_rtg_2[2] }}</b>
                        <br> <b style="color: rgb(2, 0, 128)">{{ $from_rtg2 }}</b>
                        <br><br> <b style="color: rgb(128, 0, 117);text-align: center">{{ $new_rt }} -
                            {{ $first_rtg_1 }} </b>
                        <br> <b style="color: rgb(128, 4, 0)">{{ $sign1 }}</b>
                        <br> <b style="color: rgb(0, 128, 64)">{{ $nnaps1 }}</b>
                        <br> <b style="color: rgb(128, 119, 0)">{{ $sgn1 }}</b>
                        <br> <b style="color: rgb(153, 51, 148)">{{ $vv1 }}</b>
                    </td>
                    <td style="width: 3.33%">
                        {!! $item[$item['HNAME']] !!}
                    </td>
                    <td style="text-align: center;font-size: 2em;width: 1%">
                        {{ $lhn }} <br>
                        <b style="color: brown">
                            <h3>{{ $lhn - 1 + $lor }}</h3>
                            <b style="color: green">{{ $s2 }}</b>
                        </b>
                    </td>
                    <td style="width: 3.33%">
                        <b>{{ $lor }}</b>
                        <br> <b>{{ $lhn_form }} - 0</b> <br>
                        <br> <b style="color: rgb(2, 0, 128)">{{ $item['first_rtg_line'] }}</b>
                        <br> <b style="color: rgb(2, 0, 128)">{{ $_1_3_rtg_3[2] }}</b>
                        <br> <b style="color: rgb(2, 0, 128)">{{ $from_rtg3 }}</b>
                        <br><br> <b style="color: rgb(128, 0, 117);text-align: center">{{ $new_rt }} -
                            {{ $first_rtg }} </b>
                        <br> <b style="color: rgb(128, 4, 0)">{{ $sign }}</b>
                        <br> <b style="color: rgb(0, 128, 64)">{{ $nnaps }}</b>
                        <br> <b style="color: rgb(128, 119, 0)">{{ $sgn3 }}</b>
                        <br> <b style="color: rgb(153, 51, 148)">{{ $vv3 }}</b>
                    </td>
                    <td style="width: 2.33%">{{ $form }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $z6_arr = [];
            @endphp
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }
                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $_133 = intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    if ($_133 == 0) {
                        $z1 = $vv3;
                    } elseif ($_133 < 0) {
                        $z1 = abs($_133) - $vv3;
                    } else {
                        $z1 = abs($_133) + $vv3;
                    }
                    $e1 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z2 = intval($first_rtg) - $e1;
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                @endphp
                <tr>
                    <td>{{ $e1 }}</td>
                    <td>{{ $lhn }}</td>
                    <td>{{ $first_rtg }}</td>
                    <td>{{ $_133 }}</td>
                    <td>{{ $vv3 }}</td>
                    <td style="color: cadetblue">{{ $z2 }}</td>
                    <td style="color: crimson">{{ $z3 }}</td>
                    <td></td>
                    <td style="color: royalblue">{{ $z4 }}</td>
                    <td style="background-color: yellow"></td>
                    <td>{{ $_133 }}</td>
                    <td></td>
                    <td>{{ $first_rtg }}</td>
                    <td>{{ $z4 }}</td>
                    <td>{{ intval($first_rtg) - $z4 }}</td>
                    <td>{{ $prd }}</td>
                    <td>{{ $sign1 }}</td>
                    @php
                        array_push($z6_arr, intval($first_rtg) - $z4 - $vv3);
                    @endphp
                </tr>
            @endforeach
        </tbody>
    </table>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>1</td>
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
                <td>25</td>
                <td>26<b>(F)</b></td>
                <td>27<b>(D)</b></td>
                <td>28<b>(A)</b></td>
                <td>29</td>
                <td>30</td>
                <td>31</td>
                <td>32<b>(3rd)</b></td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                @endphp
                <tr>
                    <td>{{ explode(' ', $_1_3_rtg_3[0])[2] }}</td>
                    <td>{{ $lhn }}</td>
                    <td>{{ $first_rtg }}</td>
                    <td>{{ explode(' ', $_1_3_rtg_3[2])[2] }}</td>
                    <td>{{ $vv3 }}</td>
                    <td style="color: cadetblue">{{ $c5 }}</td>
                    <td style="color: crimson">{{ $c6 }}</td>
                    <td></td>
                    <td style="color: royalblue">{{ $c7 }}</td>
                    <td style="background-color: yellow"></td>
                    <td>{{ $c8 }}</td>
                    <td></td>
                    <td>{{ $first_rtg }}</td>
                    <td>{{ $c7 }}</td>
                    <td>{{ $c9 }}</td>
                    <td style="background-color: rgb(195, 0, 255)"></td>
                    <td>{{ $z6_arr[$k] }}</td>
                    <td>{{ $c9 - $vv3 }}</td>
                    <td>
                        @if ($s1 == '-')
                            <b>- {{ $z9 }}</b>
                        @else
                            <b>{{ $z9 }}</b>
                        @endif
                    </td>
                    <td>
                        @if ($c9 - $vv3 < 0)
                            <b>-{{ $z10 }} </b>
                        @else
                            <b>{{ $z10 }} </b>
                        @endif
                    </td>
                    <td><b>{{ $p01 }}</b></td>
                    <td></td>
                    <td></td>
                    <td>{{ $prd }}</td>
                    <td>{{ $sign1 }}</td>
                    <td>{{ $vv3 }}</td>
                    <td>{{ $c7 }}</td>
                    <td style="color: silver"><b>{{ $vv3 - $c7 }}</b></td>
                    <td style="width: 20%"></td>
                    <td style="width: 20%"></td>
                    <td style="width: 20%"></td>
                    <td>{{ $c9 }}</td>
                    <td style="width: 20%"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                    $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                    $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }

                @endphp
                <tr>
                    <td>{{ $lhn }}</td>
                    <td>{{ $sign2 }}</td>
                    <td>{{ $pprd }}</td>
                    <td>{{ $first_rtg_2 }}/ {{ $vv2 }}</td>
                    <td>{{ $sign1 }}</td>
                    <td>{{ $prd }}</td>
                    <td>{{ $first_rtg_1 }}/ {{ $vv1 }}</td>
                    <td>{{ $sign1 }}</td>
                    <td>{{ $prd }}</td>
                    <td>{{ $first_rtg }}/ {{ $vv3 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>24</b></td>
                <td>2</td>
                <td>27<b>(D)</b></td>
                <td>26<b>(F)</b></td>
                <td></td>
                <td>32<b>(3rd)</b></td>
                <td>FO</td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                @endphp
                <tr>

                    <td>{{ $prd }}</td>
                    <td>{{ explode(' ', $_1_3_rtg_3[0])[2] }}</td>
                    <td>{{ $lhn }}</td>
                    <td>{{ $c7 }}</td>
                    <td>{{ $vv3 }}</td>
                    <td style="width: 5%"></td>
                    <td>{{ $c9 }}</td>
                    <td style="color: silver"><b>{{ $vv3 + $c7 }}</b></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 6 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th></th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>24</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>27<b>(D)</b></td>
                <td>26<b>(F)</b></td>
                <td>32<b>(3rd)</b></td>
                <td>FO</td>

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                    $ss4 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $s5 = $ss4 - intval($c9);
                    $s6 = intval($vv3 + $c7) - intval($c9);
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }
                @endphp
                <tr>

                    <td>{{ $prd }}</td>
                    <td style="color: blue;font-size: 15px;">{{ $lhn }}</td>
                    <td>{{ $s5 }}</td>
                    <td>{{ $s6 }}</td>
                    <td> {{ $form }}</td>
                    <td style="width: 5%"></td>
                    <td>{{ $s56_sing }} {{ $s7 }}</td>
                    <td style="width: 5%"></td>
                    <td>{{ $ss4 }}</td>
                    <td style="color: blue;font-size: 15px;">{{ $lhn }}</td>
                    <td>{{ $c7 }}</td>
                    <td>{{ $vv3 }}</td>
                    <td>{{ $c9 }}</td>
                    <td style="color: silver"><b>{{ $vv3 + $c7 }}</b></td>

                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 7 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th></th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>1</b></td>
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

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                    $ss4 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $s5 = $ss4 - intval($c9);
                    $s6 = intval($vv3 + $c7) - intval($c9);
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }


                    $from_rtg3_arr = explode(" ",$from_rtg3);
                    $from_rtg3_arr_i0 = intval($from_rtg3_arr[0]);
                    $from_rtg3_arr_i1 = intval($from_rtg3_arr[1]);
                    
                @endphp
                <tr>

                    <td>{{ $prd }}</td>
                    <td style="width: 3%"> {{ $form }}</td>
                    <td style="color: blue;font-size: 15px;">{{ $lhn }}</td>
                    <td style="width: 3%"></td>
                    <td>{{ $from_rtg3_arr[2] }}</td>
                    <td style="width: 3%"></td>
                    <td>{{ $from_rtg3_arr_i1 }}</td>
                    <td style="color: blue;font-size: 15px;">{{ $lhn }}
                        <br><b style="color: rgb(0, 225, 255);font-size: 30px;">{{ $from_rtg3_arr_i1 - $lhn  }}</b>
                    </td>
                    <td style="width: 3%"></td>
                    
                    <td>{{ $from_rtg3_arr_i0 }}
                        <br>
                        <b style="color: rgb(217, 255, 0);font-size: 30px;">{{ $from_rtg3_arr_i0 - ($from_rtg3_arr_i1 - $lhn) }}</b>
                    </td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 8 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th></th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>1</b></td>
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
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                    $ss4 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $s5 = $ss4 - intval($c9);
                    $s6 = intval($vv3 + $c7) - intval($c9);
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    $from_rtg3_arr_i1 = intval($from_rtg3_arr[1]);
                    $from_rtg3_arr = explode(" ",$from_rtg3);
                    $sp1 = $from_rtg3_arr_i1 - $lhn;
                    if ($sp1 < 0) {
                        $sp2 = $lor - abs($sp1);
                    } else {
                        $sp2 = $lor + $sp1;
                    }
                    $from_rtg3_arr_i2 = intval($from_rtg3_arr[2]);
                    $sp3 = $from_rtg3_arr_i2 - $sp2;
                    
                @endphp
                <tr>

                    <td>{{ $prd }}</td>
                    <td style="width: 3%"> {{ $form }}</td>
                    <td style="color: blue;font-size: 15px;">{{ $lhn }}</td>
                    
                    <td style="width: 3%"></td>
                    <td style="width: 3%;color: rgb(255, 0, 0);font-size: 30px;">{{ $from_rtg3_arr_i2 - $lor }}</td>
                    <td>{{ $from_rtg3_arr_i2 }}</td>
                    <td style="width: 3%">{{ $lor }}</td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%;font-size: 30px;"><b>{{ $sp2 }}</b></td>
                    <td style="width: 3%"></td>
                    
                    <td style="color: red;font-size: 30px;">{{ $sp3 }}</td>
                    <td>{{ $from_rtg3_arr_i1 }}</td>
                    <td style="color: blue;font-size: 15px;">{{ $lhn }}
                        <br><b style="color: rgb(0, 225, 255);font-size: 30px;">{{ $sp1  }}</b>
                    </td>
                    <td style="width: 3%"></td>  
                    <td>{{ $from_rtg3_arr_i0 }}
                        <br>
                        <b style="color: rgb(217, 255, 0);font-size: 30px;">{{ $from_rtg3_arr_i0 - ($sp1) }}</b>
                    </td>
                  
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 9 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th></th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>1</b></td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>P</td>
                <td>C</td>
                <td>D</td>
             

            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                    $ss4 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $s5 = $ss4 - intval($c9);
                    $s6 = intval($vv3 + $c7) - intval($c9);
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    $from_rtg3_arr_i1 = intval($from_rtg3_arr[1]);
                    $from_rtg3_arr = explode(" ",$from_rtg3);
                    $sp1 = $from_rtg3_arr_i1 - $lhn;
                    if ($sp1 < 0) {
                        $sp2 = $lor - abs($sp1);
                    } else {
                        $sp2 = $lor + $sp1;
                    }
                    $from_rtg3_arr_i2 = intval($from_rtg3_arr[2]);
                    $sp3 = $from_rtg3_arr_i2 - $sp2;
                    
                @endphp
                <tr>

                    <td>{{ $prd }}</td>
                    <td style="width: 3%"> {{ $form }}</td>
                    <td style="color: blue;font-size: 15px;">{{ $lhn }}</td>
                    <td>{{ $from_rtg3_arr_i2 }}</td>
                    <td style="width: 3%">{{ $lor }}</td>
                    <td style="width: 3%"></td>
                    <td>{{ $from_rtg3_arr_i1 }}</td>
                    <td style="color: blue;font-size: 15px;">{{ $lhn }}
                        <br><b style="color: rgb(0, 225, 255);font-size: 30px;">{{ $sp1  }}</b>
                    </td>
                    <td style="width: 3%"></td>  
                    <td style="color: rgb(0, 255, 21);font-size: 30px;">{{ $lhn }}</td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"><br><b style="color: rgb(0, 225, 255);font-size: 30px;">{{ $sp1  }}</b></td>
                    <td style="width: 3%"></td>
                    <td style="width: 3%"> {{ $form }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 10 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th></th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>1</b></td>
                <td>2</td>
                <td>Class</td>
                <td>RTG</td>
                <td>T/S</td>
                <td>F/P</td>
                <td>LTG</td>
                <td>D</td>
                <td>G</td>
                <td>H</td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                    $ss4 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $s5 = $ss4 - intval($c9);
                    $s6 = intval($vv3 + $c7) - intval($c9);
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    $from_rtg3_arr_i1 = intval($from_rtg3_arr[1]);
                    $from_rtg3_arr = explode(" ",$from_rtg3);
                    $sp1 = $from_rtg3_arr_i1 - $lhn;
                    if ($sp1 < 0) {
                        $sp2 = $lor - abs($sp1);
                    } else {
                        $sp2 = $lor + $sp1;
                    }
                    $from_rtg3_arr_i2 = intval($from_rtg3_arr[2]);
                    $sp3 = $from_rtg3_arr_i2 - $sp2;
                    preg_match_all('!\d+!', $form, $matches);
                    $form_only_digit = $matches[0][count($matches[0])-1];
                    $form_only_one_digit = $form_only_digit[strlen($form_only_digit)-1];
                    $ltg = intval(explode(")", explode("(", $prc)[count(explode("(", $prc))-1])[0]);
                @endphp
                <tr>

                    <td style="width: 20%">{{ $prd }}</td>
                    <td style="width: 1% color: blue;font-size: 15px;">{{ $lhn }}</td>
                    <td style="width: 5%"></td>
                    <td style="font-size: 15px;"><b>{{ $lor - $from_rtg3_arr_i2 }}</b></td>
                    <td><br><b style="color: rgb(0, 225, 255);font-size: 30px;">{{ $sp1  }}</b></td>
                    <td style="font-size: 15px;"><b>{{ $from_rtg3_arr_i1 - $form_only_one_digit }}</b></td>
                    <td>
                        <b style="font-size: 30px;">
                            {{ $ltg }}    
                        </b>
                    </td>
                    <td style="width: 3%"> <b style="font-size: 50px;">{{ $form_only_one_digit }}</b></td>
                 
                    <td><br><b style="font-size: 30px;">
                        {{ ($lor - $from_rtg3_arr_i2) + ($sp1) + ($from_rtg3_arr_i1 - $form_only_one_digit) + ($ltg)  }}
                    </b></td>
                    <td><br><b style="font-size: 30px;">
                        
                    </b></td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <h1>Formula: 11 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th></th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>1</b></td>
                <td>2</td>
                
                <td>RTG</td>
                <td>T/S</td>
                <td>F/P</td>
                <td>LTG</td>
                <td>D</td>
                <td></td>
                <td>F/P</td>
                <td>G</td>
                <td>*</td>
                <td>P.ODDS</td>
                <td>C.ODDS</td>
                <td>****</td>
                <td>H</td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;

                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';


                    $h_sp = isset($item['sp0']) ? $item['sp0'] : 0;

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                    $ss4 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $s5 = $ss4 - intval($c9);
                    $s6 = intval($vv3 + $c7) - intval($c9);
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    $from_rtg3_arr_i1 = intval($from_rtg3_arr[1]);
                    $from_rtg3_arr = explode(" ",$from_rtg3);
                    $sp1 = $from_rtg3_arr_i1 - $lhn;
                    if ($sp1 < 0) {
                        $sp2 = $lor - abs($sp1);
                    } else {
                        $sp2 = $lor + $sp1;
                    }
                    $from_rtg3_arr_i2 = intval($from_rtg3_arr[2]);
                    $sp3 = $from_rtg3_arr_i2 - $sp2;
                    preg_match_all('!\d+!', $form, $matches);
                    $form_only_digit = $matches[0][count($matches[0])-1];
                    $form_only_one_digit = $form_only_digit[strlen($form_only_digit)-1];
                    $ltg = intval(explode(")", explode("(", $prc)[count(explode("(", $prc))-1])[0]);
                    $col_g = ($lor - $from_rtg3_arr_i2) + ($sp1) + ($from_rtg3_arr_i1 - $form_only_one_digit) + ($ltg);

                    $ltgD = ($ltg-$form_only_one_digit);
                    if($ltgD > 0){
                        $fp = $col_g - $ltgD;
                    }elseif ($ltgD < 0) {
                        $fp = $col_g + $ltgD;
                    }else{
                        $fp = $col_g;
                    }

                @endphp
                <tr>

                    <td style="width: 15%">{{ $prd }}</td>
                    <td style="width: 1% color: blue;font-size: 15px;">{{ $lhn }}</td>
                    
                    <td style="font-size: 15px;width: 2%"><b>{{ $lor - $from_rtg3_arr_i2 }}</b></td>
                    <td><br><b style="color: rgb(0, 225, 255);font-size: 30px;width: 2%">{{ $sp1  }}</b></td>
                    <td style="font-size: 15px;width: 2%"><b>{{ $from_rtg3_arr_i1 - $form_only_one_digit }}</b></td>
                    <td>
                        <b style="font-size: 30px;width: 2%">
                            {{ $ltg }}    
                        </b>
                    </td>
                    <td style="width: 2%"> <b style="font-size: 50px;">{{ $form_only_one_digit }}</b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                    <td style="width: 6%"> <b style="color: rgb(160, 5, 250);font-size: 50px;">{{ $form_only_one_digit }}/{{ $fp }}</b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                    <td><br><b style="font-size: 30px;"></b>{{ $h_sp }}</td>
                    <td><br><b style="font-size: 30px;"></b></td>

                    <td><br><b style="font-size: 30px;"> {{ $col_g }}</b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 12 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th></th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>1</b></td>
                <td>2</td>
                <td>RTG</td>
                <td></td>
                <td>P.ODDS</td>
                <td>P.ODDS Result</td>
                <td>C.ODDS</td>
                <td></td>
                <td>LTG</td>
                <td>D</td>
                <td></td>
                <td>F/P</td>
                <td>G</td>
                <td>*</td>
                <td>P.ODDS</td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;


                    $h_sp = isset($item['sp0']) ? $item['sp0'] : "0/0";
                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                    $ss4 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $s5 = $ss4 - intval($c9);
                    $s6 = intval($vv3 + $c7) - intval($c9);
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    $from_rtg3_arr_i1 = intval($from_rtg3_arr[1]);
                    $from_rtg3_arr = explode(" ",$from_rtg3);
                    $sp1 = $from_rtg3_arr_i1 - $lhn;
                    if ($sp1 < 0) {
                        $sp2 = $lor - abs($sp1);
                    } else {
                        $sp2 = $lor + $sp1;
                    }
                    $from_rtg3_arr_i2 = intval($from_rtg3_arr[2]);
                    $sp3 = $from_rtg3_arr_i2 - $sp2;
                    preg_match_all('!\d+!', $form, $matches);
                    $form_only_digit = $matches[0][count($matches[0])-1];
                    $form_only_one_digit = $form_only_digit[strlen($form_only_digit)-1];
                    $ltg = intval(explode(")", explode("(", $prc)[count(explode("(", $prc))-1])[0]);
                    $col_g = ($lor - $from_rtg3_arr_i2) + ($sp1) + ($from_rtg3_arr_i1 - $form_only_one_digit) + ($ltg);

                    $ltgD = ($ltg-$form_only_one_digit);
                    if($ltgD > 0){
                        $fp = $col_g - $ltgD;
                    }elseif ($ltgD < 0) {
                        $fp = $col_g + $ltgD;
                    }else{
                        $fp = $col_g;
                    }
                    $sh_sp = explode(" ",$h_sp)[0];
                    $sh_sp_ar = explode("/",$sh_sp);

                    $sh_sp_a = $sh_sp_ar[0]/$sh_sp_ar[1];
                    
                @endphp
                <tr>

                    <td style="width: 15%">{{ $prd }}</td>
                    <td style="width: 1% color: blue;font-size: 15px;">{{ $lhn }}</td>
                    
                    <td style="font-size: 15px;width: 2%"><b>{{ $lor - $from_rtg3_arr_i2 }}</b></td>
                    <td><br><b style="color: rgb(0, 225, 255);font-size: 30px;width: 5%"> {{ $h_sp }}</b></td>
                    <td><br><b style="color: rgb(0, 225, 255);font-size: 30px;width: 5%"> {{ $sh_sp_a }}</b></td>
                    <td style="font-size: 15px;width: 5%"><b></b></td>
                    <td style="font-size: 15px;width: 5%"><b></b></td>
                    <td>
                        <b style="font-size: 30px;width: 2%">
                            {{ $ltg }}    
                        </b>
                    </td>
                    <td style="width: 2%"> <b style="font-size: 50px;">{{ $form_only_one_digit }}</b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                    <td style="width: 6%"> <b style="color: rgb(160, 5, 250);font-size: 50px;">{{ $form_only_one_digit }}/{{ $fp }}</b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 13 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th></th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>1</b></td>
                <td>2</td>
                <td>RTG</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>C.ODDS</td>
                <td></td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;


                    $h_sp = isset($item['sp0']) ? $item['sp0'] : "0/0";
                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                    $ss4 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $s5 = $ss4 - intval($c9);
                    $s6 = intval($vv3 + $c7) - intval($c9);
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    $from_rtg3_arr_i1 = intval($from_rtg3_arr[1]);
                    $from_rtg3_arr = explode(" ",$from_rtg3);
                    $sp1 = $from_rtg3_arr_i1 - $lhn;
                    if ($sp1 < 0) {
                        $sp2 = $lor - abs($sp1);
                    } else {
                        $sp2 = $lor + $sp1;
                    }
                    $from_rtg3_arr_i2 = intval($from_rtg3_arr[2]);
                    $sp3 = $from_rtg3_arr_i2 - $sp2;
                    preg_match_all('!\d+!', $form, $matches);
                    $form_only_digit = $matches[0][count($matches[0])-1];
                    $form_only_one_digit = $form_only_digit[strlen($form_only_digit)-1];
                    $ltg = intval(explode(")", explode("(", $prc)[count(explode("(", $prc))-1])[0]);
                    $col_g = ($lor - $from_rtg3_arr_i2) + ($sp1) + ($from_rtg3_arr_i1 - $form_only_one_digit) + ($ltg);

                    $ltgD = ($ltg-$form_only_one_digit);
                    if($ltgD > 0){
                        $fp = $col_g - $ltgD;
                    }elseif ($ltgD < 0) {
                        $fp = $col_g + $ltgD;
                    }else{
                        $fp = $col_g;
                    }
                    $sh_sp = explode(" ",$h_sp)[0];
                    $sh_sp_ar = explode("/",$sh_sp);

                    $sh_sp_a = $sh_sp_ar[0]/$sh_sp_ar[1];
                    if ($sh_sp_a > $form_only_one_digit) {
                        $fs = $sh_sp_a - $form_only_one_digit;
                    } else {
                        $fs = $sh_sp_a + $form_only_one_digit;
                    }
                    
                    
                @endphp
                <tr>

                    <td style="width: 15%">{{ $prd }}</td>
                    <td style="width: 1% color: blue;font-size: 15px;">{{ $lhn }}</td>
                    <td style="font-size: 15px;width: 2%"><b>{{ $lor - $from_rtg3_arr_i2 }}</b></td>
                    <td></td>
                    <td></td>
                    <td style="font-size: 30px;width: 5%"> <b>{{ $fs }}</b></td>
                    <td><br><b style="color: rgb(0, 225, 255);font-size: 30px;width: 5%"> {{ $sh_sp_a }}</b></td>
                    <td style="font-size: 15px;width: 5%"><b></b></td>
                    <td style="font-size: 15px;width: 5%"><b></b></td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h1>Formula: 14 | {{ $new_rt }}</h1>
    <h1>******************************************************************************************************</h1>
    <table class="table table-bordered" style="page-break-after: always;">
        @php
            $new_rt = intval($last_page[0]['LOR']);
        @endphp
        <thead>
            <tr>
                <th rowspan="3">{{ $time }}</th>
                <th rowspan="3">{{ $time }}</th>
                <th></th>
                <th rowspan="3">{{ $new_rt }}</th>
            </tr>

        </thead>
        <tbody>
            <tr>

                <td>1</b></td>
                <td>2</td>
                <td>RTG</td>
                <td></td>
                <td>P.ODDS</td>
                <td>P.ODDS Result</td>
                <td>C.ODDS</td>
                <td></td>
                <td>F/P</td>
                <td>G</td>
                <td>*</td>
                <td>P.ODDS</td>
            </tr>
            @foreach ($last_page as $k => $item)
                @php
                    $pprd = isset($item['rd1']) ? $item['rd1'] : 0;
                    $pprc = isset($item['rc1']) ? $item['rc1'] : 0;
                    $pphn = isset($item['PPHN']) ? intval($item['PPHN']) : 0;
                    $ppor = isset($item['por1']) ? intval($item['por1']) : 0;

                    $ps1 = $pphn - 1 + $ppor;
                    $ps2 = $ps1 - $pphn;

                    $prd = isset($item['rd0']) ? $item['rd0'] : 0;
                    $prc = isset($item['rc0']) ? $item['rc0'] : 0;
                    $phn = isset($item['PHN']) ? intval($item['PHN']) : 0;
                    $por = isset($item['por0']) ? intval($item['por0']) : 0;
                    $por2 = isset($item['por2']) ? intval($item['por2']) : 0;


                    $h_sp = isset($item['sp0']) ? $item['sp0'] : "0/0";
                    $rc2 = isset($item['rc2']) ? $item['rc2'] : '0/0';

                    $s1 = $phn - 1 + $por;
                    $s2 = $s1 - $phn;

                    $lhn = isset($item['LHN']) ? intval($item['LHN']) : 0;
                    $lor = isset($item['LOR']) ? intval($item['LOR']) : 0;

                    $form = isset($item['form']) ? $item['form'] : '000';
                    $from_array = str_split($item['form']);
                    $new_from_array = [];
                    foreach ($from_array as $key => $value) {
                        if (is_numeric($value)) {
                            array_push($new_from_array, $value);
                        }
                    }

                    try {
                        $_1_3_rtg_1 = explode('<br>', $item[$item['PHN'] . '2']);
                        $_1_3_rtg_2 = explode('<br>', $item[$item['PHN'] . '1']);
                        $_1_3_rtg_3 = explode('<br>', $item[$item['HNAME']]);
                    } catch (\Throwable $th) {
                        $_1_3_rtg_1 = [];
                        $_1_3_rtg_2 = [];
                        $_1_3_rtg_3 = [];
                    }

                    $arr_count = count($new_from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = intval($new_from_array[$arr_count - 3]);
                        $from_rtg1 = isset($_1_3_rtg_1[$pphn_form - 1]) ? $_1_3_rtg_1[$pphn_form - 1] : '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = intval($new_from_array[$arr_count - 2]);
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = isset($_1_3_rtg_2[$phn_form - 1]) ? $_1_3_rtg_2[$phn_form - 1] : '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($new_from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                        $from_rtg1 = '0 0 0';
                        $from_rtg2 = '0 0 0';
                        $from_rtg3 = isset($_1_3_rtg_3[$lhn_form - 1]) ? $_1_3_rtg_3[$lhn_form - 1] : '0 0 0';
                    }

                    $first_rtg_2 = isset($item['first_rtg_2']) ? $item['first_rtg_2'] : 0;
                    $first_rtg_1 = isset($item['first_rtg1']) ? $item['first_rtg1'] : 0;
                    $first_rtg = isset($item['first_rtg']) ? $item['first_rtg'] : 0;

                    $first_pre_rtg2 = $new_rt - intval($first_rtg_2);
                    if ($first_pre_rtg2 < 0) {
                        $sign2 = 'D';
                        $nna2 = $ps2 - abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' - ' . abs($first_pre_rtg2);
                    } else {
                        $sign2 = 'P';
                        $nna2 = $ps2 + abs($first_pre_rtg2);
                        $nnaps2 = $ps2 . ' + ' . abs($first_pre_rtg2);
                    }

                    $first_pre_rtg1 = $new_rt - intval($first_rtg_1);
                    if ($first_pre_rtg1 < 0) {
                        $sign1 = 'D';
                        $nna1 = $s2 - abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' - ' . abs($first_pre_rtg1);
                    } else {
                        $sign1 = 'P';
                        $nna1 = $s2 + abs($first_pre_rtg1);
                        $nnaps1 = $s2 . ' + ' . $first_pre_rtg1;
                    }

                    $first_pre_rtg = $new_rt - intval($first_rtg);
                    if ($first_pre_rtg < 0) {
                        $sign = 'D';
                        $nna = $s2 - abs($first_pre_rtg);
                        $nnaps = $s2 . ' - ' . abs($first_pre_rtg);
                    } else {
                        $sign = 'P';
                        $nna = $s2 + abs($first_pre_rtg);
                        $nnaps = $s2 . ' + ' . $first_pre_rtg;
                    }

                    if ($pphn_form == 3 && $pphn_form == 0) {
                        $v2 = 0;
                    } elseif ($pphn_form == 1) {
                        $v2 = 0;
                    } elseif ($pphn_form == 2) {
                        $v2 = intval(isset($_1_3_rtg_1[1]) ? (isset(explode(' ', $_1_3_rtg_1[1])[2]) ? explode(' ', $_1_3_rtg_1[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[0]) ? (isset(explode(' ', $_1_3_rtg_1[0])[2]) ? explode(' ', $_1_3_rtg_1[0])[2] : 0) : 0);
                    } else {
                        $v2 = intval(isset($_1_3_rtg_1[$pphn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2]) ? explode(' ', $_1_3_rtg_1[$pphn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_1[2]) ? (isset(explode(' ', $_1_3_rtg_1[2])[2]) ? explode(' ', $_1_3_rtg_1[2])[2] : 0) : 0);
                    }

                    if ($v2 == 0) {
                        $vv2 = $nna2;
                        $sgn2 = $nna2 . ' - ' . 0;
                    } elseif ($v2 < 0) {
                        $vv2 = $nna2 - abs($v2);
                        $sgn2 = $nna2 . ' - ' . abs($v2);
                    } else {
                        $vv2 = $nna2 + abs($v2);
                        $sgn2 = $nna2 . ' + ' . abs($v2);
                    }

                    if ($phn_form == 3 && $phn_form == 0) {
                        $v1 = 0;
                    } elseif ($phn_form == 1) {
                        $v1 = 0;
                    } elseif ($phn_form == 2) {
                        $v1 = intval(isset($_1_3_rtg_2[1]) ? (isset(explode(' ', $_1_3_rtg_2[1])[2]) ? explode(' ', $_1_3_rtg_2[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[0]) ? (isset(explode(' ', $_1_3_rtg_2[0])[2]) ? explode(' ', $_1_3_rtg_2[0])[2] : 0) : 0);
                    } else {
                        $v1 = intval(isset($_1_3_rtg_2[$phn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_2[$phn_form - 1])[2]) ? explode(' ', $_1_3_rtg_2[$phn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_2[2]) ? (isset(explode(' ', $_1_3_rtg_2[2])[2]) ? explode(' ', $_1_3_rtg_2[2])[2] : 0) : 0);
                    }

                    if ($v1 == 0) {
                        $vv1 = $nna1;
                        $sgn1 = $nna1 . ' - ' . 0;
                    } elseif ($v1 < 0) {
                        $vv1 = $nna1 - abs($v1);
                        $sgn1 = $nna1 . ' - ' . abs($v1);
                    } else {
                        $vv1 = $nna1 + abs($v1);
                        $sgn1 = $nna1 . ' + ' . abs($v1);
                    }

                    if ($lhn_form == 3 && $lhn_form == 0) {
                        $v3 = 0;
                    } elseif ($lhn_form == 1) {
                        $v3 = 0;
                    } elseif ($lhn_form == 2) {
                        $v3 = intval(isset($_1_3_rtg_3[1]) ? (isset(explode(' ', $_1_3_rtg_3[1])[2]) ? explode(' ', $_1_3_rtg_3[1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[0]) ? (isset(explode(' ', $_1_3_rtg_3[0])[2]) ? explode(' ', $_1_3_rtg_3[0])[2] : 0) : 0);
                    } else {
                        $v3 = intval(isset($_1_3_rtg_3[$lhn_form - 1]) ? (isset(explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2]) ? explode(' ', $_1_3_rtg_3[$lhn_form - 1])[2] : 0) : 0) - intval(isset($_1_3_rtg_3[2]) ? (isset(explode(' ', $_1_3_rtg_3[2])[2]) ? explode(' ', $_1_3_rtg_3[2])[2] : 0) : 0);
                    }

                    if ($v3 == 0) {
                        $vv3 = $nna;
                        $sgn3 = $nna . ' - ' . 0;
                    } elseif ($v3 < 0) {
                        $vv3 = $nna - abs($v3);
                        $sgn3 = $nna . ' - ' . abs($v3);
                    } else {
                        $vv3 = $nna + abs($v3);
                        $sgn3 = $nna . ' + ' . abs($v3);
                    }
                    $vv3 = intval($vv3);
                    $c5 = $vv3 - intval(explode(' ', $_1_3_rtg_3[2])[2]);
                    $c6 = intval($first_rtg) - intval($vv3);
                    if ($c6 == 0) {
                        $c7 = $c5;
                    } elseif ($c6 < 0) {
                        $c7 = $c5 - abs($c6);
                    } else {
                        $c7 = abs($c6) + $c5;
                    }

                    if ($c7 == 0) {
                        $c8 = $vv3;
                    } elseif ($c7 < 0) {
                        $c8 = intval($vv3) - intval(abs($c7));
                    } else {
                        $c8 = intval(abs($c7)) + intval($vv3);
                    }

                    $c9 = intval($first_rtg) - $c7;

                    $z2 = intval($first_rtg) - intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $z3 = $vv3 - $_133;
                    if ($z3 == 0) {
                        $z4 = $z2;
                    } elseif ($z3 < 0) {
                        $z4 = abs($z3) - $z2;
                    } else {
                        $z4 = abs($z3) + $z2;
                    }
                    $z7 = abs($z6_arr[$k]);
                    $z8 = abs($c9 - $vv3);

                    if ($z6_arr[$k] < 0) {
                        $s1 = '-';
                    } else {
                        $s1 = '';
                    }

                    if ($z7 > $z8) {
                        $z9 = $z7 - $z8;
                        $p01 = '  ';
                        if ($s1 == '-') {
                            $z10 = $z9;
                        } else {
                            $z10 = '-' . $z9;
                        }
                    } else {
                        $z9 = '  ';
                        $z10 = $z8 - $z7;
                        $p01 = $z6_arr[$k];
                    }

                    $ss4 = intval(explode(' ', $_1_3_rtg_3[0])[2]);
                    $s5 = $ss4 - intval($c9);
                    $s6 = intval($vv3 + $c7) - intval($c9);
                    $s7 = abs($s6) - abs($s5);
                    if (abs($s6) < abs($s5)) {
                        $s56_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s56_sing = $s5 < 0 ? '-' : '';
                    }

                    $from_rtg3_arr_i1 = intval($from_rtg3_arr[1]);
                    $from_rtg3_arr = explode(" ",$from_rtg3);
                    $sp1 = $from_rtg3_arr_i1 - $lhn;
                    if ($sp1 < 0) {
                        $sp2 = $lor - abs($sp1);
                    } else {
                        $sp2 = $lor + $sp1;
                    }
                    $from_rtg3_arr_i2 = intval($from_rtg3_arr[2]);
                    $sp3 = $from_rtg3_arr_i2 - $sp2;
                    preg_match_all('!\d+!', $form, $matches);
                    $form_only_digit = $matches[0][count($matches[0])-1];
                    $form_only_one_digit = $form_only_digit[strlen($form_only_digit)-1];
                    $ltg = intval(explode(")", explode("(", $prc)[count(explode("(", $prc))-1])[0]);
                    $col_g = ($lor - $from_rtg3_arr_i2) + ($sp1) + ($from_rtg3_arr_i1 - $form_only_one_digit) + ($ltg);

                    $ltgD = ($ltg-$form_only_one_digit);
                    if($ltgD > 0){
                        $fp = $col_g - $ltgD;
                    }elseif ($ltgD < 0) {
                        $fp = $col_g + $ltgD;
                    }else{
                        $fp = $col_g;
                    }
                    $sh_sp = explode(" ",$h_sp)[0];
                    $sh_sp_ar = explode("/",$sh_sp);

                    $sh_sp_a = intval($sh_sp_ar[0])/intval($sh_sp_ar[1]);
                    if ($fp > $sh_sp_a) {
                        $fps = $fp;
                    } else {
                        $fps = $sh_sp_a - intval($fp);
                    }
                    
                    
                @endphp
                <tr>

                    <td style="width: 15%">{{ $prd }}</td>
                    <td style="width: 1% color: blue;font-size: 15px;">{{ $lhn }}</td>
                    
                    <td style="font-size: 15px;width: 2%"><b>{{ $lor - $from_rtg3_arr_i2 }}</b></td>
                    <td><br><b style="font-size: 30px;width: 5%"> </b></td>
                    <td><br><b style="font-size: 30px;width: 5%"> </b></td>
                    <td><br><b style="font-size: 40px;width: 5%"> </b><b>{{ $fps }}</b></td>
                    <td><br><b style="color: rgb(0, 225, 255);font-size: 30px;width: 5%"> {{ $sh_sp_a }}</b></td>
                    <td style="font-size: 15px;width: 5%"><b></b></td>
                    <td style="font-size: 15px;width: 5%"><b></b></td>
                    <td style="width: 6%"> <b style="color: rgb(160, 5, 250);font-size: 50px;">{{ $form_only_one_digit }}/{{ $fp }}</b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                    <td><br><b style="font-size: 30px;"></b></td>
                    <td><br><b style="font-size: 30px;"></b></td>

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
