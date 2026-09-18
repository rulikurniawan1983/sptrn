// API KEY AIzaSyB2mKD5ZgMQMlX8JwbhpzkyiGdNXvxl6PY
// BARQUN API KEY 2 AIzaSyDLfYq6P5OOj3MsiLaHks4qb7oMbhDXKqM
var typingTimer, address, circle, myGeocoder, map, myMarker, myInfoWindow;

function initMap() {
    myGeocoder 				    = new google.maps.Geocoder;
    myInfoWindow 			    = new google.maps.InfoWindow;
    var defaultLocation 		= new google.maps.LatLng($("#lat-location").val() == '' ?  '0' : $("#lat-location").val(), $("#long-location").val() == '' ? '106.8205377' : $("#long-location").val());
    var bounds 					= new google.maps.LatLngBounds();

    map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 1,
        center: defaultLocation,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    myMarker = new google.maps.Marker({
        position: defaultLocation,
        draggable: true
    });
    
    circle  = new google.maps.Circle({
        map: map,
        radius: parseInt(30),
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
    });
    
    bounds.extend(defaultLocation);
    
    map.fitBounds(bounds);
    map.panToBounds(bounds);
    
    circle.bindTo('center',myMarker,'position');
    
    google.maps.event.addListener(myMarker, 'dragend', function (evt) {
        $("#lat-location").val(evt.latLng.lat().toFixed(10));
        $("#long-location").val(evt.latLng.lng().toFixed(10));
        geocodePosition(map, myGeocoder, map.getCenter(), myMarker, myInfoWindow);
    });
    
    // google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
    //     document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
    // });
    
    var listener = google.maps.event.addListener(map, "idle", function() {
        if (map.getZoom() > 16) map.setZoom(16);
        google.maps.event.removeListener(listener);
    });
    
    map.setCenter(myMarker.position);
    myMarker.setMap(map);

    initFunc(map, myGeocoder, myMarker, myInfoWindow);
}

function initMapEdit(lat, long, radius) {
    console.log(lat, long, radius)
    myGeocoder 				    = new google.maps.Geocoder;
    myInfoWindow 			    = new google.maps.InfoWindow;
    var defaultLocation 		= new google.maps.LatLng(lat, long);
    var bounds 					= new google.maps.LatLngBounds();

    map = new google.maps.Map(document.getElementById('map_canvas_edit'), {
        zoom: 1,
        center: defaultLocation,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    myMarker = new google.maps.Marker({
        position: defaultLocation,
        draggable: true
    });
    
    circle  = new google.maps.Circle({
        map: map,
        radius: parseInt(radius),
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
    });
    
    bounds.extend(defaultLocation);
    
    map.fitBounds(bounds);
    map.panToBounds(bounds);
    
    circle.bindTo('center',myMarker,'position');
    
    google.maps.event.addListener(myMarker, 'dragend', function (evt) {
        $("#lat-location").val(evt.latLng.lat().toFixed(10));
        $("#long-location").val(evt.latLng.lng().toFixed(10));
        geocodePosition(map, myGeocoder, map.getCenter(), myMarker, myInfoWindow);
    });
    
    // google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
    //     document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
    // });
    
    var listener = google.maps.event.addListener(map, "idle", function() {
        if (map.getZoom() > 16) map.setZoom(16);
        google.maps.event.removeListener(listener);
    });
    
    map.setCenter(myMarker.position);
    myMarker.setMap(map);

    initFuncEdit(map, myGeocoder, myMarker, myInfoWindow);
}

function doneTyping() {
    geocodeAddress(myGeocoder, map, myMarker);
}

function geocodeAddress(geocoder, map, marker) {
    var addressSearch = $("#cari-lokasi").val();
    myInfoWindow.setContent('Mencari ' + addressSearch);
    geocoder.geocode({'address': addressSearch}, function (results, status) {
        if (status === 'OK') {
            var position 	= results[0].geometry.location;
            map.setCenter(position);
            marker.setPosition(position);
            geocodePosition(map, myGeocoder, map.getCenter(), myMarker, myInfoWindow);
            $("#lat-location").val(position.lat());
            $("#long-location").val(position.lng());
        } else {
            myInfoWindow.close();
            console.log(status, results);
            alert('Lokasi tidak ditemukan');
            $("#coordinate-text").html('Lokasi Tidak Ditemukan');
        }
    });
}

function geocodePosition(map, geocoder, position, marker, infowindow, onComplete) {
    infowindow.open(map, marker);
    infowindow.setContent('Mencari lokasi....');
    geocoder.geocode({latLng: position}, function (results) {
        try {
            coordinate 		= position.lat() + ',' + position.lng();
            var html 		= "<h5>" + position.lat() + ',' + position.lng() + "</h5>";
            html 			+= results[0].formatted_address;
            infowindow.setContent(html);
            address 		= results[0].formatted_address;
            $("#coordinate-text").html(address);
        } catch (err) {
            infowindow.close();
        }

    });
}

function changeRadius(el) {
    circle.setRadius(parseInt($(el).val()));
}

function initFunc(map, myGeocoder, myMarker, myInfoWindow) {
    if ($("#lat-location").val() == '') {
		$("#lat-location").val('0')
	}
	if ($("#long-location").val() == '') {
		$("#long-location").val('0');
	}

	$("#cari-lokasi").on('keydown', function (e) {
        if (e.keyCode == 13) {
            console.log('enter');
            e.preventDefault();
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, 0);
        } else {
            clearTimeout(typingTimer);
        }
    });

    geocodePosition(map, myGeocoder, map.getCenter(), myMarker, myInfoWindow);
}

function initMapEdit(lat, long, radius) {
    console.log(lat, long, radius)
    myGeocoder 				    = new google.maps.Geocoder;
    myInfoWindow 			    = new google.maps.InfoWindow;
    var defaultLocation 		= new google.maps.LatLng(lat, long);
    var bounds 					= new google.maps.LatLngBounds();

    map = new google.maps.Map(document.getElementById('map_canvas_edit'), {
        zoom: 1,
        center: defaultLocation,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    myMarker = new google.maps.Marker({
        position: defaultLocation,
        draggable: true
    });
    
    circle  = new google.maps.Circle({
        map: map,
        radius: parseInt(radius),
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
    });
    
    bounds.extend(defaultLocation);
    
    map.fitBounds(bounds);
    map.panToBounds(bounds);
    
    circle.bindTo('center',myMarker,'position');
    
    google.maps.event.addListener(myMarker, 'dragend', function (evt) {
        $("#content-geo-tagging-update").find("#lat-location").val(evt.latLng.lat().toFixed(10));
        $("#content-geo-tagging-update").find("#long-location").val(evt.latLng.lng().toFixed(10));
        geocodePositionEdit(map, myGeocoder, map.getCenter(), myMarker, myInfoWindow);
    });
    
    // google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
    //     document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
    // });
    
    var listener = google.maps.event.addListener(map, "idle", function() {
        if (map.getZoom() > 16) map.setZoom(16);
        google.maps.event.removeListener(listener);
    });
    
    map.setCenter(myMarker.position);
    myMarker.setMap(map);

    initFuncEdit(map, myGeocoder, myMarker, myInfoWindow);
}

function initFuncEdit(map, myGeocoder, myMarker, myInfoWindow) {
    if ($("#content-geo-tagging-update").find("#lat-location").val() == '') {
		$("#content-geo-tagging-update").find("#lat-location").val('0')
	}
	if ($("#long-location").val() == '') {
		$("#content-geo-tagging-update").find("#long-location").val('0');
	}

	$("#content-geo-tagging-update").find("#cari-lokasi").on('keydown', function (e) {
        if (e.keyCode == 13) {
            console.log('enter');
            e.preventDefault();
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTypingEdit, 0);
        } else {
            clearTimeout(typingTimer);
        }
    });

    geocodePositionEdit(map, myGeocoder, map.getCenter(), myMarker, myInfoWindow);
}

function geocodePositionEdit(map, geocoder, position, marker, infowindow, onComplete) {
    infowindow.open(map, marker);
    infowindow.setContent('Mencari lokasi....');
    geocoder.geocode({latLng: position}, function (results) {
        try {
            coordinate 		= position.lat() + ',' + position.lng();
            var html 		= "<h5>" + position.lat() + ',' + position.lng() + "</h5>";
            html 			+= results[0].formatted_address;
            infowindow.setContent(html);
            address 		= results[0].formatted_address;
            $("#content-geo-tagging-update").find("#coordinate-text").html(address);
        } catch (err) {
            infowindow.close();
        }

    });
}

function doneTypingEdit() {
    geocodeAddressEdit(myGeocoder, map, myMarker);
}

function geocodeAddressEdit(geocoder, map, marker) {
    var addressSearch = $("#content-geo-tagging-update").find("#cari-lokasi").val();
    myInfoWindow.setContent('Mencari ' + addressSearch);
    geocoder.geocode({'address': addressSearch}, function (results, status) {
        if (status === 'OK') {
            var position 	= results[0].geometry.location;
            map.setCenter(position);
            marker.setPosition(position);
            geocodePosition(map, myGeocoder, map.getCenter(), myMarker, myInfoWindow);
            $("#content-geo-tagging-update").find("#lat-location").val(position.lat());
            $("#content-geo-tagging-update").find("#long-location").val(position.lng());
        } else {
            myInfoWindow.close();
            console.log(status, results);
            alert('Lokasi tidak ditemukan');
            $("#content-geo-tagging-update").find("#coordinate-text").html('Lokasi Tidak Ditemukan');
        }
    });
}