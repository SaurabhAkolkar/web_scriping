<!DOCTYPE html>
<html>

<head>
    <title>Race Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <!-- Display Race Title and Distance -->
    <h2>Formula 0 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100 |
        0.18</h2>

    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>Number</th>
                <th>Name</th>
                <th>Weight</th>
                <th>Previous Position</th>
                <th>Previous Length</th>
                <th>++</th>
                <th>Previous to Previous Position</th>
                <th>Previous to Previous Length</th>
                <th>++</th>
                <th>Privious Dist</th>
                <th>Previous to Privious Dist</th>
                <th>winningTime_1</th>
                <th>winningTime_2</th>
                <th>weight1</th>
                <th>weight2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td>{{ $participant['number'] }}</td>
                    <td>{{ $participant['name'] }}</td>
                    <td>{{ $participant['weight'] }}</td>
                    <td>{{ $participant['previous_position'] }}</td>
                    <td>{{ $participant['previous_length'] }}</td>
                    <td style="color: red;font-size: 15px">{{ $participant['previous_length'] * 0.18 }}</td>
                    <td>{{ $participant['previous_to_previous_position'] }}</td>
                    <td>{{ $participant['previous_to_previous_length'] }}</td>
                    <td style="color: red;font-size: 15px">{{ $participant['previous_to_previous_length'] * 0.18 }}</td>
                    <td>{{ $participant['privious_dist'] }}</td>
                    <td>{{ $participant['privious_to_previous_dist'] }}</td>
                    <td>{{ preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m) ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2) : '0.00' }}
                    </td>
                    <td>{{ preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m) ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2) : '0.00' }}
                    </td>
                    <td>{{ $participant['weight1'] }}</td>
                    <td>{{ $participant['weight2'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="page-break-before: always;"></div>

    <!-- Display Race Title and Distance -->
    <h2>Formula 1 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>

    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>E</th>
                <th>F</th>
                <th>G</th>
                <th>H</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>*</td>
                <td>{{ $race[0][1] }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>*</td>
                <td>{{ $race[0][1] / 100 }}</td>
                <td>100</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? $m[1] * 60 + $m[2] + $m[3] / 1000
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? $m[1] * 60 + $m[2] + $m[3] / 1000
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }
                @endphp
                <tr>
                    <td>{{ $participant['number'] }}</td>
                    <td>{{ $privious_to_previous_dist }}</td>
                    <td>0</td>
                    <td>{{ $previous_to_previous_weight }}</td>
                    <td>{{ $priouse_to_priouse_time }}</td>
                    <td>0</td>
                    <td style="color: blueviolet;font-size: 20px">{{ $g1 }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $previous_dist }}</td>
                    <td>0</td>
                    <td>{{ $previous_weight }}</td>
                    <td>{{ $priouse_time }}</td>
                    <td>0</td>
                    <td style="color: blueviolet;font-size: 20px">{{ $g2 }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $current_dist }}</td>
                    <td>0</td>
                    <td>{{ $participant['weight'] }}</td>
                    <td style="color: blueviolet;font-size: 20px">{{ $e3 }}</td>
                    <td>2</td>
                    <td>{{ $g3 }}</td>
                    <td>{{ $h3 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div style="page-break-before: always;"></div>

    <!-- Display Race Title and Distance -->
    <h2>Formula 2 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>E</th>
                <th>F</th>
                <th>G</th>
                <th>H</th>
                <th>I</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_d1 = $g2 - $priouse_time;
                    $f3_h1 = $g3 - $e3;
                @endphp
                <tr>
                    <td>{{ $participant['number'] }}</td>
                    <td>{{ $privious_to_previous_dist }}</td>
                    <td>{{ $previous_dist }}</td>
                    <td>{{ $f3_d1 }}</td>
                    <td>{{ $previous_dist }}</td>
                    <td>{{ $previous_dist / 100 }}</td>
                    <td>{{ $current_dist }}</td>
                    <td>{{ $f3_h1 }}</td>
                    <td>{{ $current_dist / 100 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 3 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
                <th>15</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_3 = round($previous_dist / 100 - $privious_to_previous_dist / 100);
                    $f3_4 = round($g2 * $f3_3);
                    $f3_5 = round($g1 + $f3_4);
                    $f3_6 = round($current_dist / 100 - $previous_dist / 100);
                    $f3_7 = round($g2 * $f3_6);
                    $f3_8 = $f3_7 + $f3_5;
                    $f3_10 = $previous_dist - $privious_to_previous_dist;
                    $f3_11 = $f3_8 / 100;
                    $f3_12 = $g2 - $priouse_time;
                    $f3_13 = $g3 - $e3;
                    $f3_14 = $f3_12 + $f3_11;
                    $f3_15 = $f3_13 + $f3_14;
                @endphp
                <tr>
                    <td>{{ $participant['number'] }}</td>
                    <td>{{ round($g1, 2) }}</td>
                    <td>{{ $f3_3 }}</td>
                    <td style="text-align: end">{{ $f3_4 }}</td>
                    <td>{{ $f3_5 }}</td>
                    <td>{{ $f3_6 }}</td>
                    <td>{{ $f3_7 }}</td>
                    <td>{{ $f3_8 }}</td>
                    <td>{{ $participant['number'] }}</td>
                    <td>{{ $f3_10 }}</td>
                    <td>{{ $f3_11 }}</td>
                    <td>{{ round($f3_12, 2) }}</td>
                    <td>{{ round($f3_13, 2) }}</td>
                    <td>{{ round($f3_14, 2) }}</td>
                    <td>{{ round($f3_15, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 4 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>***</th>
                <th>11</th>
                <th>12</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_3 = round($previous_dist / 100 - $privious_to_previous_dist / 100);
                    $f3_4 = round($g2 * $f3_3);
                    $f3_5 = round($g1 + $f3_4);
                    $f3_6 = round($current_dist / 100 - $previous_dist / 100);
                    $f3_7 = round($g2 * $f3_6);
                    $f3_8 = $f3_7 + $f3_5;
                    $f3_10 = $previous_dist - $privious_to_previous_dist;
                    $f3_11 = $f3_8 / 100;
                    $f3_12 = $g2 - $priouse_time;
                    $f3_13 = $g3 - $e3;
                    $f3_14 = $f3_12 + $f3_11;
                    $f3_15 = $f3_13 + $f3_14;

                    $f4_3 = $f3_3;
                    $f4_4 = $f3_5;
                    $f4_5 = $f3_6;
                    $f4_6 = $f3_8;
                    $f4_7 = $f4_6 / 100;
                    $f4_8 = $f4_3 + $f4_5;
                    $f4_9 = $f3_14;
                    $f4_10 = $f4_9 + $f3_13;
                    $f4_11 = $f4_10 - $f4_9;
                    $f4_12 = $f4_7 + $f4_11;
                @endphp
                <tr>
                    <td>{{ $participant['number'] }}</td>
                    <td style="font-size: 18px;font-weight: 700">{{ round($g1, 2) }}</td>
                    <td>{{ $f4_3 }}</td>
                    <td style="font-size: 18px;font-weight: 700">{{ $f4_4 }}</td>
                    <td>{{ $f4_5 }}</td>
                    <td style="font-size: 18px;font-weight: 700">{{ $f4_6 }}</td>
                    <td>{{ $f4_7 }}</td>
                    <td>{{ $f4_8 }}</td>
                    <td>{{ round($f4_9, 2) }}</td>
                    <td>{{ round($f4_10, 2) }}</td>
                    <td></td>
                    <td>{{ round($f4_11, 2) }}</td>
                    <td>{{ round($f4_12, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 5 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>PPD/F4 2</th>
                <th>3</th>
                <th>4</th>
                <th>PD/F4 4</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>*</th>
                <th>PPD</th>
                <th>PD</th>
                <th>CD-PD</th>
                <th>IMP LTG (f56+3)</th>
                <th>F4 6 - CD</th>
                <th>*****</th>

                <th>F5 8 ANS</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_3 = round($previous_dist / 100 - $privious_to_previous_dist / 100);
                    $f3_4 = round($g2 * $f3_3);
                    $f3_5 = round($g1 + $f3_4);
                    $f3_6 = round($current_dist / 100 - $previous_dist / 100);
                    $f3_7 = round($g2 * $f3_6);
                    $f3_8 = $f3_7 + $f3_5;
                    $f3_10 = $previous_dist - $privious_to_previous_dist;
                    $f3_11 = $f3_8 / 100;
                    $f3_12 = $g2 - $priouse_time;
                    $f3_13 = $g3 - $e3;
                    $f3_14 = $f3_12 + $f3_11;
                    $f3_15 = $f3_13 + $f3_14;

                    $f4_3 = $f3_3;
                    $f4_4 = $f3_5;
                    $f4_5 = $f3_6;
                    $f4_6 = $f3_8;
                    $f4_7 = $f4_6 / 100;
                    $f4_8 = $f4_3 + $f4_5;
                    $f4_9 = $f3_14;
                    $f4_10 = $f4_9 + $f3_13;
                    $f4_11 = $f4_10 - $f4_9;
                    $f4_12 = $f4_7 + $f4_11;

                    $fr5_3 = round(round($g1) - round($privious_to_previous_dist), 2);
                    $fr5_6 = $f4_4 - $previous_dist;
                    $F58_ANS = $f4_6 - $f4_4;

                    if ($fr5_6 >= 0) {
                        $fr5_9 = $fr5_6 + $fr5_3;
                    } else {
                        $fr5_9 = $fr5_6 - $fr5_3;
                    }
                @endphp
                <tr>
                    <td style="width: 6%">{{ $participant['number'] }}</td>
                    <td style="width: 6%"> {{ round($privious_to_previous_dist) }} - {{ round($g1) }} </td>
                    <td style="font-size: 18px;font-weight: 700;text-align: center;width: 3%">{{ $fr5_3 }}</td>
                    <td style="background-color: blue;width: 1%"></td>
                    <td style="width: 5%"> {{ $previous_dist }} - {{ $f4_4 }} </td>
                    <td style="font-size: 18px;font-weight: 700;text-align: center;width: 2%">{{ $fr5_6 }}</td>
                    <td style="background-color: blue;width: 1%"></td>
                    <td style="width: 6%">{{ $f4_4 }} - {{ $f4_6 }}</td>

                    <td style="background-color: blue;width: 1%"></td>
                    <td style="font-size: 18px;font-weight: 700;text-align: end;width: 3%">{{ $f4_3 }}</td>
                    <td style="font-size: 18px;font-weight: 700;text-align: end;width: 3%">{{ $f4_5 }}</td>
                    <td style="width: 5%">{{ $race[0][1] - $previous_dist }}</td>
                    <td style="font-size: 20px;width: 5%"><b>{{ $fr5_9 }}<b></td>
                    <td style="font-size: 20px;width: 5%"><b>{{ $f4_6 - $race[0][1] }}</b></td>
                    <td></td>
                    <td style="font-size: 25px;font-weight: 700;text-align: end;width: 6%;">{{ $F58_ANS }}</td>


                </tr>
            @endforeach
        </tbody>
    </table>


    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 6 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>IMP LTG (f56+3)</th>
                <th>F4 6 - CD</th>
                <th>***</th>
                <th>*****</th>
                <th></th>
                <th>CD-PD</th>
                <th>F5 8 ANS</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_3 = round($previous_dist / 100 - $privious_to_previous_dist / 100);
                    $f3_4 = round($g2 * $f3_3);
                    $f3_5 = round($g1 + $f3_4);
                    $f3_6 = round($current_dist / 100 - $previous_dist / 100);
                    $f3_7 = round($g2 * $f3_6);
                    $f3_8 = $f3_7 + $f3_5;
                    $f3_10 = $previous_dist - $privious_to_previous_dist;
                    $f3_11 = $f3_8 / 100;
                    $f3_12 = $g2 - $priouse_time;
                    $f3_13 = $g3 - $e3;
                    $f3_14 = $f3_12 + $f3_11;
                    $f3_15 = $f3_13 + $f3_14;

                    $f4_3 = $f3_3;
                    $f4_4 = $f3_5;
                    $f4_5 = $f3_6;
                    $f4_6 = $f3_8;
                    $f4_7 = $f4_6 / 100;
                    $f4_8 = $f4_3 + $f4_5;
                    $f4_9 = $f3_14;
                    $f4_10 = $f4_9 + $f3_13;
                    $f4_11 = $f4_10 - $f4_9;
                    $f4_12 = $f4_7 + $f4_11;

                    $fr5_3 = round(round($g1) - round($privious_to_previous_dist), 2);
                    $fr5_6 = $f4_4 - $previous_dist;
                    $F58_ANS = $f4_6 - $f4_4;

                    if ($fr5_6 >= 0) {
                        $fr5_9 = $fr5_6 + $fr5_3;
                    } else {
                        $fr5_9 = $fr5_6 - $fr5_3;
                    }
                @endphp
                <tr>
                    <td style="width: 6%">{{ $participant['number'] }}</td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $fr5_9 }}<b></td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $f4_6 - $race[0][1] }}</b></td>
                    <td style="background-color: blue;width: 1%"></td>
                    <td style="font-size: 20px;width: 5%">{{ $f4_6 - $race[0][1] - $fr5_9 }}</td>
                    <td style="width: 30%"></td>
                    <td style="width: 7%">{{ $race[0][1] - $previous_dist }}</td>
                    <td style="font-size: 25px;font-weight: 700;text-align: end;width: 7%;">{{ $F58_ANS }}</td>
                    <td style="background-color: blue;width: 1%"></td>
                    <td style="font-size: 20px;width: 7%">{{ $F58_ANS - ($race[0][1] - $previous_dist) }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>



    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 7 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>*****</th>
                <th>********</th>
                <th>***</th>

                <th>***** (A)</th>
                <th>F4 6 - CD (A)</th>
                <th>IMP LTG (f56+3)</th>
                <th>CD-PD</th>
                <th>F5 8 ANS</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_3 = round($previous_dist / 100 - $privious_to_previous_dist / 100);
                    $f3_4 = round($g2 * $f3_3);
                    $f3_5 = round($g1 + $f3_4);
                    $f3_6 = round($current_dist / 100 - $previous_dist / 100);
                    $f3_7 = round($g2 * $f3_6);
                    $f3_8 = $f3_7 + $f3_5;
                    $f3_10 = $previous_dist - $privious_to_previous_dist;
                    $f3_11 = $f3_8 / 100;
                    $f3_12 = $g2 - $priouse_time;
                    $f3_13 = $g3 - $e3;
                    $f3_14 = $f3_12 + $f3_11;
                    $f3_15 = $f3_13 + $f3_14;

                    $f4_3 = $f3_3;
                    $f4_4 = $f3_5;
                    $f4_5 = $f3_6;
                    $f4_6 = $f3_8;
                    $f4_7 = $f4_6 / 100;
                    $f4_8 = $f4_3 + $f4_5;
                    $f4_9 = $f3_14;
                    $f4_10 = $f4_9 + $f3_13;
                    $f4_11 = $f4_10 - $f4_9;
                    $f4_12 = $f4_7 + $f4_11;

                    $fr5_3 = round(round($g1) - round($privious_to_previous_dist), 2);
                    $fr5_6 = $f4_4 - $previous_dist;
                    $F58_ANS = $f4_6 - $f4_4;

                    if ($fr5_6 >= 0) {
                        $fr5_9 = $fr5_6 + $fr5_3;
                    } else {
                        $fr5_9 = $fr5_6 - $fr5_3;
                    }
                @endphp
                <tr>
                    <td style="width: 6%">{{ $participant['number'] }}</td>
                    <td style="font-size: 20px;width: 7%"><b><b></td>
                    <td style="font-size: 20px;width: 7%"><b></b></td>
                    <td style="background-color: blue;width: 1%"></td>

                    <td style="width: 10%;text-align:center;font-size:25px">
                        <b>{{ ($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1]) }}</b></td>
                    <td style="width: 10%;text-align:center;font-size:25px">
                        <b>{{ ($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1] - $fr5_9) }}</b></td>
                    <td style="width: 10%">
                        {{
                            (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1] - $fr5_9)) - (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1]))   
                        }}
                    </td>
                    <td style="width: 7%">{{ $race[0][1] - $previous_dist }}</td>
                    <td style="font-size: 25px;font-weight: 700;text-align: end;width: 7%;">{{ $F58_ANS }}</td>
                    <td style="background-color: blue;width: 1%"></td>

                </tr>
            @endforeach
        </tbody>
    </table>






    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 8 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>PP L</th>
                <th>P L</th>
                <th>ANS</th>
                <th>ANS</th>
                <th>PP F</th>
                <th>P F</th>
                <th>Budden</th>
                <th>F A</th>
                <th>L A</th>
                <th>***</th>

                <th>***** (A)</th>
                <th>F4 6 - CD (A)</th>
                <th>IMP LTG (f56+3)</th>
                <th>CD-PD</th>
                <th>F5 8 ANS</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_3 = round($previous_dist / 100 - $privious_to_previous_dist / 100);
                    $f3_4 = round($g2 * $f3_3);
                    $f3_5 = round($g1 + $f3_4);
                    $f3_6 = round($current_dist / 100 - $previous_dist / 100);
                    $f3_7 = round($g2 * $f3_6);
                    $f3_8 = $f3_7 + $f3_5;
                    $f3_10 = $previous_dist - $privious_to_previous_dist;
                    $f3_11 = $f3_8 / 100;
                    $f3_12 = $g2 - $priouse_time;
                    $f3_13 = $g3 - $e3;
                    $f3_14 = $f3_12 + $f3_11;
                    $f3_15 = $f3_13 + $f3_14;

                    $f4_3 = $f3_3;
                    $f4_4 = $f3_5;
                    $f4_5 = $f3_6;
                    $f4_6 = $f3_8;
                    $f4_7 = $f4_6 / 100;
                    $f4_8 = $f4_3 + $f4_5;
                    $f4_9 = $f3_14;
                    $f4_10 = $f4_9 + $f3_13;
                    $f4_11 = $f4_10 - $f4_9;
                    $f4_12 = $f4_7 + $f4_11;

                    $fr5_3 = round(round($g1) - round($privious_to_previous_dist), 2);
                    $fr5_6 = $f4_4 - $previous_dist;
                    $F58_ANS = $f4_6 - $f4_4;

                    if ($fr5_6 >= 0) {
                        $fr5_9 = $fr5_6 + $fr5_3;
                    } else {
                        $fr5_9 = $fr5_6 - $fr5_3;
                    }
                @endphp
                <tr>
                    <td style="width: 6%">{{ $participant['number'] }}</td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $participant['previous_to_previous_length'] }}<b></td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $participant['previous_length'] }}</b></td>
                    <td style="font-size: 30px;width: 7%;color:red"><b>{{ $participant['previous_to_previous_length']+$participant['previous_length'] }}<b></td>
                    <td style="font-size: 30px;width: 7%;color:red"><b>{{ $participant['previous_to_previous_position']+$participant['previous_position'] }}</b></td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $participant['previous_to_previous_position'] }}<b></td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $participant['previous_position'] }}</b></td>
                    <td style="font-size: 20px;width: 7%"><b><b></td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $participant['previous_position']-$participant['previous_to_previous_position'] }}</b></td>
                    <td style="font-size: 20px;width: 7%"><b></b></td>
                    <td style="background-color: blue;width: 1%"></td>

                    <td style="width: 10%;text-align:center;font-size:25px">
                        <b>{{ ($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1]) }}</b></td>
                    <td style="width: 10%;text-align:center;font-size:25px">
                        <b>{{ ($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1] - $fr5_9) }}</b></td>
                    <td style="width: 10%">
                        {{
                            (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1] - $fr5_9)) - (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1]))   
                        }}
                    </td>
                    <td style="width: 7%">{{ $race[0][1] - $previous_dist }}</td>
                    <td style="font-size: 25px;font-weight: 700;text-align: end;width: 7%;">{{ $F58_ANS }}</td>
                    <td style="background-color: blue;width: 1%"></td>

                </tr>
            @endforeach
        </tbody>
    </table>



    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 9 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>PL-PPL</th>
                <th>PF-PPF</th>
                <th>PL - PF</th>
                <th>**</th>
                <th>PF</th>
                
                <th>IMP LTG (f56+3)</th>
                <th>CD-PD</th>
                <th>F5 8 ANS</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_3 = round($previous_dist / 100 - $privious_to_previous_dist / 100);
                    $f3_4 = round($g2 * $f3_3);
                    $f3_5 = round($g1 + $f3_4);
                    $f3_6 = round($current_dist / 100 - $previous_dist / 100);
                    $f3_7 = round($g2 * $f3_6);
                    $f3_8 = $f3_7 + $f3_5;
                    $f3_10 = $previous_dist - $privious_to_previous_dist;
                    $f3_11 = $f3_8 / 100;
                    $f3_12 = $g2 - $priouse_time;
                    $f3_13 = $g3 - $e3;
                    $f3_14 = $f3_12 + $f3_11;
                    $f3_15 = $f3_13 + $f3_14;

                    $f4_3 = $f3_3;
                    $f4_4 = $f3_5;
                    $f4_5 = $f3_6;
                    $f4_6 = $f3_8;
                    $f4_7 = $f4_6 / 100;
                    $f4_8 = $f4_3 + $f4_5;
                    $f4_9 = $f3_14;
                    $f4_10 = $f4_9 + $f3_13;
                    $f4_11 = $f4_10 - $f4_9;
                    $f4_12 = $f4_7 + $f4_11;

                    $fr5_3 = round(round($g1) - round($privious_to_previous_dist), 2);
                    $fr5_6 = $f4_4 - $previous_dist;
                    $F58_ANS = $f4_6 - $f4_4;

                    if ($fr5_6 >= 0) {
                        $fr5_9 = $fr5_6 + $fr5_3;
                    } else {
                        $fr5_9 = $fr5_6 - $fr5_3;
                    }
                @endphp
                <tr>
                    <td style="width: 6%">{{ $participant['number'] }}</td>
                    <td style="font-size: 30px;width: 7%;color:red"><b>{{ $participant['previous_length']-$participant['previous_to_previous_length'] }}<b></td>
    
                    <td style="font-size: 30px;width: 7%;color:red"><b>{{ $participant['previous_position']- $participant['previous_to_previous_position'] }}</b></td>
                    <td style="font-size: 20px;width: 7%;color: crimson"><b>{{ $participant['previous_length']-$participant['previous_position'] }}<b></td>
                    <td style="font-size: 20px;width: 7%"><b></b></td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $participant['previous_position']  }}</b></td>
                    <td style="width: 10%">
                        {{
                            (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1] - $fr5_9)) - (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1]))   
                        }}
                    </td>
                    <td style="width: 7%">{{ $race[0][1] - $previous_dist }}</td>
                    <td style="font-size: 25px;font-weight: 700;text-align: end;width: 7%;">{{ $F58_ANS }}</td>
                    <td style="background-color: blue;width: 1%"></td>

                </tr>
            @endforeach
        </tbody>
    </table>




    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 10 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>PL-PPL</th>
                <th>F9,4-3 = ANS</th>
                <th>ANS</th>
                <th>PF</th>
                <th>F10, 3-2 = ANS</th>
                <th>IMP LTG (f56+3)</th>
                <th>CD-PD</th>
                <th>F5 8 ANS</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_3 = round($previous_dist / 100 - $privious_to_previous_dist / 100);
                    $f3_4 = round($g2 * $f3_3);
                    $f3_5 = round($g1 + $f3_4);
                    $f3_6 = round($current_dist / 100 - $previous_dist / 100);
                    $f3_7 = round($g2 * $f3_6);
                    $f3_8 = $f3_7 + $f3_5;
                    $f3_10 = $previous_dist - $privious_to_previous_dist;
                    $f3_11 = $f3_8 / 100;
                    $f3_12 = $g2 - $priouse_time;
                    $f3_13 = $g3 - $e3;
                    $f3_14 = $f3_12 + $f3_11;
                    $f3_15 = $f3_13 + $f3_14;

                    $f4_3 = $f3_3;
                    $f4_4 = $f3_5;
                    $f4_5 = $f3_6;
                    $f4_6 = $f3_8;
                    $f4_7 = $f4_6 / 100;
                    $f4_8 = $f4_3 + $f4_5;
                    $f4_9 = $f3_14;
                    $f4_10 = $f4_9 + $f3_13;
                    $f4_11 = $f4_10 - $f4_9;
                    $f4_12 = $f4_7 + $f4_11;

                    $fr5_3 = round(round($g1) - round($privious_to_previous_dist), 2);
                    $fr5_6 = $f4_4 - $previous_dist;
                    $F58_ANS = $f4_6 - $f4_4;

                    if ($fr5_6 >= 0) {
                        $fr5_9 = $fr5_6 + $fr5_3;
                    } else {
                        $fr5_9 = $fr5_6 - $fr5_3;
                    }
                @endphp
                <tr>
                    <td style="width: 6%">{{ $participant['number'] }}</td>
                    <td style="font-size: 30px;width: 7%;color:red"><b>{{ $participant['previous_length']-$participant['previous_to_previous_length'] }}<b></td>
                    <td style="font-size: 20px;width: 7%;color: crimson"><b>
                        {{ ($participant['previous_length']-$participant['previous_position']) - ($participant['previous_position']- $participant['previous_to_previous_position'] ) }}
                    <b></td>
                    <td style="font-size: 20px;width: 7%"><b>
                    
                    </b></td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $participant['previous_position']  }}</b></td>
                    <td style="font-size: 20px;width: 7%"><b>
                        {{ (($participant['previous_length']-$participant['previous_position']) - ($participant['previous_position']- $participant['previous_to_previous_position'] ))  - ($participant['previous_length']-$participant['previous_to_previous_length']) }}
                    </b></td>
                    <td style="width: 10%">
                        {{
                            (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1] - $fr5_9)) - (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1]))   
                        }}
                    </td>
                    <td style="width: 7%">{{ $race[0][1] - $previous_dist }}</td>
                    <td style="font-size: 25px;font-weight: 700;text-align: end;width: 7%;">{{ $F58_ANS }}</td>
                    <td style="background-color: blue;width: 1%"></td>

                </tr>
            @endforeach
        </tbody>
    </table>


    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 11 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>


    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>1</th>
                <th>ANS</th>
                <th>PF</th>
                <th>F10, 3-2 = ANS</th>
                <th>IMP LTG (f56+3)</th>
                <th>CD-PD</th>
                <th>F5 8 ANS</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? round($m[1] * 60 + $m[2] + $m[3] / 1000, 2)
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }

                    $f3_3 = round($previous_dist / 100 - $privious_to_previous_dist / 100);
                    $f3_4 = round($g2 * $f3_3);
                    $f3_5 = round($g1 + $f3_4);
                    $f3_6 = round($current_dist / 100 - $previous_dist / 100);
                    $f3_7 = round($g2 * $f3_6);
                    $f3_8 = $f3_7 + $f3_5;
                    $f3_10 = $previous_dist - $privious_to_previous_dist;
                    $f3_11 = $f3_8 / 100;
                    $f3_12 = $g2 - $priouse_time;
                    $f3_13 = $g3 - $e3;
                    $f3_14 = $f3_12 + $f3_11;
                    $f3_15 = $f3_13 + $f3_14;

                    $f4_3 = $f3_3;
                    $f4_4 = $f3_5;
                    $f4_5 = $f3_6;
                    $f4_6 = $f3_8;
                    $f4_7 = $f4_6 / 100;
                    $f4_8 = $f4_3 + $f4_5;
                    $f4_9 = $f3_14;
                    $f4_10 = $f4_9 + $f3_13;
                    $f4_11 = $f4_10 - $f4_9;
                    $f4_12 = $f4_7 + $f4_11;

                    $fr5_3 = round(round($g1) - round($privious_to_previous_dist), 2);
                    $fr5_6 = $f4_4 - $previous_dist;
                    $F58_ANS = $f4_6 - $f4_4;

                    if ($fr5_6 >= 0) {
                        $fr5_9 = $fr5_6 + $fr5_3;
                    } else {
                        $fr5_9 = $fr5_6 - $fr5_3;
                    }
                @endphp
                <tr>
                    <td style="width: 6%">{{ $participant['number'] }}</td>
                    
                    <td style="font-size: 20px;width: 7%"><b>
                    
                    </b></td>
                    <td style="font-size: 20px;width: 7%"><b>{{ $participant['previous_position']  }}</b></td>
                    <td style="font-size: 20px;width: 7%"><b>
                        {{ (($participant['previous_length']-$participant['previous_position']) - ($participant['previous_position']- $participant['previous_to_previous_position'] ))  - ($participant['previous_length']-$participant['previous_to_previous_length']) }}
                    </b></td>
                    <td style="width: 10%">
                        {{
                            (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1] - $fr5_9)) - (($F58_ANS - ($race[0][1] - $previous_dist))-($f4_6 - $race[0][1]))   
                        }}
                    </td>
                    <td style="width: 7%">{{ $race[0][1] - $previous_dist }}</td>
                    <td style="font-size: 25px;font-weight: 700;text-align: end;width: 7%;">{{ $F58_ANS }}</td>
                    <td style="background-color: blue;width: 1%"></td>

                </tr>
            @endforeach
        </tbody>
    </table>



    <div style="page-break-before: always;"></div>

    <!-- Display Race Title and Distance -->
    <h2>Formula 12 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
        {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
        | 0.18</h2>

    <!-- Race Participants Table -->
    <table>
        <thead>
            <tr>
                <th>A</th>
                <th>PPF PPL</th>
                <th>PF PL</th>
                <th>ANS</th>
                <th>E</th>
                <th>PF</th>
                <th>Budden</th>
                <th>PF-PPF</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>*</td>
                <td>{{ $race[0][1] }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>*</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @foreach ($participants as $participant)
                @php
                    $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                        ? $m[1] * 60 + $m[2] + $m[3] / 1000
                        : '0.00';
                    $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                        ? $m[1] * 60 + $m[2] + $m[3] / 1000
                        : '0.00';
                    $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                    $previous_dist = $participant['privious_dist'];
                    $previous_weight = $participant['weight1'];
                    $previous_to_previous_weight = $participant['weight2'];
                    $current_dist = $race[0][1];

                    try {
                        $g1 =
                            $privious_to_previous_dist +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 =
                            $priouse_to_priouse_time +
                            ($previous_dist - $privious_to_previous_dist) *
                                ($priouse_to_priouse_time / $privious_to_previous_dist) +
                            ($previous_weight - $previous_to_previous_weight) * 0.36 -
                            (0 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 =
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 =
                            $priouse_time +
                            ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                            ($participant['weight'] - $previous_weight) * 0.35 -
                            (2 - 0) * 0.15;
                    } catch (\Throwable $th) {
                        $g3 = 0;
                    }

                    try {
                        $h3 = round(
                            (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                1.04) /
                                2 +
                                ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                (2 - 0) * 0.1,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $h3 = 0;
                    }
                @endphp
                <tr>
                    <td style="font-size: 30px;width: 10%;">{{ $participant['number'] }}</td>
                    <td>{{ round($participant['previous_to_previous_position']) }}</td>
                    <td>{{ $participant['previous_position'] }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="color: blueviolet;font-size: 20px"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $participant['previous_to_previous_length'] }}</td>
                    <td style="font-size: 20px">{{ round($participant['previous_length']) }}</td>
                    <td style="font-size: 30px;width: 10%;color: crimson;text-align: center">
                        {{ round($participant['previous_to_previous_length']) + round($participant['previous_length']) }}
                    </td>
                    <td></td>
                    <td style="font-size: 25px;font-weight: 700;text-align: end;width: 7%;">{{ $participant['previous_position'] }}</td>
                    <td>{{ (($participant['previous_length']-$participant['previous_position']) - ($participant['previous_position']- $participant['previous_to_previous_position'] ))  - ($participant['previous_length']-$participant['previous_to_previous_length']) }}</td>
                    <td style="color: blueviolet;font-size: 20px">{{ $participant['previous_position'] - $participant['previous_to_previous_position'] }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>


        <!-- Display Race Title and Distance -->
        <h2>Formula 13 : {{ $race[0][2] }} : {{ $race[0][4] }} | {{ $race[0][3] }} | {{ $race[0][0] }} -
            {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
            | 0.18</h2>
    
        <!-- Race Participants Table -->
        <table>
            <thead>
                <tr>
                    <th>A</th>
                    <th>PPF PPL</th>
                    <th>PF PL</th>
                    <th>ANS</th>
                    <th>E</th>
                    <th>PF</th>
                    <th>Budden</th>
                    <th>PF-PPF</th>
                    <th>***</th>
                    <th>******</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>*</td>
                    <td>{{ $race[0][1] }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
               
                @foreach ($participants as $participant)
                    @php
                        $priouse_to_priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_2'], $m)
                            ? $m[1] * 60 + $m[2] + $m[3] / 1000
                            : '0.00';
                        $priouse_time = preg_match('/(\d+):(\d+)\.(\d+)/', $participant['winningTime_1'], $m)
                            ? $m[1] * 60 + $m[2] + $m[3] / 1000
                            : '0.00';
                        $privious_to_previous_dist = $participant['privious_to_previous_dist'];
                        $previous_dist = $participant['privious_dist'];
                        $previous_weight = $participant['weight1'];
                        $previous_to_previous_weight = $participant['weight2'];
                        $current_dist = $race[0][1];
    
                        try {
                            $g1 =
                                $privious_to_previous_dist +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15;
                        } catch (\Throwable $th) {
                            $g1 = 0;
                        }
    
                        try {
                            $g2 =
                                $priouse_to_priouse_time +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15;
                        } catch (\Throwable $th) {
                            $g2 = 0;
                        }
    
                        try {
                            $e3 =
                                (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                    ($priouse_time * $current_dist) / $previous_dist) /
                                    2 +
                                ($participant['weight'] - $previous_weight) * 0.35 -
                                (2 - 0) * 0.15;
                        } catch (\Throwable $th) {
                            $e3 = 0;
                        }
    
                        try {
                            $g3 =
                                $priouse_time +
                                ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                                ($participant['weight'] - $previous_weight) * 0.35 -
                                (2 - 0) * 0.15;
                        } catch (\Throwable $th) {
                            $g3 = 0;
                        }
    
                        try {
                            $h3 = round(
                                (((($priouse_time * ($current_dist / $previous_dist)) ^ 1.04) +
                                    $priouse_to_priouse_time * ($current_dist / $privious_to_previous_dist)) ^
                                    1.04) /
                                    2 +
                                    ($participant['weight'] - $previous_to_previous_weight) * 0.4 -
                                    (2 - 0) * 0.1,
                                2,
                            );
                        } catch (\Throwable $th) {
                            $h3 = 0;
                        }

                        $f13_col_budden = (($participant['previous_length']-$participant['previous_position']) - ($participant['previous_position']- $participant['previous_to_previous_position'] ))  - ($participant['previous_length']-$participant['previous_to_previous_length']);
                    @endphp
                    <tr>
                        <td style="font-size: 30px;width: 10%;">{{ $participant['number'] }}</td>
                        <td>{{ round($participant['previous_to_previous_position']) }}</td>
                        <td>{{ $participant['previous_position'] }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="color: blueviolet;font-size: 20px"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $participant['previous_to_previous_length'] }}</td>
                        <td style="font-size: 20px">{{ round($participant['previous_length']) }}</td>
                        <td style="font-size: 30px;width: 10%;color: crimson;text-align: center">
                            {{ $participant['previous_length'] - $participant['previous_to_previous_length'] }}
                        </td>
                        <td>{{ abs($participant['previous_length'] - $participant['previous_to_previous_length']) }}</td>
                        <td style="font-size: 25px;font-weight: 700;text-align: end;width: 7%;">{{ $participant['previous_position'] }}</td>
                        <td>{{ $f13_col_budden }}</td>
                        <td style="color: blueviolet;font-size: 20px">{{ $participant['previous_position'] - $participant['previous_to_previous_position'] }}/{{ $f13_col_budden + abs($participant['previous_length'] - $participant['previous_to_previous_length']) }}</td>
                        <td></td>
                        <td style="font-size: 25px;font-weight: 700;text-align: center;width: 7%;">({{ $participant['previous_position'] }})</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>

</body>

</html>
