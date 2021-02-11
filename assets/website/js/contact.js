$(document).ready(function(){
    "use strict";
	$.getJSON(BDTASK.getSiteAction('home/settings'), function(result) {
		var LatLngs = result.latitude;	
		initMap();		
	    function initMap() {
	        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
	        var chars = LatLngs.split(',');
	        var mapOptions = {
	            zoom: 11,
	            center: new google.maps.LatLng(parseFloat(chars[0]), parseFloat(chars[1])),
	            styles: [{"stylers": [{"hue": "#007fff"}, {"saturation": 89}]}, {"featureType": "water", "stylers": [{"color": "#ffffff"}]}, {"featureType": "administrative.country", "elementType": "labels", "stylers": [{"visibility": "off"}]}]
	        };
	        var mapElement = document.getElementById('map');
	   
	        var map 		= new google.maps.Map(mapElement, mapOptions);
	        var marker 		= new google.maps.Marker({
	            position: new google.maps.LatLng(parseFloat(chars[0]), parseFloat(chars[1])),
	            map: map,
	            title: 'Snazzy!'
	        });
	    }
	});
});
