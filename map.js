function geo(){
	
	if(navigator.geolocation){
		var geo_options = {
			enableHighAccuracy: true
		};
		
		watchID = navigator.geolocation.watchPosition(geo_success, geo_error, geo_options);
	}
	
		function geo_error(){
			alert('Geolocation is not supported');
		}
	
}

google.maps.event.addDomListener(window, 'load', geo);
	
function geo_success(position){

	    // Display User Map //
		var userLat = position.coords.latitude;
		var userLng = position.coords.longitude;
	
		var userCoords = new google.maps.LatLng(userLat, userLng);
		
		localStorage.setItem("usercoords", userCoords);
	
		var options = {
			zoom: 15,
			center: userCoords,
			mapTypeControl: false,
			navigationControlOptions: {
			style: google.maps.NavigationControlStyle.SMALL
		},
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};	
	
		var userMap = new google.maps.Map(document.getElementById("user_canvas"), options);
		google.maps.event.trigger(userMap, 'resize');
	
		var userMarker = new google.maps.Marker({
			position: userCoords,
			map: userMap,
			title:"YOU",
			icon: 'http://labs.google.com/ridefinder/images/mm_20_green.png'
		});
		
		var contentstring = '<div> You are a USER!</div>';
		var infowindow = new google.maps.InfoWindow({
			content:contentstring
		});
	
		google.maps.event.addListener(userMarker,'mouseover',function(){
			infowindow.open(userMap,userMarker);
		});
		
		var marker = new google.maps.Marker({
			position:{lat: 27.72, lng: 85.36},
			map: userMap,
			title:"Brewery",
			icon: 'http://maps.google.com/mapfiles/kml/pal2/icon32.png'
		});
		
		var searchBox = new google.maps.places.SearchBox(document.getElementById('mapsearch'));
		
		//place change event on search box
	    google.maps.event.addListener(searchBox, 'places_changed', function(){
			
			//console.log(searchBox.getPlaces());
			var places = searchBox.getPlaces();
			
			//bound
			var bounds = new google.maps.LatLngBounds();
			var i, place;
			
			for(i=0; place=places[i];i++){
				
				//console.log(place.geometry.location);
				
				bounds.extend(place.geometry.location);
				marker.setPosition(place.geometry.location); // set marker position
			}
			
			userMap.fitBounds(bounds); //fit to bound
			userMap.setZoom(15); 
		});	
}

