<?php
use App\Option;

// menu active
function menu_active($route, $route2 = '', $route3 = '', $route4 = '', $route5 = ''){
    if (Request::routeIs($route) || Request::routeIs($route2) || Request::routeIs($route3) || Request::routeIs($route4) || Request::routeIs($route5)){
        return true;
    }else{
        return false;
    }
}

// bangla slug maker

function slug_maker($text){
    // creating slug
    $remove_question = str_replace('?', ' ', $text);
    $remove_slash = str_replace('/', ' ', $remove_question);
    $slug = preg_replace('/\s+/u', '-', trim($remove_slash));
    return $slug;
}

// date maker
function date_maker($date, $format){
    return date_format(date_create($date), $format);
}

//rating calculator

function rating_calculator($star, $ratings){
    if ($star == 0){
        return 0;
    }
    $result = $star / $ratings;
    $rounded_result = round($result, 2);
    $whole = floor($rounded_result);
    $fraction = $rounded_result - $whole;
    if ($fraction > .50){
        $fraction = 1;
    }elseif ($fraction > .0){
        $fraction = .5;
    }
    return $whole + $fraction;
}

// social share
function fb_share($link){
    return "https://www.facebook.com/sharer/sharer.php?{$link};src=sdkpreparse";
}
function twitter_share($link){
    return "https://twitter.com/share?ref_src={$link}";
}
function share_to_mail($subject, $link){
    return "mailto:?subject={$subject}&body={$link}";
}

// get option value
function option($title){
    if (Option::where('title', $title)->exists()){
        return Option::where('title', $title)->first()->value;
    }
    return ' ';
}

// send sms
function sendSms($number, $text){
    $url = "http://66.45.237.70/api.php";
    $data= array(
        'username'=>"mrashk197",
        'password'=>"MeCpFe100$",
        'number'=>"$number",
        'message'=>"$text"
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $smsresult = curl_exec($ch);
    $p = explode("|",$smsresult);
    $sendstatus = $p[0];
    return $sendstatus;
}
