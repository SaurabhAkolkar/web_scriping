<?php

namespace App\Http\Controllers;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Artisan;

class GoutteController extends Controller
{
    public function doWebScraping()
    {
        return view("do_web_scraping");
    }

    public function newdoWebScraping()
    {
        return view("newdo_web_scraping");
    }

    public function data()
    {
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $res = $guzzleClient->request('GET', 'https://web.jadhavcareclean.com/api/data');
        return $res->getBody()->json();
    }

    public function graph()
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);
        $full_url = "https://charts.racingandsports.com/Horse/GetPerformace?showExplantion=false&ids=1326873&ids=1401728&ids=1661251&ids=1627694";
        // $full_url = "https://www.racingandsports.com.au/form-guide/thoroughbred/australia/ascot/2023-04-29/R1";
        $crawler = $goutteClient->request('GET', $full_url);
        $sub = $crawler->filter('script')->each(function ($n) {
            return [
                dump($n->text()),
            ];
        });
    }

    public function call_me_crawler(Request $req)
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);

        $baseurl = "https://www.racingandsports.com.au/form-guide/thoroughbred";
        $contry = $req->contry;
        $center = $slug = Str::slug($req->center, '-');
        $date = $req->date;
        $url = $baseurl . "/" . $contry . "/" . $center . "/" . $date . "/";
        $main = [];
        for ($i = 1; $i < 10; $i++) {
            $race_no = "R" . $i;
            $full_url = $url . $race_no;
            $crawler = $goutteClient->request('GET', $full_url);

            $sub = $crawler->filter('.pa-table tbody .runner_row')->each(function ($n) {

                return [
                    $n->filter('td')->eq(2)->filter('a')->text(),
                    $n->filter('td')->eq(15)->html(),
                    $n->filter('td')->eq(17)->html(),
                    $n->filter('td')->eq(18)->html(),
                    $n->filter('td')->eq(19)->html(),
                    $n->filter('td')->eq(20)->html(),
                ];
            });

            $rating_url = $full_url . "/" . "ratings";
            $craw = $goutteClient->request('GET', $rating_url);

            $lsr_est = $craw->filter('.tblStats tbody tr')->each(function ($n) {
                return [
                    $n->filter('td')->eq(0)->text(),
                    $n->filter('td')->eq(4)->text(),
                    $n->filter('td')->eq(3)->text(),
                    $n->filter('td')->eq(2)->text(),
                ];
            });

            $arr = [];
            foreach ($lsr_est as $key => $value) {
                $arr[$value[0]] = $value;
            }

            sort($arr);
            $main_sub = [];
            foreach ($sub as $key => $value) {
                array_push($value, $arr[$key]);
                array_push($main_sub, collect($value)->flatten());
            }

            if (!count($main_sub)) {
                break;
            }

            $main[$center . "  " . $race_no] = $main_sub;

        }

        $race_arr = [];
        for ($i = 1; $i < 10; $i++) {
            $race_no = "R" . $i;
            $full_url = $url . $race_no . "/" . "neurals";
            $jacraw = $goutteClient->request('GET', $full_url);
            $sub = $jacraw->filter('#race-title')->each(function ($n) {
                return $n->html();
            });
            $ja_arr = [];
            if (count($sub)) {
                $jacraw = $goutteClient->request('GET', $full_url);

                $ja = $jacraw->filter('body')->each(function ($n) {
                    return explode("nJA\":", explode("]", explode('"Neurals": [', htmlspecialchars_decode($n->html()))[1])[0]);
                });
                for ($j = 1; $j < count($ja[0]); $j++) {
                    $ja_arr[$j] = (float) explode(',', $ja[0][$j])[0];
                }
                array_push($race_arr, $ja_arr);
            } else {
                break;
            }
        }

        return view('printMe')->with("main", $main)->with("race_arr", $race_arr);

    }

    public function new_call_me_crawler(Request $req)
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);

        $baseurl = "https://www.racingandsports.com.au/form-guide/thoroughbred";
        $contry = $req->contry;
        $center = $slug = Str::slug($req->center, '-');
        $date = $req->date;
        $url = $baseurl . "/" . $contry . "/" . $center . "/" . $date . "/";
        $main = [];
        for ($i = 1; $i < 10; $i++) {
            $race_no = "R" . $i;
            $full_url = $url . $race_no;
            $crawler = $goutteClient->request('GET', $full_url);

            $sub = $crawler->filter('.pa-table tbody .runner_row')->each(function ($n) {

                return [
                    $n->filter('td')->eq(2)->filter('a')->text(),
                    $n->filter('td')->eq(15)->html(),
                    $n->filter('td')->eq(17)->html(),
                    $n->filter('td')->eq(18)->html(),
                    $n->filter('td')->eq(19)->html(),
                    $n->filter('td')->eq(20)->html(),
                ];
            });

            $rating_url = $full_url . "/" . "ratings";
            $craw = $goutteClient->request('GET', $rating_url);

            $lsr_est = $craw->filter('.tblStats tbody tr')->each(function ($n) {
                return [
                    $n->filter('td')->eq(0)->text(),
                    $n->filter('td')->eq(4)->text(),
                    $n->filter('td')->eq(3)->text(),
                    $n->filter('td')->eq(2)->text(),
                ];
            });

            $arr = [];
            foreach ($lsr_est as $key => $value) {
                $arr[$value[0]] = $value;
            }

            sort($arr);
            $main_sub = [];
            foreach ($sub as $key => $value) {
                array_push($value, $arr[$key]);
                array_push($main_sub, collect($value)->flatten());
            }

            if (!count($main_sub)) {
                break;
            }

            $main[$center . "  " . $race_no] = $main_sub;

        }

        $race_arr = [];
        for ($i = 1; $i < 10; $i++) {
            $race_no = "R" . $i;
            $full_url = $url . $race_no . "/" . "neurals";
            $jacraw = $goutteClient->request('GET', $full_url);
            $sub = $jacraw->filter('#race-title')->each(function ($n) {
                return $n->html();
            });
            $ja_arr = [];
            if (count($sub)) {
                $jacraw = $goutteClient->request('GET', $full_url);

                $ja = $jacraw->filter('body')->each(function ($n) {
                    return explode("nJA\":", explode("]", explode('"Neurals": [', htmlspecialchars_decode($n->html()))[1])[0]);
                });
                for ($j = 1; $j < count($ja[0]); $j++) {
                    $ja_arr[$j] = (float) explode(',', $ja[0][$j])[0];
                }
                array_push($race_arr, $ja_arr);
            } else {
                break;
            }
        }

        return view('printMe')->with("main", $main)->with("race_arr", $race_arr);

    }

    public function share()
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);

        $baseurl = "https://www.screener.in/company/compare/00000001/";

        $crawler = $goutteClient->request('GET', $baseurl);

        $sub = $crawler->filter('body .data-table tbody td')->each(function ($n) {
            return dump($n->text());
        });

    }

    public function getfirst()
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);

        $baseurl = "https://www.indiarace.com/Home/racingCenterEvent?venueId=11&event_date=2022-12-13&race_type=RACECARD";
        $craw = $goutteClient->request('GET', $baseurl);

        $race_no = $craw->filter('.pagination_filter_div a')->each(function ($n) {
            return $n->attr('href');
        });

        foreach ($race_no as $key => $value) {
            $title = $craw->filter($value)->each(function ($n) {
                dump($n->filter('.center_heading h2')->text());

                $n->filter('tr')->each(function ($hn) {
                    $a = explode(" ", $hn->text());
                    dump($a);
                });
                // $n->filter('.race_card_td h5 a')->each(function ($nn) {
                //     dump($nn->attr('href'));
                //     dump($nn->attr('href'));
                //     $goutteClient = new Client();
                //     $guzzleClient = new GuzzleClient(array(
                //         'timeout' => 60,
                //         'verify' => false,
                //     ));
                //     $goutteClient->setClient($guzzleClient);
                //     $cc = $goutteClient->request('GET', $nn->attr('href'));
                //     $cc->filter('tr')->each(function($a){
                //         // dump($a->filter('td')->eq(1)->text());
                //         // dump($a->text());
                //     });

                // });
            });
        }

    }

    public function uk()
    {
        return view("attuk");
    }

    public function astro(Request $req)
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);
        $domain = "https://www.attheraces.com";
        $baseurl = $req->center;
        $arr = explode('/', $baseurl);
        
        $goutteClient->setServerParameter('HTTP_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36');
        $craw = $goutteClient->request('GET', $baseurl);
        // dd($craw->text());
        $hourse_data = $craw->filter('.js-card__area .card-wrapper .card-body .card-entry')->each(function ($n) {
            return ["form" => $n->filter('.card-form__stats')->text(), "LHN" => $n->filter('.card-section .card-cell--no-draw .card-no-draw__inner')->text(), "HNAME" => $n->filter('.horse__link')->text(), "LOR" => $n->filter('.text-pill--steel')->text(), "hl" => $n->filter('.horse__link')->attr('href')];
        });
        
        
        $main_arr = [];
        foreach ($hourse_data as $key => $data) {
            $craw = $goutteClient->request('GET', $domain . $data["hl"]);
            $urls = $craw->filter('#tab-form-data-full-form .table-wrapper table tbody tr')->each(function ($nn) {

                try {
                    $nn->filter('td')->eq(1)->text();
                    return [$nn->filter('td')->eq(3)->filter('a')->attr('href'), $nn->filter('td')->eq(1)->text(), $nn->filter('td')->eq(3)->text(), $nn->filter('td')->eq(7)->text(),$nn->filter('td')->eq(4)->text()];
                } catch (\Throwable $th) {
                    return 0;
                }
            });

            $count = 0;
            foreach ($urls as $key => $url) {
                if ($url != "0" && $count < 3) {
                    array_push($data, $url[0]);
                    $data['rd' . $count] = $url[1];
                    $data['rc' . $count] = $url[2];
                    $data['por' . $count] = $url[3];
                    $data['sp' . $count] = $url[4];
                    $count = $count + 1;
                }
            }
            array_push($main_arr, $data);
        }

        $last_page = [];
        foreach ($main_arr as $key => $f) {

            if (isset($f[0])) {
                $craw1 = $goutteClient->request('GET', $domain . $f[0]);

                $positionandrtg = "";
                $line = "";
                $first_rtg = "";
                $craw1->filter('#tab-full-result .js-card__area .card-wrapper .card-body .card-entry')
                    ->each(function ($n) use (&$f, &$positionandrtg, &$line, &$first_rtg) {
                        if (str_contains($f["HNAME"], $n->filter(".flush a")->text()) || Str::contains($n->filter(".flush a")->text(), $f["HNAME"])) {
                            $f["PHN"] = $n->filter(".flush span")->text();
                        }

                        try {
                            $line = $n->filter('.card-no-draw')->eq(0)->text() . " " . $n->filter('.card-cell--horse span')->eq(0)->text() . " " . $n->filter('.card-cell--stats')->eq(1)->text();
                            $first_rtg = $n->filter('.card-cell--stats')->eq(1)->text();
                        } catch (\Throwable $th) {
                            $line = $n->filter('.card-no-draw')->eq(0)->text() . " " . $n->filter('.card-cell--horse span')->eq(0)->text() . " 0";
                            $first_rtg = 0;
                        }
                        $positionandrtg .= $line . "<br>";
                        if ($n->filter('.card-cell--horse span')->eq(0)->text() == "1.") {
                            $f["first_rtg_line"] = $line;
                            $f["first_rtg"] = $first_rtg;
                        }

                    });
                $f[$f["HNAME"]] = $positionandrtg;
                if (count($f) > 6) {
                    $positionandrtg1 = "";
                    $line1 = "";
                    $first_rtg1 = "";
                    $craw1 = $goutteClient->request('GET', $domain . $f[1]);
                    $craw1->filter('#tab-full-result .js-card__area .card-wrapper .card-body .card-entry')
                        ->each(function ($n) use (&$f, &$positionandrtg1, &$line1, &$first_rtg1) {

                            if (str_contains($f["HNAME"], $n->filter(".flush a")->text()) || Str::contains($n->filter(".flush a")->text(), $f["HNAME"])) {
                                $f["PPHN"] = $n->filter(".flush span")->text();
                            }
                            try {
                                $line1 = $n->filter('.card-no-draw')->eq(0)->text() . " " . $n->filter('.card-cell--horse span')->eq(0)->text() . " " . $n->filter('.card-cell--stats')->eq(1)->text();
                                $first_rtg1 = $n->filter('.card-cell--stats')->eq(1)->text();
                            } catch (\Throwable $th) {
                                $line1 = $n->filter('.card-no-draw')->eq(0)->text() . " " . $n->filter('.card-cell--horse span')->eq(0)->text() . " 0";
                                $first_rtg1 = 0;
                            }
                            $positionandrtg1 .= $line1 . "<br>";
                            if ($n->filter('.card-cell--horse span')->eq(0)->text() == "1.") {
                                $f["first_rtg_line1"] = $line1;
                                $f["first_rtg1"] = $first_rtg1;
                            }else{
                                $f["first_rtg_line1"] = 0;
                                $f["first_rtg1"] = $first_rtg1;
                            }
                        });
                    $phn = isset($f["PHN"]) ? $f["PHN"] : 0;
                    $f[$phn . "1"] = $positionandrtg1;
                } else {
                    $f[$f["PHN"] . "1"] = "";
                }
            } else {
                $f["PHN"] = 11;
                $f[$f["PHN"] . "1"] = "";
            }

            if (isset($f[2])) {
                $craw1 = $goutteClient->request('GET', $domain . $f[2]);
                $positionandrtg2 = "";
                $line2 = "";
                $first_rtg2 = "";
                $craw1->filter('#tab-full-result .js-card__area .card-wrapper .card-body .card-entry')
                    ->each(function ($n) use (&$f, &$positionandrtg2, &$line2, &$first_rtg2) {

                        try {
                            $line2 = $n->filter('.card-no-draw')->eq(0)->text() . " " . $n->filter('.card-cell--horse span')->eq(0)->text() . " " . $n->filter('.card-cell--stats')->eq(1)->text();
                            $first_rtg2 = $n->filter('.card-cell--stats')->eq(1)->text();
                        } catch (\Throwable $th) {
                            $line2 = $n->filter('.card-no-draw')->eq(0)->text() . " " . $n->filter('.card-cell--horse span')->eq(0)->text() . " 0";
                            $first_rtg2 = 0;
                        }
                        $positionandrtg2 .= $line2 . "<br>";
                        if ($n->filter('.card-cell--horse span')->eq(0)->text() == "1.") {
                            $f["first_rtg_line2"] = $line2;
                            $f["first_rtg_2"] = $first_rtg2;
                        }

                    });
                $phn = isset($f["PHN"]) ? $f["PHN"] : 0;
                $f[$phn . "2"] = $positionandrtg2;
            } else {
                $f["PHN"] = 0;
                $f[$f["PHN"] . "2"] = "";
            }
            if (isset($f)) {
                array_push($last_page, $f);
            }

        };

        return view("uk")->with("last_page", $last_page)->with("time", $arr[6]);

    }

    public function ast_input()
    {
        return view("ast_input");
    }
    public function ast(Request $req)
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);
        $domain = "https://www.racingaustralia.horse/";
        $domain_met = "https://www.racingaustralia.horse/InteractiveForm/";
        $baseurl = $req->center;

        $race_no = $req->race_no;

        $craw_dis = $goutteClient->request('GET', $baseurl);
        $race_distance_array = $craw_dis->filter("table")->filter('.race-title th')->each(function ($n) {
            try {
                return $n->eq(0)->text();
            } catch (\Throwable $th) {
            }
        });
        $race_title = $race_distance_array[$race_no - 1];

        preg_match("/\((\d+)\s.*?\)/", $race_distance_array[$race_no - 1], $matches);
        


        $craw = $goutteClient->request('GET', $baseurl);
        $hourse_data = $craw->filter("table")->filter('.race-strip-fields tr')->each(function ($n) {
            try {
                
                $n->filter('td')->eq(9)->text();
                try {
                    return ['link' => $n->filter('td')->eq(2)->filter("a")->attr('href'), 'no' => $n->filter('td')->eq(0)->text(), 'form' => $n->filter('td')->eq(1)->text(),
                     'hourse_name' => $n->filter('td')->eq(2)->text(), 'rt' => $n->filter('td')->eq(9)->text()
                     , 'weight' => $n->filter('td')->eq(6)->text(), 'barrier' => $n->filter('td')->eq(5)->text()];
                } catch (\Throwable $th) {
                    return 0;
                }
            } catch (\Throwable $th) {
                try {
                    return ['link' => $n->filter('td')->eq(2)->filter("a")->attr('href'), 
                    'no' => $n->filter('td')->eq(0)->text(), 'form' => $n->filter('td')->eq(1)->text(),
                     'hourse_name' => $n->filter('td')->eq(2)->text(), 
                     'rt' => $n->filter('td')->eq(8)->text(), 'weight' => $n->filter('td')->eq(6)->text(), 'barrier' => $n->filter('td')->eq(5)->text()];
                } catch (\Throwable $th) {
                    return 0;
                }
            }
        });

        $main = array_filter($hourse_data);

        $main_arr = [];
        $start = $req->start;
        $end = $req->end;
        $arr = [];
        for ($i = $start; $i <= $end; $i++) {
            $sub = $main[$i];
            $sub["race_dis"] = $matches[1];
            $craw1 = $goutteClient->request('GET', $sub["link"]);
            $hourse_data1 = $craw1->filter("table")->filter('.interactive-race-fields tr')->each(function ($n) {
                try {
                    $n->filter('td i')->eq(0)->text();
                } catch (\Throwable $th) {
                    try {
                        return [$n->filter('td')->eq(1)->text(), $n->filter('td b a')->eq(0)->attr('href'), $n->filter('td')->eq(0)->text()];
                    } catch (\Throwable $th) {
                        return 0;
                    }
                }
            });

            $emptyRemoved = array_filter($hourse_data1);
            $two_element_array = array_slice($emptyRemoved, -3);
            $clean_hn = preg_replace('/[^A-Za-z0-9\-]/', '', $sub["hourse_name"]);
            if(count($two_element_array) > 2){
                $sub["3or"] = $two_element_array[2][0];
                $sub["3fr"] = $two_element_array[2][2];
            }
            if (count($two_element_array) > 1) {
                $sub["ppor"] = $two_element_array[0][0];
                $sub["ppfr"] = $two_element_array[0][2];
                $sub["por"] = $two_element_array[1][0];
                $sub["pfr"] = $two_element_array[1][2];

                $craw2 = $goutteClient->request('GET', $domain_met . $two_element_array[0][1]);
                $arr1 = [];

                $hourse_data2 = $craw2->filter("table")->filter('.race-strip-fields tr')->each(function ($n) use (&$sub, &$arr1, &$clean_hn) {
                    try {
                        if (str_contains($clean_hn, preg_replace('/[^A-Za-z0-9\-]/', '', $n->filter('td')->eq(3)->text())) || str_contains(preg_replace('/[^A-Za-z0-9\-]/', '', $n->filter('td')->eq(3)->text()), $clean_hn)) {
                            $sub["phn"] = $n->filter('td')->eq(2)->text();
                        }
                    } catch (\Throwable $th) {
                        return 0;
                    }

                    if ($n->filter('td')->eq(1)->text() != "") {
                        array_push($arr1, [$n->filter('td')->eq(1)->text(), $n->filter('td')->eq(2)->text(), $n->filter('td')->eq(8)->text(), $n->filter('td')->eq(3)->text()]);
                    }
                });
                $arr2 = [];
                $temp_arr = [];
                foreach ($arr1 as $key => $value) {
                    if ($key == 0) {
                        array_push($temp_arr, $value);
                        continue;
                    } elseif ($value[0] == 1) {
                        array_push($arr2, $temp_arr);
                        $temp_arr = [];
                        array_push($temp_arr, $value);
                    } else {
                        array_push($temp_arr, $value);
                    }
                }
                array_push($arr2, $temp_arr);

                $race_arr = [];
                foreach ($arr2 as $k => $v) {
                    foreach ($v as $kk => $vv) {
                        if (str_contains($clean_hn, preg_replace('/[^A-Za-z0-9\-]/', '', $vv[3])) || str_contains(preg_replace('/[^A-Za-z0-9\-]/', '', $vv[3]), $clean_hn)) {
                            $race_arr = $v;
                        }
                    }
                }

                if ($race_arr) {
                    $arr3 = [];
                    foreach ($race_arr as $key => $value) {
                        if ($value[0] == "1") {
                            $arr3["a1"] = $value;
                        }
                        if ($value[0] == "3") {
                            $arr3["a2"] = $value;
                        }
                        if (str_contains($clean_hn, preg_replace('/[^A-Za-z0-9\-]/', '', $value[3])) || str_contains(preg_replace('/[^A-Za-z0-9\-]/', '', $value[3]), $clean_hn)) {
                            $arr3["a3"] = $value;
                        }
                        if ($value[1] == 1) {
                            $arr3["a4"] = $value;
                        }
                    }
                    $sub["arr1"] = $arr3;

                } else {
                    $sub["arr1"] = [];
                }

                $b1 = [];
                $craw3 = $goutteClient->request('GET', $domain_met . $two_element_array[1][1]);

                $hourse_data2 = $craw3->filter("table")->filter('.race-strip-fields tr')->each(function ($n) use (&$sub, &$b1, &$clean_hn) {
                    try {
                        if (str_contains($clean_hn, preg_replace('/[^A-Za-z0-9\-]/', '', $n->filter('td')->eq(3)->text())) || str_contains(preg_replace('/[^A-Za-z0-9\-]/', '', $n->filter('td')->eq(3)->text()), $clean_hn)) {
                            $sub["pphn"] = $n->filter('td')->eq(2)->text();
                        }
                    } catch (\Throwable $th) {
                        return 0;
                    }
                    if ($n->filter('td')->eq(1)->text() != "") {
                        array_push($b1, [$n->filter('td')->eq(1)->text(), $n->filter('td')->eq(2)->text(), $n->filter('td')->eq(8)->text(), $n->filter('td')->eq(3)->text()]);
                    }
                });

                $b2 = [];
                $temp_arr1 = [];

                foreach ($b1 as $key => $value) {
                    if ($key == 0) {
                        array_push($temp_arr1, $value);
                        continue;
                    } elseif ($value[0] == 1) {
                        array_push($b2, $temp_arr1);
                        $temp_arr1 = [];
                        array_push($temp_arr1, $value);
                    } else {
                        array_push($temp_arr1, $value);
                    }
                }
                array_push($b2, $temp_arr1);
                $race_arr1 = [];
                foreach ($b2 as $k => $v) {
                    foreach ($v as $kk => $vv) {
                        if (str_contains($clean_hn, preg_replace('/[^A-Za-z0-9\-]/', '', $vv[3])) || str_contains(preg_replace('/[^A-Za-z0-9\-]/', '', $vv[3]), $clean_hn)) {
                            $race_arr1 = $v;
                        }
                    }
                }
                if ($race_arr1) {
                    $b3 = [];
                    foreach ($race_arr1 as $key => $value) {
                        if ($value[0] == "1") {
                            $b3["b1"] = $value;
                        }
                        if ($value[0] == "3") {
                            $b3["b2"] = $value;
                        }
                        if (str_contains($clean_hn, preg_replace('/[^A-Za-z0-9\-]/', '', $value[3])) || str_contains(preg_replace('/[^A-Za-z0-9\-]/', '', $value[3]), $clean_hn)) {
                            $b3["b3"] = $value;
                        }
                        if ($value[1] == 1) {
                            $b3["b4"] = $value;
                        }
                    }
                    $sub["arr2"] = $b3;
                } else {
                    $sub["arr2"] = [];
                }

            } elseif (count($two_element_array) > 0) {
                $c1 = [];
                $craw2 = $goutteClient->request('GET', $domain_met . $two_element_array[0][1]);

                $hourse_data2 = $craw2->filter("table")->filter('.race-strip-fields tr')->each(function ($n) use (&$sub, &$c1) {
                    try {
                        if (str_contains($clean_hn, preg_replace('/[^A-Za-z0-9\-]/', '', $n->filter('td')->eq(3)->text())) || str_contains(preg_replace('/[^A-Za-z0-9\-]/', '', $n->filter('td')->eq(3)->text()), $clean_hn)) {
                            $sub["phn"] = $n->filter('td')->eq(2)->text();
                        }
                    } catch (\Throwable $th) {
                        return 0;
                    }
                    if ($n->filter('td')->eq(1)->text() != "") {
                        array_push($c1, [$n->filter('td')->eq(1)->text(), $n->filter('td')->eq(2)->text(), $n->filter('td')->eq(8)->text(), $n->filter('td')->eq(3)->text()]);
                    }
                });

                $c2 = [];
                $temp_arr2 = [];
                foreach ($c1 as $key => $value) {
                    if ($key == 0) {
                        array_push($temp_arr2, $value);
                        continue;
                    } elseif ($value[0] == 1) {
                        array_push($c2, $temp_arr2);
                        $temp_arr2 = [];
                        array_push($temp_arr2, $value);
                    } else {
                        array_push($temp_arr2, $value);
                    }
                }
                $race_arr3 = [];
                foreach ($c2 as $k => $v) {
                    foreach ($v as $kk => $vv) {
                        if (str_contains($clean_hn, preg_replace('/[^A-Za-z0-9\-]/', '', $vv[3])) || str_contains(preg_replace('/[^A-Za-z0-9\-]/', '', $vv[3]), $clean_hn)) {
                            $race_arr3 = $v;
                        }
                    }
                }
                if ($race_arr3) {
                    $c3 = [];
                    foreach ($race_arr3 as $key => $value) {
                        if ($value[0] == "1") {
                            $c3["a1"] = $value;
                        }
                        if ($value[0] == "3") {
                            $c3["a2"] = $value;
                        }
                        if (str_contains($clean_hn, preg_replace('/[^A-Za-z0-9\-]/', '', $value[3])) || str_contains(preg_replace('/[^A-Za-z0-9\-]/', '', $value[3]), $clean_hn)) {
                            $c3["a3"] = $value;
                        }
                        if ((int) $value[1] == 1) {
                            $c3["a4"] = $value;
                        } else {
                            $c3["a4"] = [0, 0, 0];
                        };
                    }
                    $sub["arr1"] = $c3;
                } else {
                    $sub["arr1"] = [];
                }

                $sub["pphn"] = "0";
                $sub["ppfr"] = "0";
            } else {
                $sub["phn"] = "0";
                $sub["pphn"] = "0";
                $sub["ppfr"] = "0";
                $sub["pfr"] = "0";
            }
            array_push($main_arr, $sub);
        }
        return view("ast")->with("last_page", $main_arr)->with("race_title",$race_title);

    }

    public function india_input()
    {
        return view("india_input");
    }

    public function india(Request $req)
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);
        $baseurl = $req->center;
        
        preg_match('/\d{4}-\d{2}-\d{2}/', $baseurl, $event_date);
        $e_date = $event_date[0];

        $craw_current_dist = $goutteClient->request('GET', $baseurl);
        $hourse_current_distance = $craw_current_dist->filter('.archive_time')->each(function ($n) {
            try {
                return $n->text();
            } catch (\Throwable $th) {
               
            }
        });
        
        preg_match("/^\d+/", $hourse_current_distance[0], $matches);
        
        $craw = $goutteClient->request('GET', $baseurl);
        $race_id = $req->race_id;
        $race_id_tag = '#race-'.$race_id. ' .heading_div';
        $heading = $craw->filter($race_id_tag)->each(function ($n) {
            try {
                return $n->text();
            } catch (\Throwable $th) {}
        });
        

        $hourse_data = $craw->filter('.table_body_static tr')->each(function ($n) {
            try {
                $n->filter('td .last-five-runs-lable')->text();
                try {
                    return ['link' => $n->filter('td')->eq(2)->filter("a")->attr('href'), 'hname' => $n->filter('td')->eq(2)->filter("a")->text(), 'no' => $n->filter('td')->eq(0)->text(), 'form' => $n->filter('td .last-five-runs-lable')->text(), 'rt' => $n->filter('td')->eq(11)->text()];
                } catch (\Throwable $th) {
                    return 0;
                }
            } catch (\Throwable $th) {
                try {
                    return ['link' => $n->filter('td')->eq(2)->filter("a")->attr('href'), 'hname' => $n->filter('td')->eq(2)->filter("a")->text(), 'no' => $n->filter('td')->eq(0)->text(), 'form' => '0-0-0', 'rt' => $n->filter('td')->eq(11)->text()];
                } catch (\Throwable $th) {
                    return 0;
                }
            }
        });
        $main = array_filter($hourse_data);

        $main_arr = [];
        $start = $req->start;
        $end = $req->end;
        for ($i = $start; $i <= $end; $i++) {
            $sub = $main[$i];
            $sub["current_distance"] = $matches[0];
            $craw1 = $goutteClient->request('GET', $sub["link"]);
            $count = 0;

            $sub['current_rating'] = $craw1->filter('.horseStatistics-table td .right-serispan')->eq(0)->text();
            
            $craw1->filter('#siretable tr')->each(function ($n) use (&$count, &$sub) {
                try {
                    if (!str_contains($n->filter('.stats-table-row a')->text(), "W") && $count < 3) {
                        $count = $count + 1;
                        $sub["link" . $count] = $n->filter('.stats-table-row a')->attr('href');
                        $sub["dist" . $count] = $n->filter('.stats-table-row')->eq(2)->text();
                        $sub["prtg" . $count] = $n->filter('.stats-table-row')->eq(10)->text();
                        $sub["wt" . $count] = $n->filter('.stats-table-row')->eq(7)->text();
                        $sub["dwin" . $count] = $n->filter('.stats-table-row')->eq(8)->text();
                        $sub["date" . $count] = $n->filter('.stats-table-row')->eq(1)->text();
                    }
                } catch (\Throwable $th) {
                    return 0;
                }
            });
            
            $hourse_name = explode(" ", $sub['hname'])[0];
            try {
                $final1 = "";
                $craw2 = $goutteClient->request('GET', $sub["link1"]);
                $craw2->filter('.center_heading')->each(function ($n) use (&$sub) {
                    $sub['class_name'] = $n->text();
                });

                $rtg_no = "";
                $rrt1 = "";

                $craw2->filter('.dividend_tr')->each(function ($n) use (&$sub, &$rtg_no, &$final1, &$hourse_name,&$rrt1) {
                    try {

                        $rrt1 = $n->filter('td')->eq(12)->text();
                        if (strlen($rrt1) == 6) {
                            $rtg_no = str_split($rrt, 3)[1];
                        } elseif (strlen($rrt1) == 4) {
                            $rtg_no = str_split($rrt1, 2)[1];
                        } else {
                            $rtg_no = 0;
                        }
                        
                    } catch (\Throwable $th) {
                        $rtg_no = 0;
                    }

                    $final1 .= $n->filter('td')->eq(0)->text() . " " . $n->filter('td')->eq(1)->text() . " " . $rtg_no . "<br>";

                    $sub["final1" . $hourse_name] = $final1;
                    if ($n->filter('td')->eq(1)->text() == "1") {
                        $sub["lrtg_no1"] = $rtg_no;
                        $sub["lrtg_line1"] = $n->filter('td')->eq(0)->text() . " " . $n->filter('td')->eq(1)->text() . " " . $rtg_no;
                    }
                    try {
                        if (str_contains($sub['hname'], $n->filter('td')->eq(2)->filter("a")->text()) || str_contains($n->filter('td')->eq(2)->filter("a")->text(), $sub['hname'])) {
                            $sub['phn1'] = $n->filter('td')->eq(1)->text();
                            $sub['pdr'] = $n->filter('td')->eq(8)->text();
                            $sub['codds'] = $n->filter('td')->eq(13)->text();
                        }
                    } catch (\Throwable $th) {
                        return 0;
                    }
                });

            } catch (\Throwable $th) {

                $sub["final1" . $hourse_name] = 0;
                $sub['phn1'] = 1;
            }

            $final2 = "";
            $rtg_no2 = "";
            $_3digit_rtg_arr = "";
            $rrt = 0000;
            try {
                $craw2 = $goutteClient->request('GET', $sub["link2"]);
                $craw2->filter('.center_heading')->each(function ($n) use (&$sub) {
                    $sub['class_name2'] = $n->text();
                });
                $craw2->filter('.dividend_tr')->each(function ($n) use (&$sub, &$final2, &$rtg_no2, &$hourse_name, &$rrt) {
                    $rrt = $n->filter('td')->eq(12)->text();
                    if (strlen($rrt) == 6) {
                        $rtg_no2 = str_split($rrt, 3)[1];
                    } elseif (strlen($rrt) == 4) {
                        $rtg_no2 = str_split($rrt, 2)[1];
                    } else {
                        $rtg_no2 = 0;
                    }
 
                    
                    $final2 .= $n->filter('td')->eq(0)->text() . " " . $n->filter('td')->eq(1)->text() . " " . $rtg_no2 . "<br>";
                    $sub[$sub['phn1']] = $final2;
                    if ($n->filter('td')->eq(1)->text() == "1") {
                        $sub["lrtg_no2"] = $rtg_no2;
                        $sub["lrtg_line2"] = $n->filter('td')->eq(0)->text() . " " . $n->filter('td')->eq(1)->text() . " " . $rtg_no2;
                    }
                    try {
                        if (str_contains($sub['hname'], $n->filter('td')->eq(2)->filter("a")->text()) || str_contains($n->filter('td')->eq(2)->filter("a")->text(), $sub['hname'])) {
                            $sub['pi2'] = $n->filter('td')->eq(0)->text();
                            $sub['phn2'] = $n->filter('td')->eq(1)->text();
                            $sub['pdr1'] = $n->filter('td')->eq(8)->text();
                            $sub['ciodds'] = $n->filter('td')->eq(13)->text();
                        }
                    } catch (\Throwable $th) {
                        return 0;
                    }
                });

            } catch (\Throwable $th) {
                $sub[$sub['phn1']] = $final2;
            }



            // link 3 start
            try {
                $craw3 = $goutteClient->request('GET', $sub["link3"]);
                $craw3->filter('.center_heading')->each(function ($n) use (&$sub) {
                    $sub['class_name3'] = $n->text();
                });
                $craw3->filter('.dividend_tr')->each(function ($n) use (&$sub){
                    try {
                        if (str_contains($sub['hname'], $n->filter('td')->eq(2)->filter("a")->text()) || str_contains($n->filter('td')->eq(2)->filter("a")->text(), $sub['hname'])) {
                            $sub['pi3'] = $n->filter('td')->eq(0)->text();
                            $sub['phn3'] = $n->filter('td')->eq(1)->text();
                            $sub['pdr3'] = $n->filter('td')->eq(8)->text();
                            $sub['ciodds3'] = $n->filter('td')->eq(13)->text();
                        }
                    } catch (\Throwable $th) {
                        return 0;
                    }
                });

            } catch (\Throwable $th) {
                
            }

            array_push($main_arr, $sub);
        }
        return view("india")
        ->with("last_page", $main_arr)->with('heading',$heading[0])
        ->with("event_date",$e_date);

    }


    public function australia_input(){
        return view("ast_input");
    }

    public function australia_output() {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);
        $baseurl = "https://www.racingandsports.com.au/form-guide/thoroughbred/australia/bendigo/2024-10-30/R1";
        
        $craw_dis = $goutteClient->request('GET', $baseurl);
        
        $data = $craw_dis->filter(".pa-table tbody tr ")->each(function ($n) {
            try {
                return $n->filter(".tdContent")->text();
            } catch (\Throwable $th) {
            }
        });

        dd($data);
       
    }

    public function add_user_view() {
        return view("add_user");
    }

    public function add_user(Request $req) {
        $number =  $req->input('number');
        $name =  $req->input('name');
        $e = DB::update('update user set name= ? where mobile = ?', [$name,$number]);
        return view("add_user");
    }

}
