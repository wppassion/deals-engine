
google.maps.event.addDomListener(window, 'load', function() {
	
    var geocoder = new google.maps.Geocoder();
    
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: new google.maps.LatLng(0, 0),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: false,
		streetViewControl: false,
		panControl: false,
		zoomControlOptions: { position: google.maps.ControlPosition.LEFT_BOTTOM }
    });
    var bounds = new google.maps.LatLngBounds();	
    var marker_url = Wps_Deals_Map['URL'];
    var Wps_Deals_Map_Loactions = Wps_Deals_Map['locations'];
    
    // Add the markers and infowindows to the map
    for (var i = 0; i < Wps_Deals_Map_Loactions.length; i++) {
    	
	    var address = Wps_Deals_Map_Loactions[i]['gmap_address'];
	    var popupmaxwidth = Wps_Deals_Map_Loactions[i]['gmap_popup_width'];
	    var popupcontent = Wps_Deals_Map_Loactions[i]['gmap_popup_content'];
	    
		cm_createMarker(geocoder, address, map, 0, popupcontent);//
	} // End of for loop
	
	function cm_createMarker(geocoder, address, map, num, contentString) {
		
		if (geocoder) {
			geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
				var numbers = new Array(9)
				numbers[0] = 0;
				numbers[1] = 8;
				numbers[2] = 7;
				numbers[3] = 6;
				numbers[4] = 5;
				numbers[5] = 2;
				numbers[6] = 3;
				numbers[7] = 2;
				numbers[8] = 1;
				var iconSize = new google.maps.Size(33, 53);
				var iconShadowSize = new google.maps.Size(33, 53);
				var iconHotSpotOffset = new google.maps.Point(33, 53); 
				var iconPosition = new google.maps.Point(0, 0);
				var iconShadowUrl = marker_url+'includes/images/marker_shadow.png';
				var iconImageUrl;
				iconImageUrl = marker_url+'includes/images/map_marker.png';
				var markerImage = new google.maps.MarkerImage(iconImageUrl, iconSize, iconPosition, iconHotSpotOffset);
				var markerShadow = new google.maps.MarkerImage(iconShadowUrl, iconShadowSize, iconPosition, iconHotSpotOffset);
				var markerOptions = {
										icon: markerImage,
										shadow: markerShadow,
										position: results[0].geometry.location,
										map: map,
										zIndex: numbers[num]
										
									}
                    var marker = new google.maps.Marker(markerOptions);
                    var infowindow = new google.maps.InfoWindow();
                    infowindow.setOptions({
                        content: contentString,
                        maxWidth: popupmaxwidth,
                    });
                    
                    bounds.extend(marker.getPosition());
		       		map.fitBounds(bounds);
		       		
					if(map.getZoom()> 14){
						map.setZoom(14);
					}
                    
                    google.maps.event.addListener(marker, 'click', function() {
                    	infowindow.open(map,marker);
                    	//var ib = new InfoBox(myOptions);
				        //ib.open(map, marker);
                    	//var infobox = new SmartInfoWindow({position: marker.getPosition(), map: map, content: contentString});
                    });
                   // map.setCenter(results[0].geometry.location);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    }
});