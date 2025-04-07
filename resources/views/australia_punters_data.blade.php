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
    <h2>Formula 1 : {{ $race[0][2] }} : {{ $race[0][0] }} - {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100 |
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
    <h2>Formula 2 : {{ $race[0][2] }} : {{ $race[0][0] }} - {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
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
                        $g1 = round(
                            $privious_to_previous_dist +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 = round(
                            $priouse_to_priouse_time +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 = round(
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                                ($participant['weight'] - $previous_weight) / 0.35 -
                                (2 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 = round(
                            $priouse_time +
                                ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                                ($participant['weight'] - $previous_weight) * 0.35 -
                                (0 - 0) * 0.15,
                            2,
                        );
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
    <h2>Formula 3 : {{ $race[0][2] }} : {{ $race[0][0] }} - {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
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
                        $g1 = round(
                            $privious_to_previous_dist +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 = round(
                            $priouse_to_priouse_time +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 = round(
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                                ($participant['weight'] - $previous_weight) / 0.35 -
                                (2 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 = round(
                            $priouse_time +
                                ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                                ($participant['weight'] - $previous_weight) * 0.35 -
                                (0 - 0) * 0.15,
                            2,
                        );
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
    <h2>Formula 4 : {{ $race[0][2] }} : {{ $race[0][0] }} - {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
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
                        $g1 = round(
                            $privious_to_previous_dist +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 = round(
                            $priouse_to_priouse_time +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 = round(
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                                ($participant['weight'] - $previous_weight) / 0.35 -
                                (2 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 = round(
                            $priouse_time +
                                ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                                ($participant['weight'] - $previous_weight) * 0.35 -
                                (0 - 0) * 0.15,
                            2,
                        );
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

                    $f5_3 = $previous_dist / 100 - $privious_to_previous_dist;
                    $f5_4 = $g2 * $f5_3;
                    $f5_5 = $g1 + $f5_4;
                    $f5_6 = (float)(($current_dist / 100) - ($previous_dist / 100));
                    $f5_7 = (float)$g2 * (float)$f5_6;
                    $f5_8 = $f5_5 + $f5_7;
                    $f5_10 = $previous_dist - $privious_to_previous_dist;
                    $f5_11 = $f5_8 / 100;
                    $f5_12 = $g2 - $priouse_time;
                    $f5_13 = $g3 - $e3;
                    $f5_14 = $f5_12 + $f5_11;
                    $f5_15 = $f5_13 + $f5_14;
                @endphp
                <tr>
                    <td>{{ $participant['number'] }}</td>
                    <td>{{ $g1 }}</td>
                    <td>{{ $f5_3 }}</td>
                    <td>{{ $f5_4 }}</td>
                    <td>{{ $f5_5 }}</td>
                    <td>{{ $f5_6 }}</td>
                    <td>{{ $f5_7 }}</td>
                    <td>{{ $f5_8 }}</td>
                    <td>{{ $participant['number'] }}</td>
                    <td>{{ $f5_10 }}</td>
                    <td>{{ $f5_11 }}</td>
                    <td>{{ $f5_12 }}</td>
                    <td>{{ $f5_13 }}</td>
                    <td>{{ $f5_14 }}</td>
                    <td>{{ $f5_15 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div style="page-break-before: always;"></div>
    <!-- Display Race Title and Distance -->
    <h2>Formula 5 : {{ $race[0][2] }} : {{ $race[0][0] }} - {{ $race[0][1] }} | {{ $race[0][1] / 100 }} | 100
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
                        $g1 = round(
                            $privious_to_previous_dist +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $g1 = 0;
                    }

                    try {
                        $g2 = round(
                            $priouse_to_priouse_time +
                                ($previous_dist - $privious_to_previous_dist) *
                                    ($priouse_to_priouse_time / $privious_to_previous_dist) +
                                ($previous_weight - $previous_to_previous_weight) * 0.36 -
                                (0 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $g2 = 0;
                    }

                    try {
                        $e3 = round(
                            (($priouse_to_priouse_time * $current_dist) / $privious_to_previous_dist +
                                ($priouse_time * $current_dist) / $previous_dist) /
                                2 +
                                ($participant['weight'] - $previous_weight) / 0.35 -
                                (2 - 0) * 0.15,
                            2,
                        );
                    } catch (\Throwable $th) {
                        $e3 = 0;
                    }

                    try {
                        $g3 = round(
                            $priouse_time +
                                ($current_dist - $previous_dist) * ($priouse_time / $previous_dist) +
                                ($participant['weight'] - $previous_weight) * 0.35 -
                                (0 - 0) * 0.15,
                            2,
                        );
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

                    $f5_3 = $previous_dist / 100 - $privious_to_previous_dist;
                    $f5_4 = $g2 * $f5_3;
                    $f5_5 = $g1 + $f5_4;
                    $f5_6 = $current_dist / 100 - $previous_dist / 100;
                    $f5_7 = $g2 * $f5_6;
                    $f5_8 = $f5_3+$f5_6;
                    
                    $f5_10 = $previous_dist - $privious_to_previous_dist;
                    $f5_11 = $f5_8 / 100;
                    $f5_12 = $g2 - $priouse_time;
                    $f5_13 = $g3 - $e3;
                    $f5_9 =  $f5_12 + $f5_11;
                    $f5_10 = $f5_13 + $f5_9;
                @endphp
                <tr>
                    <td>{{ $participant['number'] }}</td>
                    <td>{{ $g1 }}</td>
                    <td>{{ $f5_3 }}</td>
                    <td>{{ $f5_5 }}</td>
                    <td>{{ $f5_6 }}</td>
                    <td>{{ $f5_8 }}</td>
                    <td></td>
                    <td>{{ $f5_8 }}</td>
                    <td>{{ $f5_9 }}</td>
                    <td>{{ $f5_10 }}</td>
                    <td>{{ $f5_11 }}</td>
                    <td>{{ $f5_12 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
