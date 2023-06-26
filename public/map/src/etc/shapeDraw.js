// Global Variables
var map;  // map is used by Leaflet for display of the map
var drawnItems; // identifies the set of layers on the map
var capCircle = "";
var circleVerified = false;
var capPolygon = "";
var polygonVerified = false;
var drawControl;
var capShapeOptions = {
  stroke: true,
  color: "#FF0000",
  weight: 2,
  opacity: 0.8,
  fill: true,
  fillColor: "#F33F00",
  fillOpacity: 0.1
}
var capPolygonOptions = {
  allowIntersection: false,
  showArea: true,
  drawError: {
    color: '#e1e100', // Color the shape will turn when intersects
    message: '<strong>Error<strong> edges cannot intersect.' // Message that will show when intersect
  },
  shapeOptions: capShapeOptions
}
function initializeMap(initLatLng,initZoom) {
  map = new L.Map('map_canvas');
  // drawnItems refers to all layers with drawn shapes
  drawnItems = new L.FeatureGroup();
  map.addLayer(drawnItems);

// This app offers a choice of three base maps: ESRI, Google, and OSM.
// The many base maps that can be used with Leaflet are listed at
//  https://leaflet-extras.github.io/leaflet-providers/preview/
// Note the tile layer definition has s, x, y, and z parameters.
// Actual values  are substituted whenever Leaflet fetches a tile.

  var esriUrl = 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}';
  var esriAttrib = 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012';
  var googleUrl = 'http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}';
  var googleAttrib = 'Google';
  var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
  var osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors';

/*  L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 20,
    maxNativeZoom: 18 // tiles will be interpolated/autoscaled at zoom beyond maxNativeZoom
  }).addTo(map);
*/
  L.control.layers(
    {'ESRI': L.tileLayer(esriUrl, { maxZoom: 18, attribution: esriAttrib }),
     'Google': L.tileLayer(googleUrl, { maxZoom: 18, attribution: googleAttrib }).addTo(map),
     'OSM': L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib }).addTo(map)
    }, {
     'drawlayer': drawnItems
    }, {
      position: 'bottomleft',
      collapsed: false
    }).addTo(map);
  map.attributionControl.setPrefix(''); // Don't show 'Powered by Leaflet'.

  //setView( <LatLng> center, <Number> zoom )
  var latLngSplit = initLatLng.trim().split(",");
  var mapCenterLat = parseFloat(latLngSplit[0]);
  var mapCenterLng  = parseFloat(latLngSplit[1]);
  var mapZoom = parseInt(initZoom);
  map.setView(new L.LatLng(mapCenterLat,mapCenterLng), mapZoom);

  drawControl = new L.Control.Draw({
    draw: {
      polygon: capPolygonOptions,
      rectangle: {shapeOptions: capShapeOptions},
      circle: {shapeOptions: capShapeOptions},
      polyline: false,
      marker: false,
      marker2: false,
      circlemarker: false
    },
    edit: { featureGroup: drawnItems }
  });
  drawControl.addTo(map);

  map.on('draw:created', function (event) {
    // L.Draw.Event.CREATED provides the newly created layer. Note that
    // L.Rectangle extends L.Polygon and L.Polygon extends L.Polyline
    var thisLayer = event.layer;
    // Only one circle; Only one of polygon or rectangle
    if (thisLayer instanceof L.Circle) {
      circleDrawnOnMap(thisLayer);
    } else if (thisLayer instanceof L.Polygon) {
      polygonDrawnOnMap(thisLayer);
    } else if (thisLayer instanceof L.Rectangle) {
      polygonDrawnOnMap(thisLayer);
    } else {
      alert("Unexpected layer type in L.Draw.Event.CREATED. Notify programmer.");
    }
    drawnItems.addLayer(thisLayer);
  });

  map.on('draw:edited', function (event) {
    // L.Draw.Event.EDITED provides a list of edited layers. Note that
    // L.Rectangle extends L.Polygon and L.Polygon extends L.Polyline
    var editedLayers = event.layers;
    editedLayers.eachLayer(function (thisLayer) {
      // Only one circle; Only one of polygon or rectangle
      if (thisLayer instanceof L.Circle) {
        circleEditedOnMap(thisLayer);
      } else if (thisLayer instanceof L.Polygon) {
        polygonEditedOnMap(thisLayer);
      } else if (thisLayer instanceof L.Rectangle) {
        polygonEditedOnMap(thisLayer);
      } else {
        alert("Unexpected layer type in L.Draw.Event.EDITED. Notify programmer.");
      }
    });
  });

  map.on('draw:deleted', function (event) {
    // L.Draw.Event.DELETED provides a list of edited layers. Note that
    // L.Rectangle extends L.Polygon and L.Polygon extends L.Polyline
    var deletedLayers = event.layers;
    deletedLayers.eachLayer(function (thisLayer) {
      if (thisLayer instanceof L.Circle) {
        circleDeletedFromMap(thisLayer);
      } else if (thisLayer instanceof L.Polygon) {
        polygonDeletedFromMap(thisLayer);
      } else if (thisLayer instanceof L.Rectangle) {
        polygonDeletedFromMap(thisLayer);
      } else {
        alert("Unexpected layer type in L.Draw.Event.DELETED. Notify programmer.");
      }
    })
  });
}
function circleDrawnOnMap(thisLayer) {
  // Only one circle allowed; Remove existing circle
  deleteCapCircle();
  // Disable additional circle drawing
  changeToolbar("circle", "disable");
  // Set this as the value of form element for circle
  var latLng = thisLayer.getLatLng();
  var radiusKilometers = thisLayer.getRadius()/1000;
  var circleString = latLng.lat+","+latLng.lng+" "+radiusKilometers;
  capCircle = verifyCircle(circleString);
  if (circleVerified) {
    document.capForm.capCircle.value = capCircle;
  } else {
    // should be impossibile to draw an invalid circle
    document.capForm.capCircle.value = circleString;
  }
  document.capForm.capCircle.onchange();
}
function polygonDrawnOnMap(thisLayer) {
  // Only one polygon allowed; Remove existing polygon
  deleteCapPolygon();
  // Disable additional polygon drawing
  changeToolbar("polygon", "disable");
  // Set this as the value of form element for polygon
  var latlngs = thisLayer.getLatLngs()[0];
  var polygonString = "";
  for (var i = 0; i < latlngs.length; i++) {
    polygonString += " " + latlngs[i].lat + "," + latlngs[i].lng;
  }
  capPolygon = verifyPolygon(polygonString.trim());
  if (polygonVerified) {
    document.capForm.capPolygon.value = capPolygon;
  } else {
    // should be impossibile to draw an invalid polygon
    document.capForm.capPolygon.value = polygonString.trim();
  }
  document.capForm.capPolygon.onchange();
}
function circleEditedOnMap(thisLayer) {
  drawControl.setDrawingOptions({
    circle: {shapeOptions: capShapeOptions}
  });
  // Disable additional circle drawing
  changeToolbar("circle", "disable");
  // Carry change to value of form element for circle
  var latLng = thisLayer.getLatLng();
  var radiusKilometers = thisLayer.getRadius()/1000;
  var circleString = latLng.lat+","+latLng.lng+" "+radiusKilometers;
  capCircle = verifyCircle(circleString);
  if (circleVerified) {
    document.capForm.capCircle.value = capCircle;
  } else {
    // should be impossibile to draw an invalid circle
    document.capForm.capCircle.value = circleString;
  }
  document.capForm.capCircle.onchange();
}
function polygonEditedOnMap(thisLayer) {
  drawControl.setDrawingOptions({
    polygon: capPolygonOptions,
    rectangle: {shapeOptions: capShapeOptions}
  });
  // Disable additional polygon drawing
  changeToolbar("polygon", "disable");
  // Carry change to value of form element for polygon
  var latlngs = thisLayer.getLatLngs()[0];
  var polygonString = "";
  for (var i = 0; i < latlngs.length; i++) {
    polygonString += " " + latlngs[i].lat + "," + latlngs[i].lng;
  }
  capPolygon = verifyPolygon(polygonString.trim());
  if (polygonVerified) {
    document.capForm.capPolygon.value = capPolygon;
  } else {
    // should be impossibile to draw an invalid polygon
    document.capForm.capPolygon.value = polygonString.trim();
  }
  document.capForm.capPolygon.onchange();
}
function circleDeletedFromMap(thisLayer) {
  // Remove circle layer
  deleteCapCircle();
  // enable circle drawing again
  changeToolbar("circle", "enable");
  // Set to "" the value of form element for circle
  capCircle = "";
  document.capForm.capCircle.value = capCircle;
  document.capForm.capCircle.onchange();
}
function polygonDeletedFromMap(thisLayer) {
  // Remove polygon layer
  deleteCapPolygon();
  // enable polygon drawing again
  changeToolbar("polygon", "enable");
  // Set to "" the value of form element for polygon
  capPolygon = "";
  document.capForm.capPolygon.value = "";
  document.capForm.capPolygon.onchange();
}
function changeToolbar(layerType,enableDraw) {
  switch (layerType) {
    case 'circle':
      if (enableDraw == "enable") {
        drawControl.setDrawingOptions({
          circle: {shapeOptions: capShapeOptions}
        });
      } else {
        drawControl.setDrawingOptions({
          circle: false
        });
      }
      break;
    case 'polygon':
      if (enableDraw == "enable") {
        drawControl.setDrawingOptions({
          polygon: capPolygonOptions,
          rectangle: {shapeOptions: capShapeOptions}
        });
      } else {
        drawControl.setDrawingOptions({polygon: false});
        drawControl.setDrawingOptions({rectangle: false});
     }
      break;
    default:
        alert("Unexpected layer type in changeToolbar. Notify programmer.");
  } // end of switch
  map.removeControl(drawControl);
  map.addControl(drawControl);
}
function circleGivenByForm(capFormCircle) {
  if (capCircle == capFormCircle) {
    // circle is already drawn
    return capCircle;
  }
  capCircle = verifyCircle(capFormCircle);
  if (!circleVerified) {
    return capFormCircle;
  }
  deleteCapCircle();
  // Create and draw the new capCircle
  circleCenterAndRadius = capCircle.trim().split(" ");
  circleCenter = circleCenterAndRadius[0]; //
  circleRadiusKilometers = parseFloat(circleCenterAndRadius[1]);
  circleRadiusMeters = circleRadiusKilometers*1000;
  circleCenterLatLng = circleCenter.split(",");
  circleCenterLat = parseFloat(circleCenterLatLng[0]);
  circleCenterLng = parseFloat(circleCenterLatLng[1]);
  var newCircle = new L.Circle(
    [circleCenterLat, circleCenterLng],
    circleRadiusMeters,
    capShapeOptions
  ).addTo(drawnItems);
  changeToolbar("circle", false);
  return capCircle;
}
function polygonGivenByForm(capFormPolygon) {
  if (capPolygon == capFormPolygon) {
    // polygon is already drawn
    return capPolygon;
  }
  capPolygon = verifyPolygon(capFormPolygon);
  if (!polygonVerified) {
    return capFormPolygon;
  }
  deleteCapPolygon();
  // Create and draw the new polygon
  var polygonArray = polygonStringToArray(capPolygon);
  var newPolygon = new L.Polygon(
    polygonArray,
    capShapeOptions
  ).addTo(drawnItems);
  changeToolbar("polygon", false);
  return capPolygon;
}
function deleteCapCircle() {
  drawnItems.eachLayer(function (thisLayer) {
    if (thisLayer instanceof L.Circle) {
      drawnItems.removeLayer(thisLayer);
    }
  });
}
function deleteCapPolygon() {
  drawnItems.eachLayer(function (thisLayer) {
    // Note: Leaflet draw erred when I used a compound if statement
    if (thisLayer instanceof L.Polygon) {
      drawnItems.removeLayer(thisLayer);
    }
    if (thisLayer instanceof L.Rectangle) {
      drawnItems.removeLayer(thisLayer);
    }
    if (thisLayer instanceof L.Polyline) {
      drawnItems.removeLayer(thisLayer);
    }
  });
}
