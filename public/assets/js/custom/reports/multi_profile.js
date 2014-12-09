var facilities_mapped = [];

function get_facility_by_id(id){
	for(i=0; i<facilities.length; i++){
		facility = facilities[i];
		if(facility.id == id){
			return facility;
		}
	}
}

function build_maps(){
	$('.map-canvas:in-viewport').each(function(){

		var facility_id = $(this).attr('facility_id');

		if($.inArray(facility_id, facilities_mapped) == -1){

			facilities_mapped.push(facility_id);

			var map = map_helper.buildStandardMap($(this));

			var facility = get_facility_by_id(facility_id);

			map_helper.addFacilityMarker(map, facility);
		}

	});
}

$('document').ready(build_maps);
$(window).bind("scroll", build_maps);
