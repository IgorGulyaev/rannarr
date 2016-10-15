<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

require_once __DIR__ . '/sdk/facebook-php-sdk-v4/src/Facebook/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

require_once 'connect.php';

function object_to_array($obj) {
    $arr = array();
    if($obj instanceOf GraphObject){
        if(is_scalar($obj->asArray()) )
            $arr = $obj->asArray();
        else{
            foreach ($obj->getPropertyNames() as $propName) {
                $arr[$propName] = object_to_array($obj->getProperty($propName));
            }
        }
    }else if(is_array($obj)){
        foreach ($obj as $propKey => $propValue) {
            $arr[$propKey] = object_to_array($obj[$propValue]);
        }
    }else $arr = $obj;
    return $arr;
}

/*include 'login.php';*/

/*$access_token = file_get_contents('https://graph.facebook.com/oauth/access_token?client_id=1909067872653575&client_secret=bb71b82ba060f18a84363cf05552327c&grant_type=client_credentials');*/
$access_token = 'EAAbISYBm0QcBALG5fRxa0oHZAtsl4ZCRn2zFOQzmiR5Jn8RHCuZCGjsXr3yaXkCxNraMtTqUbHiBt93C5rz4cQhALD3ncEN98XNOyZBCPxKmDgdprmNrJtS5OKXhMZAXWMYTwZBwlOSy1hkdVcZCy6RZBYo1r65N3CoZD';
/*$access_token = 'EAACEdEose0cBAGTwjElLGfrk5y6FEMrzQfh8D1aRk4hUC0Nipcm4MVlyOwu8iTx0uhyGxZBQLRK0iCmP2Eg5dZCSDMtPhYCus5x7y2XdyZAO3WEclvKuRFoX7894b1fgpfZCQK7ZAFv2MVDZBj8ngK8TmU0dcXM9JDNZA9yG7eg8QZDZD';*/

$fb = new Facebook\Facebook([
    'app_id' => '1909067872653575',
    'app_secret' => 'bb71b82ba060f18a84363cf05552327c',
    'default_graph_version' => 'v2.2',
]);

$fields="id,name,description,place,timezone,cover";
/*$str = 'ш';*/
/*$str = 'abcdefghijklmnopqrstuvwxyzабвгдеєёжзиіїйклмнопрстуфхцчшщъыьэюя1234567890';*/
$str = 'киев київ kiev kyiv голосеево оболонь майдан шулявка олимпийский дарница теремки демеевка русановка печерск';
/*$res = str_split($str);*/
$res = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $str, -1, PREG_SPLIT_NO_EMPTY);
$limit = 100;
$arrLoc = array();
array_push($arrLoc,'0');

foreach($res as $letter) {
    $url = 'https://graph.facebook.com/search?q='.$letter.'&type=event&limit='.$limit.'&access_token='.$access_token.'';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $keys = json_decode($response, true);
    $lev1 = array_keys($keys);
    $lev2 = $keys['data']['0'];
    $lev3 = $keys['data'];

    foreach (array_keys($lev3) as $propName) {
        $arr = array();
        $arr[$propName] = $lev3[$propName];
        $valid = 0;
        $evId = $arr[$propName]['id'];
        foreach ($arrLoc as $it) {
            if ($it == $evId) {
                $valid = 1;
                break;
            }
        }
        $evCity = $arr[$propName]['place']['location']['city'];
        $evLon = $arr[$propName]['place']['location']['longitude'];
        $evLat = $arr[$propName]['place']['location']['latitude'];
        if ($valid == 0 && $evCity == 'Kyiv' && $evLon && $evLat) {
            array_push($arrLoc,$evId);
        }
    }
}

$arrLocDB = array_slice($arrLoc, 1);
var_dump($arrLocDB);
echo "<br />";
echo "*******************************************************************<br />";
echo "*******************************************************************<br />";
echo "*******************************************************************<br />";
echo "<br />";

foreach ($arrLoc as $id) {
    $gUrl = "https://graph.facebook.com/v2.7/".$id."/?fields=name%2Cdescription%2Cstart_time%2Ccover%2Cplace&access_token=".$access_token."";
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, $gUrl);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    $response2 = curl_exec($ch2);
    curl_close($ch2);
    $keys2 = json_decode($response2, true);
    var_dump($keys2);

    $levDB = $keys2['data']['0'];

    $eId = $keys2['id'];
    $eCity = $keys2['place']['location']['city'];
    $eLon = $keys2['place']['location']['longitude'];
    $eLat = $keys2['place']['location']['latitude'];
    $eName = $keys2['name'];
    $eDesc = $keys2['description'];
    $eSTime = $keys2['start_time'];
    $eCover = $keys2['cover']['source'];

    htmlentities($str, ENT_QUOTES);
    echo "<img src=".$eCover." />";
    echo "<p style='font-size: 14px;font-weight: bold;color:red;'>".$eId."</p>";
    echo "<p style='font-size: 14px;font-weight: bold;color:orangered;'>".$eCity."</p>";
    echo "<h3 style='color:midnightblue;'>".$eName."</h3>";
    echo "<p style='font-size: 10px;color:crimson;'>Lon: ".$eLon."; Lat: ".$eLon."</p><br />";
    echo "<p style='font-size: 10px;color:darkolivegreen;'>".$eDesc."</p><br />";
    echo "<br /> ------------ <br />";

    $sql = 'INSERT INTO events (id, name, description, start_time, longitude, latitude, cover) VALUES ("'.htmlentities($eId, ENT_QUOTES).'", "'.htmlentities($eName, ENT_QUOTES).'", "'.htmlentities($eDesc, ENT_QUOTES).'", "'.htmlentities($eSTime, ENT_QUOTES).'", "'.htmlentities($eLon, ENT_QUOTES).'", "'.htmlentities($eLat, ENT_QUOTES).'", "'.htmlentities($eCover, ENT_QUOTES).'")';

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

?>