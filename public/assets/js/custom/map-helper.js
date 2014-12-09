var map_helper = (function($, google, default_map_data){
      
  // public
  var module = {};

  module.addFacilityMarker = function(map, facility){

    var marker = null;

    if(facility.lat && facility.lng){
      var latlng = new google.maps.LatLng(facility.lat, facility.lng);

      // place the marker
      marker = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: new google.maps.MarkerImage(getMarkerByStatus(facility.status))
      });

      //add a listener for the extra info
      google.maps.event.addListener(marker, 'click', function() {
        map.infoWindow.setContent(getMarkerContent(facility));
        map.infoWindow.open(map, this);
      });
    }

    return marker;

  }

  // build a standard map
  module.buildStandardMap = function($container, showHere){

    var showHere    = typeof showHere === 'undefined' ? true : false;

    var map         = buildMap($container);

    var pixels_x    = $(map.getDiv()).width();
    var pixels_y    = $(map.getDiv()).height();

    var old_ratio   = default_map_data.distance_x / default_map_data.distance_y;
    var new_ratio   = pixels_x / pixels_y;
    var dist_p_pix  = old_ratio >= new_ratio ? 
                      default_map_data.distance_x / pixels_x :
                      default_map_data.distance_y / pixels_y;
    
    var zoom        = Math.round(distance_per_pixel_to_zoom(dist_p_pix));
    var center      = new google.maps.LatLng(default_map_data.lat, default_map_data.lng);
    
    map.setCenter(center);
    map.setZoom(zoom);
    map.infoWindow = new google.maps.InfoWindow();
    map.setOptions({ minZoom: 6});

    if(currentPosition && showHere){
      var hereMarker = new google.maps.Marker({
        position: new google.maps.LatLng(currentPosition.lat, currentPosition.lng),
        map: map,
        icon: new google.maps.MarkerImage('/assets/img/you_are_here.png')
      });

      // add a listener for the extra info
      google.maps.event.addListener(hereMarker, 'click', function() {
        map.infoWindow.setContent('You are here.');
        map.infoWindow.open(map, this);
      });
    }

    return map;
  }
  
  module.getDistances = function(map){
    var center    = map.getCenter();
    var zoom      = map.getZoom();
    var pixels_y  = $(map.getDiv()).height();
    var pixels_x  = $(map.getDiv()).width();
    
    var distance_per_pixel = zoom_to_distance_per_pixel(zoom);
    
    return {
      x: (distance_per_pixel * pixels_x),
      y: (distance_per_pixel * pixels_y)
    };
  }


  function buildMap($container){
    var map = new google.maps.Map($container[0]);
    return map;
  }
  
  // private
  function zoom_to_distance_per_pixel(zoom){
    return pow2(-1 * zoom);
  }

  function distance_per_pixel_to_zoom(distance_per_pixel){
    return -1 * log2(distance_per_pixel);
  }

  function log2(num){
    return Math.log(num) / Math.log(2);
  }

  function pow2(num){
    return Math.pow(2, num);
  }

  function getMarkerContent(facility){

    var javascript_date = new Date(facility.updated_at)

    var update_date = (javascript_date == "Invalid Date") ?
                      facility.updated_at :
                      javascript_date.toLocaleDateString();

    var update_name = facility.last_updated_by && (facility.last_updated_by.first_name || facility.last_updated_by.last_name) ?
                      "by " + (facility.last_updated_by.first_name || "") + " " + (facility.last_updated_by.last_name || "") :
                      "";

    var str = "<div style='width: 300px'>";

    str += "<center><h4>"+facility.facilityname+"</h4>";

    str += "<i>last updated " + update_name + " on " + update_date + "</i><br>";

    str += facility.facilityaddress ?
           facility.facilityaddress.replace(new RegExp('\r?\n','g'), ', ') + "<br>" :
           "<i>No Address Given</i><br>" ;

    str += facility.phone ?
           facility.phone + "<br>" :
           "<i>no phone given</i><br>" ;

    if(facility.distance){
      str += facility.distance + "<br>"
    }
    
    str += "Currently: " + facility.status + "<br>"+
            "<a href='/facilities/"+facility.id+"'>Details</a></center>";

    str += "</div>";

    return str;

  }

  var statusColor = {
    'Open': '82af6f',
    'On Call': 'f89406',
    'Closed': 'd15b47'
  };

  function getMarkerByStatus(status){
    var color = statusColor[status];
    var marker = 'http://www.googlemapsmarkers.com/v1/'+color+'/';
    return marker;
  }


  return module;

}(jQuery, google, default_map_data));