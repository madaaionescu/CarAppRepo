/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var directionsDisplay;
var directionsService;

function initialize() {
    directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer();
    var mapOptions = {
        center: new google.maps.LatLng(47.161336, 27.587137),
        zoom: 13,
    };

    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    directionsDisplay.setMap(map);
}

function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';

    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
    document.body.appendChild(script);
}

function calcRoute() {

    var start = document.getElementById("start").value;
    var end = document.getElementById("stop").value;

    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(result);
        }
    });
}

// incarca harta 
window.onload = loadScript;
		