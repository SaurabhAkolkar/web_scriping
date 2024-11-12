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

    <table class="table table-bordered" style="page-break-after: always;">
        <tbody>
            <tr>
                <th>Horse Name</th>
                <th>PPHN</th>
                <th>PPOR</th>
                <th>PPD</th>
                <th>PPclass</th>
                <th style="text-align: right;">PHN</th>
                <th>POR</th>
                <th>Pdist</th>
                <th>Pclass</th>
                <th>LHN</th>
                <th>LOR</th>
                <th>form</th>
                <th></th>
            </tr>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                $data_second_table = [];
                $formula9_data = [];
                $formula10_data = [];
            @endphp
            @foreach ($last_page as $k => $item)
                @php

                    if (!isset($item['prtg2'])) {
                        $prtg2 = 0;
                    } else {
                        $prtg2 = $item['prtg2'];
                    }

                    if ($item['rt']) {
                        if (isset(str_split($item['rt'], 2)[1])) {
                            $rt = str_split($item['rt'], 2)[1];
                        } else {
                            $rt = str_split($item['rt'], 1)[1];
                        }
                    } else {
                        $rt = 0;
                    }
                    $hourse_name = explode(' ', $item['hname'])[0];
                    $from_array = explode('-', $item['form']);

                    $arr_count = count($from_array);
                    if ($arr_count > 2) {
                        $lhn_form = intval($from_array[$arr_count - 1]);
                        $phn_form = intval($from_array[$arr_count - 2]);
                        $pphn_form = intval($from_array[$arr_count - 3]);
                    } elseif ($arr_count > 1) {
                        $lhn_form = intval($from_array[$arr_count - 1]);
                        $phn_form = intval($from_array[$arr_count - 2]);
                        $pphn_form = 0;
                    } elseif ($arr_count > 0) {
                        $lhn_form = intval($from_array[$arr_count - 1]);
                        $phn_form = 0;
                        $pphn_form = 0;
                    }

                    $dwin3 = isset($item['dwin3']) ? intval($item['dwin3']) : 0;
                    $dwin2 = isset($item['dwin2']) ? intval($item['dwin2']) : 0;
                    $dwin1 = isset($item['dwin1']) ? $item['dwin1'] : 0;

                    $wt3 = isset($item['wt3']) ? intval($item['wt3']) : 0;
                    $wt2 = isset($item['wt2']) ? intval($item['wt2']) : 0;
                    $wt1 = isset($item['wt1']) ? intval($item['wt1']) : 0;

                    $phn3 = isset($item['phn3']) ? intval($item['phn3']) : 0;
                    $phn2 = isset($item['phn2']) ? intval($item['phn2']) : 0;
                    $phn1 = isset($item['phn1']) ? intval($item['phn1']) : 0;

                    $prtg3 = isset($item['prtg3']) ? intval($item['prtg3']) : 0;
                    $prtg2 = isset($item['prtg2']) ? intval($item['prtg2']) : 0;
                    $prtg1 = isset($item['prtg1']) ? intval($item['prtg1']) : 0;

                    $formdiwn3 = intval($pphn_form - $dwin3);
                    $yellow_est = $phn2 - 1 + $prtg2 - $phn2;

                    if ($formdiwn3 == 0) {
                        $a2 = $yellow_est;
                    } elseif ($formdiwn3 < 0) {
                        $a2 = $yellow_est - abs($formdiwn3);
                    } else {
                        $a2 = $yellow_est + abs($formdiwn3);
                    }

                    $prd1 = isset($item['pdr1']) ? intval(isset($item['pdr1'])) : 0;
                    $prd2 = isset($item['pdr2']) ? intval(isset($item['pdr2'])) : 0;

                    $formdiwn2 = intval($phn_form - $dwin2);
                    $yellow_est1 = $phn1 - 1 + $prtg1 - $phn1;

                    if ($formdiwn2 == 0) {
                        $a1 = $yellow_est1;
                    } elseif ($formdiwn2 < 0) {
                        $a1 = $yellow_est1 - abs($formdiwn2);
                    } else {
                        $a1 = $yellow_est1 + abs($formdiwn2);
                    }

                    $allprirtg = isset($item[$item['phn1']]) && $item[$item['phn1']] != '' ? $item[$item['phn1']] : 0;

                    $pp_rtg_all_array = explode('<br>', $allprirtg);
                    $_pp_first_rtg = isset($pp_rtg_all_array[0]) ? $pp_rtg_all_array[0] : '0 0 0';
                    $_pp_third_rtg = isset($pp_rtg_all_array[2]) ? $pp_rtg_all_array[2] : '0 0 0';
                    $_pp_rtg = isset($pp_rtg_all_array[$phn_form - 1]) ? $pp_rtg_all_array[$phn_form - 1] : 0;

                    $_allprirtg = isset($item['final1' . $hourse_name]) ? $item['final1' . $hourse_name] : 0;
                    $p_rtg_all_array = explode('<br>', $_allprirtg);
                    $_p_first_rtg = isset($p_rtg_all_array[0]) ? $p_rtg_all_array[0] : '0 0 0';
                    $_p_third_rtg = isset($p_rtg_all_array[2]) ? $p_rtg_all_array[2] : '0 0 0';
                    $_p_rtg = isset($p_rtg_all_array[$lhn_form - 1]) ? $p_rtg_all_array[$lhn_form - 1] : 0;

                    $lrtg_no2 = isset($item['lrtg_no2']) ? $item['lrtg_no2'] : 0;
                    $lrtg_no1 = isset($item['lrtg_no1']) ? $item['lrtg_no1'] : 0;

                    $lrtg_line2 = isset($item['lrtg_line2']) ? $item['lrtg_line2'] : '0 0 0';
                    $lrtg_line1 = isset($item['lrtg_line1']) ? $item['lrtg_line1'] : '0 0 0';

                    $neewrtlrtgno2 = $new_rt - $lrtg_no2;

                    if ($neewrtlrtgno2 == 0) {
                        $sing2 = 'SC';
                        $nna2 = $yellow_est;
                    } elseif ($neewrtlrtgno2 < 0) {
                        $sing2 = 'Demotion';
                        $nna2 = $yellow_est - abs($neewrtlrtgno2);
                    } else {
                        $sing2 = 'Promotion';
                        $nna2 = $yellow_est + abs($neewrtlrtgno2);
                    }

                    $neewrtlrtgno1 = $new_rt - $lrtg_no1;

                    if ($neewrtlrtgno1 == 0) {
                        $sing1 = 'SC';
                        $nna1 = $yellow_est1;
                    } elseif ($neewrtlrtgno1 < 0) {
                        $sing1 = 'Demotion';
                        $nna1 = $yellow_est1 - abs($neewrtlrtgno1);
                    } else {
                        $sing1 = 'Promotion';
                        $nna1 = $yellow_est1 + abs($neewrtlrtgno1);
                    }

                    if ($phn_form == 1) {
                        $lll = 0;
                    } elseif ($phn_form == 2) {
                        $from_first_rtg = explode(' ', $_pp_first_rtg)[2];
                        $from_second_rtg = explode(' ', $pp_rtg_all_array[$phn_form - 1])[2];
                        $lll = $from_second_rtg - $from_first_rtg;
                    } else {
                        $asf = isset($pp_rtg_all_array[2]) ? $pp_rtg_all_array[2] : '0 0 0';
                        $from_third_rtg = explode(' ', $asf)[2];
                        $aaaf = isset($pp_rtg_all_array[$phn_form - 1]) ? $pp_rtg_all_array[$phn_form - 1] : '0 0 0';
                        $from_rtg = explode(' ', $aaaf)[2];
                        $lll = $from_rtg - $from_third_rtg;
                    }

                    if ($lll == 0) {
                        $v2 = $nna2;
                    } elseif ($lll < 0) {
                        $v2 = $nna2 - abs($lll);
                    } else {
                        $v2 = $nna2 + abs($lll);
                    }

                    $from_first_rtg = isset(explode(' ', $_p_first_rtg)[2]) ? explode(' ', $_p_first_rtg)[2] : 0;
                    $_3rtg = explode(' ', $_p_third_rtg)[2];

                    if ($lhn_form == 1) {
                        $l1 = 0;
                    } elseif ($lhn_form == 3) {
                        $l1 = 0;
                    } elseif ($lhn_form == 2) {
                        $from_first_rtg = explode(' ', $_p_first_rtg)[2];
                        $from_second_rtg = explode(' ', $p_rtg_all_array[$lhn_form - 1])[2];
                        $l1 = $from_second_rtg - $from_first_rtg;
                    } else {
                        $asf = isset($p_rtg_all_array[2]) ? $p_rtg_all_array[2] : '0 0 0';
                        $from_third_rtg = explode(' ', $asf)[2];
                        $aaaf = isset($p_rtg_all_array[$lhn_form - 1]) ? $p_rtg_all_array[$lhn_form - 1] : '0 0 0';
                        $from_rtg = explode(' ', $aaaf)[2];
                        $l1 = $from_rtg - $from_third_rtg;
                    }

                    if ($l1 == 0) {
                        $v1 = $nna1;
                    } elseif ($l1 < 0) {
                        $v1 = $nna1 - abs($l1);
                    } else {
                        $v1 = $nna1 + abs($l1);
                    }

                    $class_name = isset($item['class_name']) ? $item['class_name'] : 0;

                    $key = $from_first_rtg . (count($last_page) - $k);

                    $c6 = $lrtg_no1 - $from_first_rtg;

                    $c7 = $v1 - $_3rtg;
                    if ($c7 == 0) {
                        $c8 = $c6;
                    } elseif ($c7 < 0) {
                        $c8 = abs($c7) - $c6;
                    } else {
                        $c8 = abs($c7) + $c6;
                    }

                    $c9 = $lrtg_no1 - $c8;

                    $data_second_table[$key] = [
                        $from_first_rtg,
                        explode('(', $item['no'])[0],
                        $lrtg_no1,
                        $_3rtg,
                        $v1,
                        '  ',
                        $c6,
                        '  ',
                        $c7,
                        '   ',
                        $c8,
                        '    ',
                        '     ',
                        $_3rtg,
                        '=====',
                        $lrtg_no1,
                        $c8,
                        $c9,
                        '*****',
                        '  ',
                        '  ',
                        '  ',
                        '  ',
                        '  ',
                        $class_name,
                        $sing1,
                    ];
                    $d1 = intval($lrtg_no1) - intval($v1);

                    if ($d1 == 0) {
                        $d2 = $c7;
                    } elseif ($d1 < 0) {
                        $d2 = $c7 - abs($d1);
                    } else {
                        $d2 = abs($d1) + $c7;
                    }

                    if ($d2 == 0) {
                        $d3 = $v1;
                    } elseif ($d2 < 0) {
                        $d3 = $v1 - abs($d2);
                    } else {
                        $d3 = abs($d2) + $v1;
                    }

                    $d4 = $lrtg_no1 - $d2;
                    $d5 = $c9 - $v1;
                    $d6 = $d4 - $v1;
                    if ($d5 < 0) {
                        $d01 = '-';
                    } else {
                        $d01 = '';
                    }

                    if ($d6 < 0) {
                        $d02 = '-';
                    } else {
                        $d02 = '';
                    }

                    $d7 = abs($d5);
                    $d8 = abs($d6);
                    if ($d7 > $d8) {
                        $d9 = $d7 - $d8;
                        if ($d01 == '-') {
                            $d10 = $d9;
                        } else {
                            $d10 = '-' . $d9;
                        }
                        $d9 = $d01 . $d9;
                        $p01 = '';
                    } else {
                        $d9 = '        ';
                        $d10 = $d8 - $d7;
                        $p01 = $d5;
                        $d10 = $d02 . $d10;
                    }

                    if ($item['rt']) {
                        if (isset(str_split($item['rt'], 2)[1])) {
                            $new_rt_6 = str_split($item['rt'], 2)[1];
                        } else {
                            $new_rt_6 = str_split($item['rt'], 1)[1];
                        }
                    } else {
                        $new_rt_6 = 0;
                    }

                    $data_second_table1[$key] = [
                        $from_first_rtg,
                        explode('(', $item['no'])[0],
                        $lrtg_no1,
                        $_3rtg,
                        $v1,
                        '  ',
                        '  ',
                        $c7,
                        '   ',
                        $d1,
                        '    ',
                        $d2,
                        '     ',
                        $d3,
                        '=====',
                        $lrtg_no1,
                        $d2,
                        $d4,
                        '*****',
                        $d5,
                        $d6,
                        $d9,
                        $d10,
                        $p01,
                        $class_name,
                        $sing1,
                        $v1,
                        $d2,
                        $v1 - $d2,
                        '                              ',
                        '                           ',
                        '                       ',
                        $d4,
                        '              ',
                    ];
                    $s5 = $v1 + $d2;
                    $s6 = $s5 - $_3rtg;
                    $s7 = $new_rt_6 - $_3rtg;
                    if (abs($s6) < abs($s7)) {
                        $s67_sing = $s6 < 0 ? '-' : '';
                    } else {
                        $s67_sing = $s7 < 0 ? '-' : '';
                    }
                    $s8 = $s67_sing . ($s6 - $s7);

                    $data_second_table2[$key] = [
                        explode('(', $item['no'])[0],
                        $class_name,
                        explode('(', $item['no'])[0],
                        $s7,
                        $s6,
                        $item['form'],
                        $s8,
                        '                                                            ',
                        $new_rt_6,
                        explode('(', $item['no'])[0],
                        $d2,
                        $v1,
                        '                              ',
                        '                           ',
                        $_3rtg,
                        $s5,
                        '                              ',
                    ];
                    $prtg_arr = explode(' ', $_p_rtg);
                    $prtg_a2 = isset($prtg_arr[2]) ? $prtg_arr[2] : 0;
                    $prtg_a1 = isset($prtg_arr[1]) ? $prtg_arr[1]: 0 ;
                    $prtg_a0 = isset($prtg_arr[0]) ? $prtg_arr[0] : 0;
                    $_1 = explode('(', $item['no'])[0];
                    $current_rating = $item['current_rating'];
                    $_s_1 = $prtg_a1 - $_1;
                    if ($_s_1 < 0) {
                        $_s_2 = $current_rating - abs($_s_1);
                    } else {
                        $_s_2 = $current_rating + abs($_s_1);
                    }
                    $_s_3 = $prtg_a2 - $current_rating;
                    $_s_4 = $prtg_a2 - $_s_2;
                    $data_second_table3[$key] = [
                        $_1,
                        $class_name,
                        $_1,
                        ' ',
                        $prtg_a2,
                        ' ',
                        $wt1,
                        ' ',
                        $prtg_a1,
                        $_1 . '<br>' . $_s_1,
                        ' ',
                        $_s_1,
                        ' ',
                        ' ',
                        $prtg_a0 . '<br>' . ($prtg_a0 - $_s_1),
                        ' ',
                        $prtg_a0 - $_s_1,
                        ' ',
                        ' ',
                        ' ',
                    ];
                    $data_second_table4[$key] = [
                        $_1,
                        $class_name,
                        $_1,
                        ' ',
                        '  ',
                        $_s_3,
                        $prtg_a2,
                        $current_rating,
                        '  ',
                        $_s_2,
                        '  ',
                        $_s_4,
                        ' ',
                        $prtg_a1,
                        $_1 . '<br>' . $_s_1,
                        ' ',
                        $prtg_a0 . '<br>' . ($prtg_a0 - $_s_1),
                    ];

                    $data_second_table5[$key] = [
                        $_1,
                        $class_name,
                        $_1,
                        '   ',
                        $prtg_a1,
                        $_1 . '<br>' . $_s_1,
                        ' ',
                        $prtg_a0 . '<br>' . ($prtg_a0 - $_s_1),
                        '  ',
                        $_1,
                        '   ',
                        '    ',
                        '  ',
                        '  ',
                        '  ',
                        '  ',
                        '  ',
                        $_s_1,
                        '  ',
                        $prtg_a0,
                    ];

                    $data_second_table6[$key] = [
                        $_1,
                        $class_name,
                        $_1,
                        '        ',
                        '        ',
                        $current_rating - $prtg_a2,
                        '      ',
                        '       ',
                        $_s_1,
                        $prtg_a1 - $prtg_a0,
                        '    ',
                        '     ',
                        '    ',
                        $prtg_a0,
                    ];
                    $current_dist = $item['current_distance'];
                    $p_distance = isset($item['dist1']) ?  $item['dist1'] : 0;
                    $dist_ans = str_replace('0', '', $current_dist - $p_distance);
                    $rtg = $current_rating - $prtg_a2;
                    $all_ans = $rtg + $_s_1 + ($prtg_a1 - $prtg_a0) + $dwin1;
                    $all_ans1 = $rtg + $_s_1 + ($prtg_a1 - $prtg_a0) + $dwin2;
                    $codds = isset($item['codds']) ? $item['codds'] : 0;
                    $data_second_table7[$key] = [
                        $_1,
                        $class_name,
                        '            ',
                        $_1,
                        $p_distance,
                        $current_dist,
                        $dist_ans,
                        '        ',
                        $rtg,
                        $_s_1,
                        $prtg_a1 - $prtg_a0,
                        $dwin1,
                        '           ',
                        $prtg_a0,
                        $all_ans,
                        '     ',
                        '    ',
                        '    ',
                        $codds,
                    ];

                    $ltgD = $dwin1 - $prtg_a0;

                    if ($ltgD > 0) {
                        $fa = $all_ans - abs($ltgD);
                    } elseif ($ltgD < 0) {
                        $fa = $all_ans + abs($ltgD);
                    } else {
                        $fa = $all_ans;
                    }

                    $data_second_table8[$key] = [
                        $dist_ans,
                        $_1,
                        $class_name,
                        '            ',
                        $_1,
                        $dist_ans,
                        $codds,
                        '        ',
                        $dwin1,
                        '           ',
                        $prtg_a0,
                        $all_ans,
                        '     ',
                        $fa,
                        '           ',
                    ];

                    $date1 = isset($item['date1']) ? $item['date1'] : "";
                    $date2 = isset($item['date2']) ? $item['date2'] : "";
                    $data_second_table9[$key] = [
                        $dist_ans,
                        $_1,
                        $item['hname'],
                        $class_name,
                        $codds,
                        '        ',
                        $date1,
                        $dwin1,
                        '           ',
                        $prtg_a0,
                        $fa,
                        (abs($dwin1)+abs($prtg_a0)+abs($fa)),
                        '                  ',
                        "                  "
                    ];

                    $formula9_team1 = [
                        "                  ",
                        $_1,
                        $item['hname'],
                        $class_name,
                        $codds,
                        "                  ",
                        $date1,
                        $dwin1,
                        "                  ",
                        $prtg_a0,
                        $fa,
                        (abs($dwin1)+abs($prtg_a0)+abs($fa)),
                        "                  ",
                        "                  ",
                        "                  ",
                        "                  ",
                        "                  ",
                        "                  ",
                        "                  ",
                        "                  ",
                        "                  ",
                        "                  ",
                        ($dwin1-$prtg_a0),
                        "                  "
                    ];
                    $phourse_no1 = $phn2-$phn1;
                    $phourse_no2 = $phn3-$phn2;
                    $class_name2 = isset($item['class_name2']) ? $item['class_name2'] : "";
                    $ciodds = isset($item['ciodds']) ? $item['ciodds'] : 0;
                    $pi2 = isset($item['pi2']) ? $item['pi2'] : 0;
                    
                    $formula9_team2 = [
                        "                  ",
                        "                  ",
                        "                  ",
                        $class_name2,
                        $ciodds,
                        "                  ",
                        $date2,
                        $dwin2,
                        "                  ",
                        $pi2,
                        "                  ",
                        "                  ",
                        "                  ",
                        $phourse_no1,
                        ($pi2-$phourse_no1),
                        ($phn1-($pi2-$phourse_no1)),
                        "                  ",
                        ($prtg1-$prtg2),
                        $phourse_no1,
                        ($phn1-($pi2-$phourse_no1)),
                         $dwin2,
                         (($prtg1-$prtg2) + $phourse_no1 +  ($phn1-($pi2-$phourse_no1)) + $dwin2),
                        ($dwin2-$pi2),
                        (((($prtg1-$prtg2) + $phourse_no1 +  ($phn1-($pi2-$phourse_no1)) + $dwin2)) - ($dwin2-$pi2))
                    ];
                    
                    
                    
                    $class_name3 = isset($item['class_name3']) ? $item['class_name3'] : " ";
                    $ciodds3 =  isset($item['ciodds3']) ? $item['ciodds3'] : 0; 
                    $date3 = isset($item['date3']) ? $item['date3']: "";
                    $pi3 = isset($item['pi3']) ? $item['pi3'] : 0;
                    


                    $formula9_team3 = [
                        "                  ",
                        "                  ",
                        "                  ",
                        $class_name3,
                        $ciodds3,
                        "                  ",
                        $date3,
                        $dwin3,
                        "                  ",
                        $pi3,
                        "                  ",
                        "                  ",
                        "                  ",
                        $phourse_no2,
                        ($pi3-$phourse_no2),
                        ($phn1-($pi3-$phourse_no2)),
                        "                  ",
                        ($prtg2-$prtg3),
                        $phourse_no2,
                        ($phn1-($pi3-$phourse_no2)),
                        $dwin3,
                        (($prtg2-$prtg3) + $phourse_no2 + ($phn1-($pi3-$phourse_no2)) + $dwin3),
                        ($dwin3-$pi3),
                        ((($prtg2-$prtg3) + $phourse_no2 + ($phn1-($pi3-$phourse_no2)) + $dwin3) - ($dwin3-$pi3))
                    ];

                    array_push($formula9_data,$formula9_team1);
                    array_push($formula9_data,$formula9_team2);
                    array_push($formula9_data,$formula9_team3);

                    
                    
                    // 10 start 

                    $formula10_team1 = [
                        "                  ",
                        $_1,
                        $item['hname'],
                        $class_name,
                        $codds,
                        "                  ",
                        $date1,
                        $dwin1,
                        "                  ",
                        $prtg_a0,
                        $fa,
                        (abs($dwin1)+abs($prtg_a0)+abs($fa)),
                        "                  "
                    ];
                    $phourse_no1 = $phn2-$phn1;
                    $phourse_no2 = $phn3-$phn2;
                    
                    $formula10_team2 = [
                        "                  ",
                        "                  ",
                        "                  ",
                        $class_name2,
                        $ciodds,
                        "                  ",
                        $date2,
                        $dwin2,
                        "                  ",
                        $pi2,
                        (((($prtg1-$prtg2) + $phourse_no1 +  ($phn1-($pi2-$phourse_no1)) + $dwin2)) - ($dwin2-$pi2)),
                        ($dwin2 + $pi2 + (((($prtg1-$prtg2) + $phourse_no1 +  ($phn1-($pi2-$phourse_no1)) + $dwin2)) - ($dwin2-$pi2))),
                        "                  "
                    ];

                    $formula10_team3 = [
                        "                  ",
                        "                  ",
                        "                  ",
                        $class_name3,
                        $ciodds3,
                        "                  ",
                        $date3,
                        $dwin3,
                        "                  ",
                        $pi3,
                        ((($prtg2-$prtg3) + $phourse_no2 + ($phn1-($pi3-$phourse_no2)) + $dwin3) - ($dwin3-$pi3)),
                        ($dwin3 + $pi3 + ((($prtg2-$prtg3) + $phourse_no2 + ($phn1-($pi3-$phourse_no2)) + $dwin3) - ($dwin3-$pi3))),
                        "                  "

                    ];

                    array_push($formula10_data,$formula10_team1);
                    array_push($formula10_data,$formula10_team2);
                    array_push($formula10_data,$formula10_team3);
                   
                @endphp
                <tr>
                    <td style="width: 4.33%">{{ $item['hname'] }}</td>
                    <td style="text-align: center;font-size: 2em;width: 2.33%">
                        <b> {{ $phn2 }} </b> <br> ({{ $prd1 }})
                        <br>
                        <b style="color: brown">{{ $phn2 - 1 + intval($prtg2) }} </b>
                        <br>
                        <b style="color: rgb(82, 238, 10)">{{ $yellow_est }}</b>
                    </td>
                    <td style="width: 4.33%;font-size: x-small;">
                        {{ $prtg2 }} <br>
                        {!! $allprirtg !!}
                    </td>
                    <td style="width: 3.33%">
                        @if (isset($item['dist2']))
                            {{ $item['dist2'] }} <br>
                            <b style="color: rgb(44, 42, 165)">{{ $pphn_form }} - {{ $dwin3 }}</b> <br>
                            <b style="text-align: center;">{{ $new_rt }} - {{ $lrtg_no2 }}</b> <br>
                            <b style="text-align: center;">{{ $yellow_est }} {{ $neewrtlrtgno2 }}</b> <br>
                            <b style="text-align: center;">{{ $nna2 }} {{ $lll }}</b> <br>
                            <b style="text-align: center;color:red;font-size: 2em;">({{ $v2 }})</b> <br><br>
                            <b style="text-align: center;color:red">{{ $sing2 }}</b> <br>
                        @else
                            <b style="color: rgb(44, 42, 165)">{{ $pphn_form }} - {{ $dwin3 }}</b> <br>
                            <b style="text-align: center;">{{ $new_rt }} - {{ $lrtg_no2 }}</b> <br>
                            <b style="text-align: center;">{{ $yellow_est }} {{ $neewrtlrtgno2 }}</b> <br>
                            <b style="text-align: center;">{{ $nna2 }} {{ $lll }}</b> <br>
                            <b style="text-align: center;color:red;font-size: 2em;">({{ $v2 }})</b> <br><br>
                            <b style="text-align: center;color:red">{{ $sing2 }}</b> <br>
                        @endif
                    </td>
                    <td style="width: 4.33%">
                        @if (isset($item['class_name2']))
                            {{ $item['class_name2'] }} <br> <br>
                            <b style="color:red">{{ $yellow_est }}</b> <br>
                            {{ $lrtg_line2 }} <br>
                            {{ $_pp_third_rtg }} <br>
                            {{ $_pp_rtg }}
                        @else
                            <b style="color:red">{{ $yellow_est }}</b> <br>
                            {{ $lrtg_line2 }} <br>
                            {{ $_pp_third_rtg }} <br>
                            {{ $_pp_rtg }}
                        @endif
                    </td>
                    {{-- <td style="background-color: rgb(241, 228, 37);width: 4.33%"></td> --}}
                    <td style="text-align: right;font-size: 2em;width: 2%">
                        @if (isset($item['phn1']))
                            {{ $item['phn1'] }} <br>
                            @if (isset($item['pdr']))
                                ({{ $item['pdr'] }}) <br>
                            @endif
                            <b style="color: brown">{{ $item['phn1'] - 1 + $prtg1 }} </b>
                            <br>
                            <b style="color: rgb(82, 238, 10)">{{ $item['phn1'] - 1 + $prtg1 - $item['phn1'] }}
                            </b>
                        @else
                            NA
                        @endif
                    </td>
                    <td style="width: 4.33%;font-size: x-small;">
                        @if (isset($item['prtg1']))
                            {{ $item['prtg1'] }}<br>
                            {!! $item['final1' . $hourse_name] !!}
                        @else
                            NA
                        @endif
                    </td>
                    <td style="width: 3.33%">
                        @if (isset($item['dist1']))
                            {{ $item['dist1'] }} <br>
                            <b style="color: rgb(44, 42, 165)">{{ $phn_form }} - {{ $dwin2 }}</b> <br>
                            <b style="text-align: center;">{{ $new_rt }} - {{ $lrtg_no1 }}</b> <br>
                            <b style="text-align: center;">{{ $yellow_est1 }} {{ $neewrtlrtgno1 }}</b> <br>
                            <b style="text-align: center;">{{ $nna1 }} {{ $l1 }}</b> <br>
                            <b style="text-align: center;color:red;font-size: 2em;">({{ $v1 }})</b> <br><br>
                            <b style="text-align: center;color:red">{{ $sing1 }}</b> <br>
                        @else
                            <b style="color: rgb(44, 42, 165)">{{ $phn_form }} - {{ $dwin2 }}</b> <br>
                            <b style="text-align: center;">{{ $new_rt }} - {{ $lrtg_no1 }}</b> <br>
                            <b style="text-align: center;">{{ $yellow_est1 }} {{ $neewrtlrtgno1 }}</b> <br>
                            <b style="text-align: center;">{{ $nna1 }} {{ $l1 }}</b> <br>
                            <b style="text-align: center;color:red;font-size: 2em;">({{ $v1 }})</b> <br><br>
                            <b style="text-align: center;color:red;">{{ $sing1 }}</b> <br>
                        @endif
                    </td>
                    <td style="width: 4.33%">
                        @if (isset($item['class_name']))
                            {{ $item['class_name'] }} <br> <br>
                            <b style="color: red">
                                {{ $yellow_est1 }}
                            </b> <br>
                            {{ $lrtg_line1 }} <br>
                            {{ $_p_third_rtg }} <br>
                            {{ $_p_rtg }}
                        @else
                            <b style="color: red">
                                {{ $yellow_est1 }}
                            </b> <br>
                            {{ $lrtg_line1 }} <br>
                            {{ $_p_third_rtg }} <br>
                            {{ $_p_rtg }}
                        @endif
                    </td>
                    {{-- <td style="color:yellow;background-color: rgb(241, 228, 37);width: 2.33%"></td> --}}
                    <td style="text-align: center;width: 5%">

                        <b style="font-size: 2em;">{{ explode('(', $item['no'])[0] }} <br>

                            ({{ explode('(', $item['no'])[1] }}</b> <br>

                        <b style="color: brown;font-size: 2em;">
                            {{ explode('(', $item['no'])[0] - 1 + $rt }} </b> <br> <br>
                        <b style="color: rgb(44, 42, 165)">{{ $lhn_form }} - {{ $dwin1 }}</b>
                    </td>
                    <td style="width: 2.33%">{{ $item['rt'] }}</td>
                    {{-- <td style="color:yellow;background-color: rgb(241, 228, 37);width: 2.33%"></td> --}}
                    <td style="width: 8.33%">{{ $item['form'] }}</td>
                    <td style="width: 10.33%"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                krsort($data_second_table);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>

            @foreach ($data_second_table as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: end">{{ $i }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                krsort($data_second_table1);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>
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
                <td>25</td>
                <td>26</td>
                <td>27<b>(F)</b></td>
                <td>28<b>(D)</b></td>
                <td>29<b>(A)</b></td>
                <td>30</td>
                <td>31</td>
                <td>32 </td>
                <td>33<b>(3rd)</b></td>
                <td>34</td>
            </tr>
            @foreach ($data_second_table1 as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: start">{{ $i }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                krsort($data_second_table2);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>
            <tr>
                <td>2</td>
                <td>3 <b>(T)</b> </td>
                <td>hno</td>
                <td>A</td>
                <td>B</td>
                <td>C</td>
                <td>D</td>
                <td>E</td>
                <td>F</td>
                <td>G</td>
                <td>28<b>(D)</b></td>
                <td>27<b>(F)</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($data_second_table2 as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: start;">{{ $i }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Formula: 2</h1>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                // krsort($data_second_table3);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>
            <tr>
                <td>1</td>
                <td>2 <b>(T)</b> </td>
                <td>3 hno</td>
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
                <td>20</td>
            </tr>
            @foreach ($data_second_table3 as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: start;">{!! $i !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Formula: 3</h1>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                // krsort($data_second_table3);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>
            <tr>
                <td>1</td>
                <td>2 <b>(T)</b> </td>
                <td>3 hno</td>
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
                <td>20</td>
                <td>21</td>
                <td>22</td>
                <td>23</td>
                <td>24</td>
            </tr>
            @foreach ($data_second_table4 as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: start;">{!! $i !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Formula: 4</h1>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                // krsort($data_second_table3);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>
            <tr>
                <td>1</td>
                <td>2 <b>(T)</b> </td>
                <td>3 hno</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>0</td>
                <td>P</td>
                <td>C</td>
                <td>D</td>
                <td>0</td>
                <td>0</td>
            </tr>
            @foreach ($data_second_table5 as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: start;">{!! $i !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Formula: 5</h1>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                // krsort($data_second_table3);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>
            <tr>
                <td>1</td>
                <td>2 <b>(T)</b> </td>
                <td>3 hno</td>
                <td>4</td>
                <td>Class **</td>
                <td>RTG **</td>
                <td></td>
                <td>LTG ***</td>
                <td>T/S ****</td>
                <td>F/P ****</td>
                <td></td>
                <td>ANS **</td>
                <td></td>

            </tr>
            @foreach ($data_second_table6 as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: start;">{!! $i !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Formula: 6</h1>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                // krsort($data_second_table3);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>
            <tr>
                <td>1</td>
                <td>2 <b>(T)</b> </td>
                <td>CLASS ***</td>
                <td>3 hno</td>

                <td>P.Dist</td>
                <td>C.Dist</td>
                <td>ANS **</td>
                <td>****</td>

                <td>RTG **</td>
                <td>T/S ****</td>
                <td>----</td>
                <td>LTG ***</td>
                <td>**</td>
                <td>F/P ****</td>
                <td>ANS ****</td>
                <td>***</td>
                <td>Final A***</td>
                <td>P.ODDS****</td>
                <td>C.ODDS****</td>
            </tr>
            @foreach ($data_second_table7 as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: start;">{!! $i !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Formula: 7</h1>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }
                // krsort($data_second_table3);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>
            <tr>
                <td>Dist **</td>
                <td>1</td>
                <td>2 <b>(T)</b> </td>
                <td>CLASS ***</td>
                <td>3 hno</td>
                <td>ANS **</td>
                <td>P.ODDS****</td>
                <td>C.ODDS****</td>
                <td>LTG ***</td>
                <td>**</td>
                <td>F/P ****</td>
                <td>ANS ****</td>
                <td>***</td>
                <td>Final A***</td>
                <td>**</td>

            </tr>
            @foreach ($data_second_table8 as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: start;">{!! $i !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Formula: 8 {{ $event_date }}</h1>
    <h3>{{ $heading }}</h3>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            @php
                if ($last_page[0]['rt']) {
                    if (isset(str_split($last_page[0]['rt'], 2)[1])) {
                        $new_rt = str_split($last_page[0]['rt'], 2)[1];
                    } else {
                        $new_rt = str_split($last_page[0]['rt'], 1)[1];
                    }
                } else {
                    $new_rt = 0;
                }

                // Custom comparison function
                function sortByScoreDesc($a, $b)
                {
                    return intval($b[0]) - intval($a[0]);
                }
                //usort($data_second_table9, 'sortByScoreDesc');
                // krsort($data_second_table3);
            @endphp
            <tr>
                <th>{{ $new_rt }}</th>
            </tr>
            <tr>
                <td>Dist **</td>
                <td>1</td>
                <td>HNAME</td>
                <td>2 <b>(T)</b> </td>
                <td>P.ODDS****</td>
                <td>C.ODDS****</td>
                <td>CLASS ***</td>
                <td>LTG ***</td>
                <td>**</td>
                <td>F/P ****</td>
                <td>Final A***</td>
                <td>**</td>
                <td>***</td>
                <td>***</td>

            </tr>
            @foreach ($data_second_table9 as $k => $item)
                <tr>
                    @foreach ($item as $i)
                        <td style="text-align: start;">{!! $i !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>



    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Formula: 9 {{ $event_date }}</h1>
    <h3>{{ $heading }}</h3>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            <tr>
                <td>1</td>
                <td>HNAME</td>
                <td>2 <b>(T)</b> </td>
                <td>P.ODDS****</td>
                <td>C.ODDS****</td>
                <td>CLASS ***</td>
                <td>LTG ***</td>
                <td>**</td>
                <td>F/P ****</td>
                <td>Final A***</td>
                <td>**</td>
                <td>***</td>
                <td>T/S</td>
                <td>FP/TS</td>
                <td>A</td>
                <td>**</td>
                <td>Rtg</td>
                <td>T/S</td>
                <td>P Ans</td>
                <td>LTG</td>
                <td>ANS</td>
                <td>LTG-F/P</td>
                <td>FINAL ANS</td>


            </tr>
            @foreach ($formula9_data as $k => $item)
                <tr>  
                    <td>{{ $item[1] }}</td>
                    <td>{{ $item[2] }}</td>
                    <td>{{ $item[3] }}</td>
                    <td>{{ $item[4] }}</td>
                    <td>{{ $item[5] }}</td>
                    <td>{{ $item[6] }}</td>
                    <td>{{ $item[7] }}</td>
                    <td>{{ $item[8] }}</td>
                    <td>{{ $item[9] }}</td>
                    <td>{{ $item[10] }}</td>
                    <td>{{ $item[11] }}</td>
                    <td>{{ $item[12] }}</td>
                    <td>{{ $item[13] }}</td>
                    <td>{{ $item[14] }}</td>
                    <td>{{ $item[15] }}</td>
                    <td>{{ $item[16] }}</td>
                    <td>{{ $item[17] }}</td>
                    <td>{{ $item[18] }}</td>
                    <td>{{ $item[19] }}</td>
                    <td>{{ $item[20] }}</td>
                    <td>{{ $item[21] }}</td>
                    <td>{{ $item[22] }}</td>
                    <td>{{ $item[23] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Formula: 10 {{ $event_date }}</h1>
    <h3>{{ $heading }}</h3>
    <h1>******************************************************************************************************</h1>

    <table class="table table-bordered mt-5" style="page-break-after: always;">
        <tbody>
            <tr>
                <td>1</td>
                <td>HNAME</td>
                <td>2 <b>(T)</b> </td>
                <td>P.ODDS****</td>
                <td>C.ODDS****</td>
                <td>CLASS ***</td>
                <td>LTG ***</td>
                <td>**</td>
                <td>F/P ****</td>
                <td>Final A***</td>
                <td>**</td>
                <td>***</td>
                


            </tr>
            @foreach ($formula10_data as $k => $item)
                <tr>  
                    <td>{{ $item[1] }}</td>
                    <td>{{ $item[2] }}</td>
                    <td>{{ $item[3] }}</td>
                    <td>{{ $item[4] }}</td>
                    <td>{{ $item[5] }}</td>
                    <td>{{ $item[6] }}</td>
                    <td>{{ $item[7] }}</td>
                    <td>{{ $item[8] }}</td>
                    <td>{{ $item[9] }}</td>
                    <td>{{ $item[10] }}</td>
                    <td>{{ $item[11] }}</td>
                    <td>{{ $item[12] }}</td>
                    
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
