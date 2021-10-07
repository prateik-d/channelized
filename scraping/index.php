<?php

include "simple_html_dom.php";

$servername = "localhost:3308";
$port = "3308";
$username = "staging2020";
$password = 'PassWorD$staging';
$dbname = "channelisedstaging"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM `events` where is_scrap = 1";
$result = $conn->query($sql);
$existData = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $existData[] = $row["name"];
    }
}

function scrap(){
    $html = file_get_contents('https://fst.net.au/events/'); //get the html returned from the following url
    $pokemon_doc = new DOMDocument();
    libxml_use_internal_errors(TRUE); //disable libxml errors
    if(!empty($html)){ //if any html is actually returned
        $pokemon_doc->loadHTML($html);
        libxml_clear_errors(); //remove errors for yucky html
        $pokemon_xpath = new DOMXPath($pokemon_doc);
        $pokemon_row = $pokemon_xpath->query('//div[@class="gt-event-style-1"]');
        if($pokemon_row->length > 0){
            $events = [];
            foreach($pokemon_row as $i=>$row){
                $aname = $pokemon_xpath->query('div[@class="gt-title"]/a', $row);
               
                if(in_array($aname[0]->nodeValue, $GLOBALS['existData'])){
                    continue;
                }
                foreach($aname as $rowa){
                    $events[$i]['scrap_url'] = trim("https://fst.net.au/events");
                    $events[$i]['name'] = trim($rowa->nodeValue);
                    $events[$i]['url'] = trim($rowa->getAttribute("href"));
                }
                $adate = $pokemon_xpath->query('div[@class="gt-details"]/div[@class="gt-date"]/span', $row);
                foreach($adate as $rowd){
                    $div = explode(' - ', $rowd->nodeValue);
                    $events[$i]['start_date'] = trim(date('Y-m-d', strtotime($div[0])));
                    $events[$i]['end_date'] = (isset($div[1]) ? trim(date('Y-m-d', strtotime($div[1]))) : trim(date('Y-m-d', strtotime($div[0]))));
                }

                $vdate = $pokemon_xpath->query('div[@class="gt-details"]/div[@class="gt-venue"]/ul', $row);
                foreach($vdate as $rowv){
                    $events[$i]['location'] = trim($rowv->nodeValue);
                    $events[$i]['city'] = NULL;
                }
                $sub = scrap_sub_page($events[$i]['url']);

                $events[$i] = array_merge($events[$i], $sub);
            //break;
            }
            return $events;
        }
    }
}

//https://simplehtmldom.sourceforge.io/manual.htm#section_dump
//https://devhints.io/xpath

function scrap_sub_page($url){
    $html = file_get_contents($url); //get the html returned from the following url
    $pokemon_doc = new DOMDocument();
    libxml_use_internal_errors(TRUE); //disable libxml errors
    if(!empty($html)){ //if any html is actually returned
        $pokemon_doc->loadHTML($html);
        libxml_clear_errors(); //remove errors for yucky html
        $pokemon_xpath = new DOMXPath($pokemon_doc);
        $pokemon_row = $pokemon_xpath->query('//div[@class="gt-page-content event-top-section"]/div[@class="gt-content"]');
        $events = [
            'start_time' => NULL,
            'end_time' => NULL,
        ];
        if($pokemon_row->length > 0){
            foreach($pokemon_row as $i=>$row){
                $string = $row->nodeValue;
                // Remove \ from "
                $string = str_replace('\"', '"', $string);    
                // Escape single quotes
                $string = str_replace("'", "\'", $string);
                $events['description'] = trim($string);
            }
        }
        $pokemon_row = $pokemon_xpath->query('//li[@class="gt-start-date"]/div[@class="gt-content"]/div[@class="gt-inner"]');
        if($pokemon_row->length > 0){
            foreach($pokemon_row as $i=>$row){
                $events['start_time'] = date("H:i:s", strtotime($row->nodeValue));
            }
        }
        $pokemon_row = $pokemon_xpath->query('//li[@class="gt-end-date"]/div[@class="gt-content"]/div[@class="gt-inner"]');
        if($pokemon_row->length > 0){
            foreach($pokemon_row as $i=>$row){
                $events['end_time'] = date("H:i:s", strtotime($row->nodeValue));
            }
        }
        return $events;
    }
}

function scrapSec(){
    $html = file_get_contents('https://10times.com/australia/technology'); //get the html returned from the following url
    $pokemon_doc = new DOMDocument();
    libxml_use_internal_errors(TRUE); //disable libxml errors
    if(!empty($html)){ //if any html is actually returned
        $pokemon_doc->loadHTML($html);
        libxml_clear_errors(); //remove errors for yucky html
        $pokemon_xpath = new DOMXPath($pokemon_doc);
        $pokemon_row = $pokemon_xpath->query('//tbody[@id="content"]/tr[@class="box"]');
        if($pokemon_row->length > 0){
            $events = []; $j = 0;
            foreach($pokemon_row as $i=>$row){
                $dd = $pokemon_xpath->query('td[1]/span', $row);
                if($dd->length==0){
                    $aname = $pokemon_xpath->query('td[2]/h2/a', $row);
                    if($aname->length > 0){
                        if(in_array($aname[0]->nodeValue, $GLOBALS['existData'])){
                            continue;
                        }
                        foreach($aname as $rowa){
                            $events[$j]['scrap_url'] = trim("https://10times.com/australia/technology");
                            $events[$j]['name'] = trim($rowa->nodeValue);
                            $events[$j]['url'] = trim($rowa->getAttribute("href"));
                            $rrr = scrapSec_sub_page($events[$j]['url']);
                            $events[$j] = array_merge($events[$j], $rrr);
                        }
                        $j++;
                    }
                }else{
                    continue;
                }
               //break;
            }
            return $events;
        }
    }
}

function scrapSec_sub_page($url){
    $html = file_get_contents($url); //get the html returned from the following url
    //$html = file_get_contents("https://10times.com/sydney-penrith-technology-expo"); //get the html returned from the following url
    $pokemon_doc = new DOMDocument();
    libxml_use_internal_errors(TRUE); //disable libxml errors
    if(!empty($html)){ //if any html is actually returned
        $pokemon_doc->loadHTML($html);
        libxml_clear_errors(); //remove errors for yucky html
        $pokemon_xpath = new DOMXPath($pokemon_doc);
        
        $events = [];
        $pokemon_row = $pokemon_xpath->query('//div[@class="lead mb-0"]/span');
        if($pokemon_row->length > 0){
            $dat = [];
            foreach($pokemon_row as $n=>$row){
                $dat[$n] = $row->getAttribute("content");
            }
            $events['start_date'] = trim($dat[0]);
            $events['end_date'] = (isset($dat[1]) ? trim($dat[1]) : trim($dat[0]));
        }

        $pokemon_row = $pokemon_xpath->query('//div[@class="lead mb-0"][2]');
        if($pokemon_row->length > 0){
            foreach($pokemon_row as $n=>$row){
                if(isset($row->childNodes[1]->tagName) && $row->childNodes[1]->tagName=="a"){
                    $events['location'] = NULL;
                    $events['city'] = trim($row->childNodes[1]->nodeValue);
                }else{
                    $events['location'] = trim(str_replace(',','',$row->childNodes[1]->nodeValue));
                    $events['city'] = trim($row->childNodes[2]->nodeValue);
                }
            }
        }

        $pokemon_row = $pokemon_xpath->query('//tr[@id="hvrout1"]/td[1]');
        if($pokemon_row->length > 0){
            foreach($pokemon_row as $n=>$row){
                $info = trim($row->childNodes[1]->nodeValue);
                preg_match_all('/M/', $info,$matches, PREG_OFFSET_CAPTURE);  
                $infoPos = $matches[0][1][1]+1;
                $time = explode('-', str_replace(' ','',substr($info,0,$infoPos)));
                $events['start_time'] = date("H:i:s", strtotime($time[0]));
                $events['end_time'] = date("H:i:s", strtotime($time[1]));
            }
        }

        $pokemon_row = $pokemon_xpath->query('//p[@class="desc mng word-break"]');
        if($pokemon_row->length > 0){
            foreach($pokemon_row as $n=>$row){
                $string = $row->nodeValue;
                // Remove \ from "
                $string = str_replace('\"', '"', $string);    
                // Escape single quotes
                $string = str_replace("'", "\'", $string);
                $events['description'] = $string;
            }
        }
        return $events;
    }
}

//https://gist.github.com/LeCoupa/8c305ec8c713aad07b14

/* echo '<pre>';
echo microtime();
echo '<br />';
print_r(scrap());
echo '<br />';
print_r(scrapSec());
echo '<br />';
echo microtime();
die(); */

$data = array_merge(scrap(), scrapSec());

if(is_array($data) && count($data)==0){
    echo 'no new event found';
    die();
}

$sql = $loc = [];
foreach($data as $d){
    $sql[] = "INSERT INTO `events` (`name`, `registration_link`, `start_date`, `end_date`, `summary`, `is_scrap`, `scrap_link`, `start_duration`, `end_duration`, `status`, `added_by`) VALUES ('".trim($d['name'])."', '".trim($d['url'])."', '".trim($d['start_date'])."', '".trim($d['end_date'])."', '".trim($d['description'])."', 1, '".trim($d['scrap_url'])."', '".trim($d['start_time'])."', '".trim($d['end_time'])."', 'approved', 4);";
    
    $getsql = "SELECT id FROM cities WHERE name='".$d['city']."' LIMIT 1";
    $getresult = $conn->query($getsql);
    $city_id = 0;
    if ($getresult->num_rows > 0) {
        $row = $getresult->fetch_assoc();
        $city_id = $row['id'];
    }

    $loc[] = "INSERT INTO `event_locations` (`location`, `city_id`, `event_id`) VALUES ('".trim($d['location'])."', $city_id, 'event_id_value')";
}

if (count($sql) > 0) {
    foreach($sql as $i => $sin){
        if ($conn->query($sin) === TRUE) {
            $last_id = $conn->insert_id;
            $citysql = str_replace('event_id_value', $last_id, $loc[$i]);
            if ($conn->query($citysql) === FALSE) {
                die($conn->error);
            }
        }else{
            die($conn->error);
        }
    }
    echo "New record created successfully";
} else if(!empty($sql)){
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();