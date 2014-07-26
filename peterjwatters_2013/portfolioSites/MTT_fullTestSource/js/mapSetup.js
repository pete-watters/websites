    var IMAGES = [ "sun", "rain", "snow", "storm" ];
    var ICONS = [];
    var map = null;
    var mgr = null;
    
    function setupMap() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map"));
        map.addControl(new GLargeMapControl());
        map.setCenter(new GLatLng(48.25, 11.00), 4);
        map.enableDoubleClickZoom();
        window.setTimeout(setupWeatherMarkers, 0);
          map.addOverlay(createMarker(new GLatLng(53.349443,-6.260082), 0)); // dublin
          map.addOverlay(createMarker(new GLatLng(41.385064,2.173404), 1)); // barcelona
          map.addOverlay(createMarker(new GLatLng(51.507335,-0.127683), 2)); // london
          map.addOverlay(createMarker(new GLatLng(48.856614,2.352222), 3)); // paris
        /*Geocoder */
        geocoder = new GClientGeocoder();
      }
    }


    /* Geocoder */
 function showAddress(address) {
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
              map.setCenter(point, 15);
              var marker = new GMarker(point, {draggable: true});
              map.addOverlay(marker);
              GEvent.addListener(marker, "dragend", function() {
                marker.openInfoWindowHtml(marker.getLatLng().toUrlValue(6));
              });
              GEvent.addListener(marker, "click", function() {
                marker.openInfoWindowHtml(marker.getLatLng().toUrlValue(6));
              });
        GEvent.trigger(marker, "click");
            }
          }
        );
      }
    }

    /* END Geocoder */

    /* From map Custom Icons example */
        // Create a base icon for all of our markers that specifies the shadow, icon dimensions, etc.
        var baseIcon = new GIcon(G_DEFAULT_ICON);
        baseIcon.shadow = "http://www.google.com/mapfiles/shadow50.png";
        baseIcon.iconSize = new GSize(20, 34);
        baseIcon.shadowSize = new GSize(37, 34);
        baseIcon.iconAnchor = new GPoint(9, 34);
        baseIcon.infoWindowAnchor = new GPoint(9, 2);
    
        // Creates a marker whose info window displays the letter corresponding to the given index.
        function createMarker(point, index) {
          // Create a lettered icon for this point using our icon class
          var letter = String.fromCharCode("A".charCodeAt(0) + index);
          var letteredIcon = new GIcon(baseIcon);
          letteredIcon.image = "http://www.google.com/mapfiles/marker" + letter + ".png";    
          // Set up our GMarkerOptions object
          markerOptions = { icon:letteredIcon };
          var marker = new GMarker(point, markerOptions);    
          GEvent.addListener(marker, "click", function() {
            marker.openInfoWindowHtml("Marker <b>" + letter + "</b>");
          });
          return marker;
        }
    /* From map Custom Icons example */
    
    function getWeatherIcon() {
      var i = 0;
      if (!ICONS[i]) {
        var icon = new GIcon();
        icon.image = "http://gmaps-utility-library.googlecode.com/svn/trunk/markermanager/release/examples/images/"
            + "storm" + ".png";
        icon.iconAnchor = new GPoint(16, 16);
        icon.infoWindowAnchor = new GPoint(16, 0);
        icon.iconSize = new GSize(32, 32);
        icon.shadow = "http://gmaps-utility-library.googlecode.com/svn/trunk/markermanager/release/examples/images/"
            + "storm" + "-shadow.png";
        icon.shadowSize = new GSize(59, 32);
        ICONS[i] = icon;
      }
      return ICONS[i];
    }
    
 function getPoint(latLong) {
      var lat = latLong[0] + (Math.random() - 0.5)*14.5;
      var lng = latLong[1] + (Math.random() - 0.5)*36.0;
      return new GLatLng(Math.round(lat*10)/10, Math.round(lng*10)/10);
    }

    function getWeatherMarkers(n) {
      var batch = [];
        batch.push(new GMarker(new GLatLng(53.349443,-6.260082), { icon: getWeatherIcon() })); // dublin
        batch.push(new GMarker(new GLatLng(41.385064,2.173404), { icon: getWeatherIcon() })); // barcelona
        batch.push(new GMarker(new GLatLng(51.507335,-0.127683), { icon: getWeatherIcon() })); // london
        batch.push(new GMarker(new GLatLng(48.856614,2.352222), { icon: getWeatherIcon() })); // paris        
      return batch;
    }
    
    function setupWeatherMarkers() {
      mgr = new MarkerManager(map);
      mgr.addMarkers(getWeatherMarkers(4), 3);
      mgr.refresh();
    }
