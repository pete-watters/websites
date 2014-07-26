<?php
/**
 * @author meekamoo - bryan paddock
 * @copyright 2008
*/
$debug = false;

($_REQUEST['url']) ? $url = $_REQUEST['url'] : $url = 'http://pricefeed.willhill.com/dataFeed.aspx?sport=FB&market=WMT&inRunning=False';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

if (!$debug) $xmldata = curl_exec ($ch);

curl_close ($ch);

if ($debug) unset($xmldata);

if ($xmldata) {
  $xmlsrc = simplexml_load_string($xmldata);
} elseif (is_file('odds.xml')) {
  $xmlsrc = simplexml_load_file('odds.xml');
} else {
  die('<p>Cannot load odds data. Please retry in a few minutes.</p>');
}


// ok convert it to an array
$xml = simplexml2array($xmlsrc);

// start at the sports
$sports = $xml['sport'];

// ----------------------------------------------------------------------------------------------------
// ok lets go through this and ensure that the markets are all in arrays
// ie if only one market there is no array. i need it to be an array with only 1 index so its in same format as if multiple events
// ----------------------------------------------------------------------------------------------------

foreach($sports['event'] as $eKey => $event) {
  if (! $event['market'][0]) {
    $sports['event'][$eKey]['market'] = array($event['market']);
  }
}

// ----------------------------------------------------------------------------------------------------
// REMOVING TEXT
// ----------------------------------------------------------------------------------------------------

array_walk($sports, 'remove_text');

// ----------------------------------------------------------------------------------------------------
// CLEANING
// ----------------------------------------------------------------------------------------------------


foreach($sports['event'] as $eKey => $event) {
  unset($newmarket);
  foreach($event['market'] as $mKey => $market) {
    
    // clean participants
    $participants = array
                        (
                          array(
                            $market['participant'][0]['@attributes']['odds'],
                            $market['participant'][1]['@attributes']['odds'],
                            $market['participant'][2]['@attributes']['odds']
                          ),
                          array(
                            $market['participant'][0]['@attributes']['oddsDecimal'],
                            $market['participant'][1]['@attributes']['oddsDecimal'],
                            $market['participant'][2]['@attributes']['oddsDecimal']
                          )                            
                        );
    
    $newmarket[] = array(
      '@attributes'   => array(
                            'name'          => $market['@attributes']['name'],
                            'id'            => $market['@attributes']['id'],
                            'couponLink'    => $market['@attributes']['couponLink'],
                            'betTillDate'   => $market['@attributes']['betTillDate'],
                            'betTillTime'   => $market['@attributes']['betTillTime']),

      'participant'   => $participants
    );
    
    $sports['event'][$eKey]['market'] = $newmarket;
    
  }
}

// ----------------------------------------------------------------------------------------------------
// REMOVING DUPLICATES
// ----------------------------------------------------------------------------------------------------


// loop thru all events
foreach($sports['event'] as $eKey => $event) {
  
  // loop thru all markets
  foreach($event['market'] as $mKey => $market) {
    
    if (! dupefinder($market)) {
      $events[$eKey]['@attributes'] = $event['@attributes'];
      $events[$eKey]['market'][] = $market;
    }

  }

}

// ----------------------------------------------------------------------------------------------------
// RSS OUTPUT
// ----------------------------------------------------------------------------------------------------


if ($events) {

  // ok start outputting RSS
  header("Content-Type: application/rss+xml");

?>
<rss version="2.0">
<channel>
  <title>OddsPress</title>
  <link>http://www.oddspress.com</link>
  <description>OddsPress Plugin</description>
  <pubDate><?php echo(date("r")); ?></pubDate>
  <generator>http://www.oddspress.com</generator>
  <language>en</language>

<?php
    foreach($events as $event) {
      foreach($event['market'] as $market) {
        if (isset($_REQUEST['pacompid'])) {
          // we're only selecting one
          if ($event['@attributes']['pacompid'] != $_REQUEST['pacompid']) {
            continue;
          }
        }
?>

  <item>
    <title compid="<?=$event['@attributes']['pacompid'];?>" name="<?=$event['@attributes']['name'];?>"><?=$market['@attributes']['name'];?></title>
    <link><?=$market['@attributes']['couponLink'];?></link>
    <pubDate><?=$market['@attributes']['betTillTime'];?>#<?=$market['@attributes']['betTillDate'];?></pubDate>
    <description><?=$market['participant'][0][0];?>#<?=$market['participant'][0][1];?>#<?=$market['participant'][0][2];?>#<?=$market['participant'][1][0];?>#<?=$market['participant'][1][1];?>#<?=$market['participant'][1][2];?></description>
  </item>

<?php
    }
  }
} // endif ($events)
?>

  </channel>
</rss>

<?php 

// ----------------------------------------------------------------------------------------------------
// FUNCTIONS
// ----------------------------------------------------------------------------------------------------

function simplexml2array($xml) {
  if (get_class($xml) == 'SimpleXMLElement') {
    $attributes = $xml->attributes();
    foreach($attributes as $k=>$v) {
      if ($v) $a[$k] = (string) $v;
    }
    $x = $xml;
    $xml = get_object_vars($xml);
  }

  if (is_array($xml)) {
    if (count($xml) == 0) return (string) $x; // for CDATA
    foreach($xml as $key=>$value) {
      $r[$key] = simplexml2array($value);
    }
    //if (isset($a)) $r['@'] = $a;    // Attributes
    return $r;
  }
  
  return (string) $xml;
}

// function: dupefinder

// returns true if DUPE
// returns false if UNIQUE
//
// must ignore the couponID and just use any one of them (as long as event name/id/participants are the same)

function dupefinder($market) {
  global $dupes;
  
  if (! $dupes) { 

    // cant just store array as is. need to remove the coupon id as those must not be checked
    
    $dupes[] = array(
      '@attributes' => array(
                          'name'        => $market['@attributes']['name'],
                          'id'          => $market['@attributes']['id'],
                          'betTillDate' => $market['@attributes']['betTillDate'], 
                          'betTillTime' => $market['@attributes']['betTillTime']
                      ),
      'participant' => $market['@attributes']['participant']
    );
    
    return false;
  } else {

    // need to create a new test array that doesnt contain the couponid
    
    $test = array(
      '@attributes' => array(
                          'name'        => $market['@attributes']['name'],
                          'id'          => $market['@attributes']['id'],
                          'betTillDate' => $market['@attributes']['betTillDate'], 
                          'betTillTime' => $market['@attributes']['betTillTime']
                      ),
      'participant' => $market['@attributes']['participant']
    );

    
    if (in_array($test, $dupes)) {
      return true;
    } else {
      $dupes[] = $test;
      return false;
    }
  }
}

// function: filter_names
//
// goes through the array and filters out specific titles

function remove_text(&$item, $key) {
  $remove = array(
    ' - Winning Match With Tie',
    ' - Match Betting'    
  );
  
  if (is_array($item)) {
    array_walk($item, 'remove_text');
  } else {
    foreach($remove as $line) {
      if (strstr($item, $line)) {
        $item = trim(str_replace($line, '', $item));
      }
    }
  }
}

?>