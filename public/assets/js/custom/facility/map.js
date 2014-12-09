(function(){

  var map, marker;

  function initialize_map() {

  	map = map_helper.buildStandardMap($("#map-canvas"), false);

		google.maps.event.addListener(
	    map,
	    'click',
	    function(e) {
	    	if(!marker){
	    		initialize_marker(
	    			e.latLng.lat(),
	    			e.latLng.lng()
	    		);
	    		$("#facility-form #lat").val(e.latLng.lat());
	    		$("#facility-form #lng").val(e.latLng.lng());
	    	}
	    }
		);

		if($("#facility-form #lat").val() && $("#facility-form #lng").val()){
			initialize_marker(
				$("#facility-form #lat").val(),
				$("#facility-form #lng").val()
			);
		}
  }

	function initialize_marker(markerLat, markerLng){
		marker = new google.maps.Marker({
		    position: new google.maps.LatLng(markerLat, markerLng),
		    map: map,
		    draggable: true
		});

		google.maps.event.addListener(
	    marker,
	    'dragend',
	    function() {
	        $("#facility-form #lat").val(marker.position.lat());
	        $("#facility-form #lng").val(marker.position.lng());
		    }
		);
	}

	function update_marker(){
		var lat = $("#facility-form #lat").val();
		var lng = $("#facility-form #lng").val();
		if(!marker){
			initialize_marker(lat, lng);
		}
		else{
			var latlng = new google.maps.LatLng(lat, lng);
	    	marker.setPosition(latlng);
		}
	}

	$("#facility-form #lat, #facility-form #lng").on('change', update_marker);

	initialize_map();

})();