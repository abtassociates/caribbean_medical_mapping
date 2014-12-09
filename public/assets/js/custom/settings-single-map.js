(function($, google, map_data){

  var map;

  function initialize_map() {

    map = new google.maps.Map(
    	document.getElementById("map-canvas"),
     	{
				center: new google.maps.LatLng(map_data.lat, map_data.lng),
				zoom: map_data.zoom
    	}
    );

		google.maps.event.addListener(
	    map,
	    'click',
	    function(e) {
	    	if(!marker){
	    		initialize_marker(
	    			e.latLng.lat(),
	    			e.latLng.lng()
	    		);
	    		$("#clinic-form #lat").val(e.latLng.lat());
	    		$("#clinic-form #lng").val(e.latLng.lng());
	    	}
	    }
		);

  }

})(jQuery, google, map_data);