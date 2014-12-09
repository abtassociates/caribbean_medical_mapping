var map = map_helper.buildStandardMap($("#map-canvas"), false);

google.maps.event.addListener(map, 'dragend', center_or_zoom_changed);
google.maps.event.addListener(map, 'zoom_changed', center_or_zoom_changed);

function center_or_zoom_changed(e){

	var center = map.getCenter();
	$("input[name='map_lat']").val(center.lat());
	$("input[name='map_lng']").val(center.lng());

	var distances = map_helper.getDistances(map);
	$("input[name='map_distance_x']").val(distances.x);
	$("input[name='map_distance_y']").val(distances.y);
}