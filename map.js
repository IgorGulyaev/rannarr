var map;
var marker;
var markers = [];
var events = [];
var eventsItems = [];
var mArray = [];
var contentString = [];
var picUrl;

function loadDoc() {
    getFB();
}

/*function getFB() {
    console.log('getFB execute');
    jQuery('#loader').fadeIn('slow');
    var city = jQuery('#city').val();
    var eRange = jQuery('#range').val();
    var $fields="id,name,description,place,timezone,cover";
    var $access_token = "1909067872653575|bb71b82ba060f18a84363cf05552327c";
    var str = "киев київ kiev kyiv";
    var res = str.split(" ");
    var ePic;

    var operationsCompleted = 0;
    function operation() {
        ++operationsCompleted;
        if (operationsCompleted === 4) getEvent();
    }

    for(var letter in res) {
        var letter = res[letter];
        FB.api(
            '/search',
            'GET',
            {"q":letter,"type":"event","limit":eRange},
            function(response) {
                var r = JSON.stringify(response);
                for(var eKey in response) {
                    var value = response[eKey];
                    var iIt = 0;
                    for(var inkey in value) {
                        var invalue = value[inkey];
                        if (invalue['name'] != null) {
                            events.push(invalue["id"]);
                        }
                        console.log(invalue);
                        iIt++;
                    }
                }
                operation();
            }
        );
    }
}*/

/*function getEvent() {
    console.log('getEvent execute');
    var eventsCompleted = 0;
    var eRange = jQuery('#range').val();
    if (eRange < 10) {var spd = 500} else {var spd = eRange*60};
    function operationEvents() {
        ++eventsCompleted;
        if (eventsCompleted === events.length) mapGo();
    }
    for (var i = 0; i < events.length; i++) {
        var iEvent = events[i];
        function getEventItem(){
            FB.api(
                '/'+iEvent+'',
                'GET',
                {"fields":"name,description,start_time,cover,place"},
                function (eResponse) {
                    var eR = [];
                    var cover = '';
                    var latd = '';
                    var lont = '';
                    if (eResponse && !eResponse.error) {
                        if (eResponse.cover != null) {
                            cover = eResponse.cover.source;
                        } else {
                            cover = 'thumb.jpg';
                        }
                        if (eResponse.place) {
                            if (eResponse.place.location) {
                                if (eResponse.place.location.city == "Kyiv") {
                                    if (eResponse.place.location.latitude) {
                                        latd = eResponse.place.location.latitude;
                                        lont = eResponse.place.location.longitude;
                                        eR.push(eResponse.name, latd, lont, eResponse.description, eResponse.start_time, cover, eResponse.place);
                                        customFunction(eR);
                                    }
                                }
                            }
                        }
                    }
                }
            );
        }
        getEventItem();
        function customFunction(eI) {
            markers.push(eI);
            console.log(eI);
        }
        setTimeout(operationEvents, spd);
    }
}*/

function mapGo() {
    console.log('mapGo execute');
    console.log(arrDB);
    for (var i = 0; i < arrDB.length; i++) {
        var mark = arrDB[i];
        jQuery('#demo').append('<div><img src="' + mark[6] + '" style="display: block;width: 100%;height: auto;" /><b>' + mark[1] + '</b><p style="color:lightgray">' + mark[3] + '</p><p>' + mark[2] + '</p></div>');

        var lngDB = parseFloat(mark[4]);
        var latDB = parseFloat(mark[5]);
        console.log(latDB);
        console.log(lngDB);
        marker = new google.maps.Marker({
            position: {lat: latDB, lng: lngDB},
            map: map,
            title: mark[1]
        });

        var myLatlng = new google.maps.LatLng(latDB,lngDB);

        contentString = '<div class="info">'+
            '<div class="siteNotice">'+
            '</div>'+
            '<img src="'+ mark[6] +'" />'+
            '<h1 class="firstHeading">' + mark[1] + '</h1>'+
            '<div class="bodyContent">'+
            '<p style="color:grey;">' + mark[3] + '</p>'+
            '<p>' + mark[2] + '</p>'+
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
}

function resetDoc() {
    jQuery('#demo').html('');
    clearMarkers();
    markers = [];
    events = [];
    eventsItems = [];
    mArray = [];
    contentString = [];
}

function clearMarkers() {
    setMapOnAll(null);
}

function setMapOnAll(map) {
    for (var i = 0; i < mArray.length; i++) {
        mArray[i].setMap(map);
    }
}

function file_get_contents( url ) {	// Reads entire file into a string
    //
    // +   original by: Legaev Andrey
    // %		note 1: This function uses XmlHttpRequest and cannot retrieve resource from different domain.

    var req = null;
    try { req = new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {
        try { req = new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {
            try { req = new XMLHttpRequest(); } catch(e) {}
        }
    }
    if (req == null) throw new Error('XMLHttpRequest not supported');

    req.open("GET", url, false);
    req.send(null);

    return req.responseText;
}


function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 50.4500941, lng: 30.524078},
        zoom: 12
    });
    var infoWindow = new google.maps.InfoWindow({map: map});

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }

    /*var input = document.getElementById('city');
    var options = {
        types: ['(cities)'],
        componentRestrictions: {country: 'ua'}
    };

    autocomplete = new google.maps.places.Autocomplete(input, options);*/
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}