<?php
$servername = "itef.mysql.ukraine.com.ua";
$username = "itef_eventsdevdb";
$password = "uvcgzzju";
$dbname = "itef_eventsdevdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query("SET NAMES 'utf8'");
mysqli_query("SET CHARACTER SET 'utf8'");
mysqli_query("SET SESSION collation_connection = 'utf8_general_ci'");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    /*echo "Connected successfully";
    if (!$conn->set_charset("utf8")) {
        printf("Error loading character set utf8: %s\n", $conn->error);
    } else {
        printf("Current character set: %s\n", $conn->character_set_name());
    }*/
}

?>