<?php

$sql = "SELECT id, name, description, start_time, longitude, latitude, cover FROM events";
$result = $conn->query($sql);

$arrDB = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $arrDBs = array();
        array_push($arrDBs,$row["id"],$row["name"],$row["description"],$row["start_time"],$row["longitude"],$row["latitude"],$row["cover"]);
        array_push($arrDB,$arrDBs);
    }
} else {
    echo "0 results";
}

$arrDBi = array_slice($arrDB, 1);

?>
<script>
    var arrDB;
    arrDB = <?php print(json_encode($arrDBi)); ?>;
    console.log(arrDB);
</script>

<!--<script>
    for (var i = 0; i < arrDB.length; i++) {
        var mark = arrDB[i];
        //jQuery('#demo').append('<div><img src="' + mark[5] + '" style="display: block;width: 100%;height: auto;" /><b>' + mark[0] + '</b><p style="color:lightgray">' + mark[4] + '</p><p>' + mark[3] + '</p></div>');

        marker = new google.maps.Marker({
            position: {lat: mark[1], lng: mark[2]},
            map: map,
            title: mark[0]
        });

        var myLatlng = new google.maps.LatLng(mark[1],mark[2]);

        contentString = '<div class="info">'+
            '<div class="siteNotice">'+
            '</div>'+
            '<img src="'+ mark[5] +'" />'+
            '<h1 class="firstHeading">' + mark[0] + '</h1>'+
            '<div class="bodyContent">'+
            '<p style="color:grey;">' + mark[4] + '</p>'+
            '<p>' + mark[3] + '</p>'+
            '</div>'+
            '</div>';

        mArray.push(marker);
        mArray[i].setMap(map);
        makeInfoWin(marker, contentString);
        //jQuery('#loader').fadeOut('slow');

        function makeInfoWin(marker, data) {
            var infowindow = new google.maps.InfoWindow({ content: data });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });

        }
    }
</script>-->
