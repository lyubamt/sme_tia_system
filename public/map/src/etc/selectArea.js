var onlineMapping = false; // value could be set by function initializeMap
if(!String.prototype.trim) {
  String.prototype.trim = function () {
    return this.replace(/^\s+|\s+$/, '')
  };
}
// shapeOptions used by Leaflet for display
var shapeOptions = {
  stroke: true,
  color: "#FF0000",
  weight: 2,
  opacity: 0.8,
  fill: true,
  fillColor: "#F33F00",
  fillOpacity: 0.1
}

var map;  // map is used by Leaflet for display of the map
var drawnItems; // identifies the set of layers on the map
var drawControl;
var capCircle = ""; // format is CAP element string: lat,lng radius
var circleVerified = false;
var newCircle = "";
var circleCenterAndRadius;
var circleCenter;
var circleCenterLat;
var circleCenterLng;
var circleRadiusMeters;
var circleRadiusKilometers;
var capPolygon = ""; // format is CAP element string: lat,lng lat,lng ...
var polygonVerified = false;
var polygonArray = [];
var polygonVertexLat;
var polygonVertexLng;

function verifyCircle(circleLatLngRadius) {
  var verifiedCircle = "";
  // This function is used when the form text defines a capCircle
  // First we verify text values for the center lat,lng and for the radius
  circleCenterAndRadius = circleLatLngRadius.trim().split(" ");
  if(circleCenterAndRadius.length !== 2) {
    alert(i18next.t("js-str-0-1")+ circleLatLngRadius);
	//"Error in checking circle: must have 'lat,lng' center and a radius
	// with a space between: "
    return(circleLatLngRadius);
  }
  circleCenter = circleCenterAndRadius[0];
  circleCenterLatLng = circleCenter.split(",");
  if(circleCenterLatLng.length !== 2) {
    alert(i18next.t("js-str-0-2") + circleLatLngRadius);
	//"Error in checking circle: 'lat,lng' center must have latitude
	// and longitude with a comma between: "
    return(circleLatLngRadius);
  }
  if(isNaN(circleCenterLatLng[0])) {
    alert(i18next.t("js-str-0-3") + circleLatLngRadius);
	//"Error in checking circle: center latitude is not numeric: "
    return(circleLatLngRadius);
  }
  if(isNaN(circleCenterLatLng[1])) {
    alert(i18next.t("js-str-0-4") + circleLatLngRadius);
	//"Error in checking circle: center longitude is not numeric: "
    return(circleLatLngRadius);
  }
  circleCenterLat = parseFloat(circleCenterLatLng[0]);
  if(circleCenterLat < -90 || circleCenterLat > 90) {
    alert(i18next.t("js-str-0-5") + circleLatLngRadius);
	//"Error in checking circle: center latitude is out of range (-90 to 90): "
    return(circleLatLngRadius);
  }
  circleCenterLng = parseFloat(circleCenterLatLng[1]);
  if(circleCenterLng < -180 || circleCenterLng > 180) {
    alert(i18next.t("js-str-0-6") + circleLatLngRadius);
	//"Error in checking circle: center longitude is out of range (-180 to 180): "
    return(circleLatLngRadius);
  }
  if(isNaN(circleCenterAndRadius[1])) {
    alert(i18next.t("js-str-0-7"));
	//"Error in checking circle: radius is not numeric: "
    return(circleLatLngRadius);
  }
  if(circleCenterAndRadius[1] < 0) {
    alert(i18next.t("js-str-0-8") + circleLatLngRadius);
	//"Error in checking circle: radius cannot be negative: "
      return(circleLatLngRadius);
  }
  circleRadiusKilometers = parseFloat(circleCenterAndRadius[1]);
  // Next we fix the precision of text values for the lat,lng and radius.
  // (Each degree of latitude is approximately 111 kilometers.)
    if(circleRadiusKilometers < .1) {
      circleCenterLat = fixPrecision(circleCenterLat,5);
      circleCenterLng = fixPrecision(circleCenterLng,5);
      circleRadiusKilometers = fixPrecision(circleRadiusKilometers,3);
    } else if(circleRadiusKilometers < 1) {
      circleCenterLat = fixPrecision(circleCenterLat,4);
      circleCenterLng = fixPrecision(circleCenterLng,4);
      circleRadiusKilometers = fixPrecision(circleRadiusKilometers,2);
    } else if(circleRadiusKilometers < 11) {
      circleCenterLat = fixPrecision(circleCenterLat,3);
      circleCenterLng = fixPrecision(circleCenterLng,3);
      circleRadiusKilometers = fixPrecision(circleRadiusKilometers,1);
    } else if(circleRadiusKilometers < 111) {
      circleCenterLat = fixPrecision(circleCenterLat,2);
      circleCenterLng = fixPrecision(circleCenterLng,2);
      circleRadiusKilometers = fixPrecision(circleRadiusKilometers,0);
    } else if(circleRadiusKilometers < 1111) {
      circleCenterLat = fixPrecision(circleCenterLat,1);
      circleCenterLng = fixPrecision(circleCenterLng,1);
      circleRadiusKilometers = fixPrecision(circleRadiusKilometers,0);
  } else {
    circleCenterLat = fixPrecision(circleCenterLat,0);
    circleCenterLng = fixPrecision(circleCenterLng,0);
    circleRadiusKilometers = fixPrecision(circleRadiusKilometers,0);
  }
  verifiedCircle = circleCenterLat+","+circleCenterLng+" "+circleRadiusKilometers;
  // Finally, return the center and radius with correct precision
  circleVerified = true;
  return(verifiedCircle);
}
function circleDrawnOnMap(layer) {
  // Update CAP form values for circle center and radius
  var latLng = layer.getLatLng();
  var radiusKilometers = layer.getRadius()/1000;
  // verify vertices, fix precision and update form value for circle
  circleVerified = false;
  capCircle = verifyCircle(latLng.lat+","+latLng.lng+" "+radiusKilometers);
  if (circleVerified) {
    deleteDrawnCircle();
    document.capForm.capCircle.value = capCircle;
    document.capForm.capCircle.onchange();
  }
}
function circleGivenByForm(capFormCircle) {
  if (capCircle == capFormCircle) {
    // circle is already drawn
    return capCircle;
  }
  /*
  if (!onlineMapping) {
    return capFormCircle;
  }
  */
  capCircle = verifyCircle(capFormCircle);
  if (!circleVerified) {
    return capFormCircle;
  }
  deleteDrawnCircle();
  // Create and draw the new capCircle
  circleCenterAndRadius = capFormCircle.trim().split(" ");
  circleCenter = circleCenterAndRadius[0]; //
  circleRadiusKilometers = parseFloat(circleCenterAndRadius[1]);
  circleRadiusMeters = circleRadiusKilometers*1000;
  circleCenterLatLng = circleCenter.split(",");
  circleCenterLat = parseFloat(circleCenterLatLng[0]);
  circleCenterLng = parseFloat(circleCenterLatLng[1]);
  var newCircle = new L.circle(
    [circleCenterLat, circleCenterLng],
    circleRadiusMeters,
    shapeOptions
  ).addTo(drawnItems);
  // alert("after addTo in function circleGivenByForm\n"+drawnItemsList());
  changeToolbar("circle", false);
  capCircle = capFormCircle;
  return capCircle;
}
function deleteCapCircle() {
  /*
  if (!onlineMapping) {
    return;
  }
  */
  // Delete current capCircle if it exists
  deleteDrawnCircle();
}
function deleteDrawnCircle() {
  drawnItems.eachLayer(function (layer) {
    if (layer instanceof L.Circle) {
      drawnItems.removeLayer(layer);
    }
  });
  changeToolbar("circle", true);
}

function verifyPolygon(polygonString) {
  polygonArray = polygonStringToArray(polygonString);
  if (polygonArray.length < 3) {
    alert(i18next.t("js-str-0-9"));
	//"Polygon is not valid because it has less than three points.");
    return(polygonArray);
  }
  // Assure that the last vertex lat,lng is a repeat of the first vertex
  var lastVertexNumber = polygonArray.length - 1;
  var firstLatitude = polygonArray[0][0]
  var lastLatitude = polygonArray[lastVertexNumber][0]
  var firstLongitude = polygonArray[0][1]
  var lastLongitude = polygonArray[lastVertexNumber][1]
  if ((firstLatitude !== lastLatitude) || (firstLongitude !== lastLongitude)) {
    polygonArray.push(polygonArray[0]);
  }
  // Assure that the winding order is counter-clockwise (polygon area is negative)
  // per Simple Feature Access standard (ISO 19125-1): A Polygon [...] exterior
  // boundary appears to traverse the boundary in a counter clockwise direction.
  if (computeSignedArea(polygonArray) > 0) {
    alert(i18next.t("js-str-0-10"));
	//"Vertex order changed to counter-clockwise.");
    polygonArray = polygonArray.reverse();
  }
  // Set precision of coordinates for each point in the polygon,
  // based on the least span in degrees for latitude or longitude
  var leastSpan = capPolygonLeastSpan(polygonArray);
  var verifiedCapPolygon = "";
  var thisVertexArray = [];
  for (var i = 0; i < polygonArray.length; i++) {
    thisVertexArray = preciseCoordinates(polygonArray[i],leastSpan);
    verifiedCapPolygon += " " + thisVertexArray[0] + "," + thisVertexArray[1];
  }
  // Finally, return capPolygon with correct precision
  polygonVerified = true;
  return(verifiedCapPolygon.trim());
}
function capPolygonLeastSpan (polygonArray) {
  // Precision of decimal degrees should be related to the least span in
  // degrees. To determine the northernmost and southernmost latitudes,
  // we need to look for the largest and smallest latitude values.
  var bboxNorth = -90; // begin at least possible (south pole)
  var bboxSouth = 90;  // begin at most possible (north pole))
  var thisLatitude = 0;
  for (var i = 0; i < polygonArray.length; i++) {
    thisLatitude = parseFloat(polygonArray[i][0]);
    if (thisLatitude > bboxNorth) { bboxNorth = thisLatitude; }
    if (thisLatitude < bboxSouth) { bboxSouth = thisLatitude; }
  }
  var spanLatitude = bboxNorth - bboxSouth; // guaranteed positive
  // To determine the easternmost and westernmost longitudes, we must
  // check whether the path between each vertex crosses the antimeridian.
  // Antimeridian crossing is assumed if path length exceeds 180 degrees.
  var bboxEast = -180; // begin at least possible
  var bboxWest = 180;  // begin at most possible
  var thisPathSpan;
  var spanLongitude;
  var thisLongitude;
  var otherLongitude;
  var thisEast;
  var thisWest;
  for (var i = 0; i < polygonArray.length; i++) {
    thisLongitude = parseFloat(polygonArray[i][1]);
    for (var ii = 0; ii < polygonArray.length; ii++) {
      otherLongitude = parseFloat(polygonArray[ii][1]);
      if (thisLongitude !== otherLongitude) {
        thisPathSpan = otherLongitude - thisLongitude;
        if (thisPathSpan < -180 || thisPathSpan > 180) {
          // This path crosses the antimeridian, so adjust for that.
          if (thisLongitude < 0) {
            // thisLongitude is the eastern end
            thisEast = thisLongitude;
            thisWest = otherLongitude;
          } else {
            // thisLongitude is the western end
            thisWest = thisLongitude;
            thisEast = otherLongitude;
          }
          thisPathSpan = thisEast + 360 - thisWest;
        } else {
          // This path does not cross the antimeridian.
          if (thisLongitude > otherLongitude) {
            // thisLongitude is the eastern end
            thisEast = thisLongitude;
            thisWest = otherLongitude;
          } else {
            // thisLongitude is the western end
            thisWest = thisLongitude;
            thisEast = otherLongitude;
          }
          thisPathSpan = thisEast - thisWest;
        }
        // Now check if thisPathSpan is the longest path so far.
        if (thisPathSpan >= spanLongitude) {
          spanLongitude = thisPathSpan;
          bboxWest = thisWest;
          bboxEast = thisEast;
        }
      } // end checking this path for antimeridian crossing
    }  // end for loop; all paths with this vertex have been checked
  } // end for loop; all paths between all vertices have been checked
  if (spanLatitude < 0) {
    alert ("span of latitude is negative: "+spanLatitude+" . This should not happen!")
    spanLatitude = -1 * spanLatitude;
  }
  if (spanLongitude < 0) {
    alert ("span of longitude is negative: "+spanLongitude+" . This should not happen!")
    spanLongitude = -1 * spanLongitude;
  }
  if (spanLatitude < spanLongitude) {
    return spanLatitude;
  } else {
    return spanLongitude;
  }
}

function polygonDrawnOnMap(layer) {
  polygonVerified = false;
  if (layer.getLatLngs().length < 1) {
    alert("Polygon shape is not valid.");
    return;
  }
  capPolygon = "";
  latlngs = layer.getLatLngs()[0];
  for (var i = 0; i < latlngs.length; i++) {
    capPolygon += " " + latlngs[i].lat + "," + latlngs[i].lng;
  }
  capPolygon = verifyPolygon(capPolygon.trim());
  // verify vertices, fix precision and update form value for polygon
  if (polygonVerified) {
    deleteDrawnPolygon();
    document.capForm.capPolygon.value = capPolygon;
    document.capForm.capPolygon.onchange();
  }
}
function deleteCapPolygon() {
  /*
  if (!onlineMapping) {
    return;
  }
  */
  deleteDrawnPolygon();
}
function deleteDrawnPolygon() {
  drawnItems.eachLayer(function (layer) {
    if (drawnItems.getLayers()[i] instanceof L.Polygon) {
      drawnItems.removeLayer(layer);
    }
    if (drawnItems.getLayers()[i] instanceof L.Rectangle) {
      drawnItems.removeLayer(layer);
    }
  });
  changeToolbar("polygon", true);
}
function polygonGivenByForm(capFormPolygon) {
  if (capPolygon == capFormPolygon) {
    // polygon is already drawn
    return capPolygon;
  }
  /*
  if (!onlineMapping) {
    return capFormPolygon;
  }
  */
  capPolygon = verifyPolygon(capFormPolygon);
  if (!polygonVerified) {
    return capFormPolygon;
  }
  deleteDrawnPolygon();
  // Create and draw the new capPolygon
  var polygonArray = polygonStringToArray(capFormPolygon);
  var newPolygon = new L.Polygon(
    polygonArray,
    {shapeOptions: shapeOptions}
  ).addTo(drawnItems);
  changeToolbar("polygon", false);
  capPolygon = capFormPolygon;
  return capPolygon;
}
function preciseCoordinates(thisVertexArray, leastSpan) {
  // leastSpan is in degrees of latitude or longitude.
  // One-thousandth degree of latitude is about 111 meters
  var thisLatitude = thisVertexArray[0];
  var thisLongitude = thisVertexArray[1];
  var preciseVertexArray = [];
  switch (true) {
    case (leastSpan < .00001):
      preciseVertexArray.push(fixPrecision(thisLatitude,10));
      preciseVertexArray.push(fixPrecision(thisLongitude,10));
      return(preciseVertexArray);
    case (leastSpan < .0001):
      preciseVertexArray.push(fixPrecision(thisLatitude,9));
      preciseVertexArray.push(fixPrecision(thisLongitude,9));
      return(preciseVertexArray);
    case (leastSpan < .001):
      preciseVertexArray.push(fixPrecision(thisLatitude,8));
      preciseVertexArray.push(fixPrecision(thisLongitude,8));
      return(preciseVertexArray);
    case (leastSpan < .01):
      preciseVertexArray.push(fixPrecision(thisLatitude,7));
      preciseVertexArray.push(fixPrecision(thisLongitude,7));
      return(preciseVertexArray);
    case (leastSpan < .1):
      preciseVertexArray.push(fixPrecision(thisLatitude,6));
      preciseVertexArray.push(fixPrecision(thisLongitude,6));
      return(preciseVertexArray);
    case (leastSpan < 1):
      preciseVertexArray.push(fixPrecision(thisLatitude,5));
      preciseVertexArray.push(fixPrecision(thisLongitude,5));
      return(preciseVertexArray);
    case (leastSpan < 10):
      preciseVertexArray.push(fixPrecision(thisLatitude,4));
      preciseVertexArray.push(fixPrecision(thisLongitude,4));
      return(preciseVertexArray);
    case (leastSpan < 100):
      preciseVertexArray.push(fixPrecision(thisLatitude,3));
      preciseVertexArray.push(fixPrecision(thisLongitude,3));
      return(preciseVertexArray);
    default:
      preciseVertexArray.push(fixPrecision(thisLatitude,2));
      preciseVertexArray.push(fixPrecision(thisLongitude,2));
    return(preciseVertexArray);
  }
}
function fixPrecision(numberValue,precision) {
  var numberValueAsString = numberValue.toString().trim();
  var countDecimalDigits = 0;
  if (numberValueAsString.indexOf(".") > -1) {
      var decimalSplit = numberValueAsString.split(".");
      countDecimalDigits = decimalSplit[1].split("").length;
  }
  var numberFloat = parseFloat(numberValue);
  if (countDecimalDigits > precision) {
    return(numberFloat.toFixed(precision));
  }
  return(numberFloat);
}
function polygonStringToArray(polygonString) {
  // example polygonString:
  // 51.51,-0.1 51.5,-0.06 51.52,-0.03 51.51,-0.1
  // example polygonArray:
  // [[51.51,-0.1],[51.5,-0.06],[51.52,-0.03]]
  var polygonArray = [];
  var polygonVertices = polygonString.split(" ");
  var polygonVertexLatLng = [];
  for (var i=0; i < polygonVertices.length; i++) {
    polygonVertexLatLng = polygonVertices[i].split(",");
    polygonArray.push(polygonVertexLatLng);
  }
  return(polygonArray);
}
function polygonArrayToString (polygonArray) {
  var polygonString = "";
  for (key in polygonArray) {
    polygonString += " " + polygonArray[key][0] + "," + polygonArray[key][1];
  }
  polygonString = polygonString.trim();
  return(stringPolygon);
}
function computeSignedArea(polygonArray) {
  // This calculation uses the "shoelace formula" described at
  // http://en.wikipedia.org/wiki/Shoelace_formula and at
  // http://mathworld.wolfram.com/PolygonArea.html
  let end = polygonArray.length - 1;
  let area = polygonArray[end][0]*polygonArray[0][1]
             - polygonArray[0][0]*polygonArray[end][1];
  for(let i=0; i < end; ++i) {
    const n=i+1;
    area += polygonArray[i][0]*polygonArray[n][1]
            - polygonArray[n][0]*polygonArray[i][1];
  }
  return area / 2;
}
function initializeMap(initLatLng,initZoom) {

  // Called from draft.php once all other code is loaded
  /*
  if ((typeof window.google === "undefined") ||
    (typeof google.maps === "undefined")) {
    onlineMapping = false;
    alert(i18next.t("js-str-0-11"));
	//"Mapping functions not available without Internet access.");
    return;
  }  else {
    onlineMapping = true;
  }
  */
  map = new L.Map('map_canvas');
  // The tile layer definition has s, z, x, and y in it. These are replaced
  // with actual values whenever Leaflet needs to fetch a tile.
  L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 20,
    maxNativeZoom: 18 // tiles will be interpolated/autoscaled at zoom beyond maxNativeZoom
  }).addTo(map);

  map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.

  var latLngSplit = initLatLng.trim().split(",");
  var mapCenterLat = parseFloat(latLngSplit[0]);
  var mapCenterLng  = parseFloat(latLngSplit[1]);
  var mapZoom = parseInt(initZoom.trim());

  //setView( <LatLng> center, <Number> zoom )
  map.setView(new L.LatLng(mapCenterLat,mapCenterLng), mapZoom);

  // drawnItems refers to all layers with drawn shapes
  drawnItems = new L.FeatureGroup();
  map.addLayer(drawnItems);

  drawControl = new L.Control.Draw({
    draw: {
      polygon: {
        allowIntersection: false,
        drawError: { color: "#e1e100" },
        shapeOptions: shapeOptions
      },
      rectangle: {shapeOptions: shapeOptions},
      circle: {shapeOptions: shapeOptions},
      polyline: false,
      marker: false,
      marker2: false,
      circlemarker: false
    },
    edit: { featureGroup: drawnItems }
  });
  drawControl.addTo(map);

  map.on('draw:created', function (e) {
    var type = e.layerType,
        layer = e.layer;
    switch (type) {
      case 'circle':
        circleDrawnOnMap(layer);
        changeToolbar("circle", false);
        break;
      case 'polygon':
        polygonDrawnOnMap(layer);
        changeToolbar("polygon", false);
        break;
      case 'rectangle':
        polygonDrawnOnMap(layer);
        changeToolbar("polygon", false);
        break;
      default:
        alert("Unexpected type ["+type+"] in draw:created. Notify programmer.");
    } // end of switch
    drawnItems.addLayer(layer);
  });

  map.on('draw:edited', function (e) {
    // draw:edited provides a list of edited layers. Also, note that
    // L.Rectangle extends l.Polygon and L.Polygon extends L.Polyline
    var layers = e.layers;
    layers.eachLayer(function (layer) {
      if (layer instanceof L.Circle){
        circleDrawnOnMap(layer);
        changeToolbar("circle", false);
      }
      if (layer instanceof L.Polygon) {
        polygonDrawnOnMap(layer);
        changeToolbar("polygon", false);
      }
      if (layer instanceof L.Rectangle) {
        polygonDrawnOnMap(layer);
        changeToolbar("polygon", false);
      }
    });
  });

  map.on('draw:deleted', function (e) {
    // draw:deleted provides a list of edited layers. Also, note that
    // L.Rectangle extends l.Polygon and L.Polygon extends L.Polyline
    var layers = e.layers;
    layers.eachLayer(function (layer) {
      if (layer instanceof L.Circle){
        document.capForm.capCircle.value = "";
        document.capForm.capCircle.onchange();
        changeToolbar("circle", true);
      }
      if (layer instanceof L.Polygon) {
        document.capForm.capPolygon.value = "";
        document.capForm.capPolygon.onchange();
        changeToolbar("polygon", true);
      }
      if (layer instanceof L.Rectangle) {
        document.capForm.capPolygon.value = "";
        document.capForm.capPolygon.onchange();
        changeToolbar("polygon", true);
      }
    });
  });
}
function changeToolbar(layerType,enableDraw) {
  switch (layerType) {
    case 'circle':
      if (enableDraw == true) {
        drawControl.setDrawingOptions({
          circle: {shapeOptions: shapeOptions}
        });
      } else {
        drawControl.setDrawingOptions({circle: false});
      }
      break;
    case 'polygon':
      if (enableDraw == true) {
        drawControl.setDrawingOptions({
          polygon: {
            allowIntersection: false,
            drawError: { color: "#e1e100" },
            shapeOptions: shapeOptions
          },
          rectangle: {shapeOptions: shapeOptions}
        });
      } else {
        drawControl.setDrawingOptions({polygon: false});
        drawControl.setDrawingOptions({rectangle: false});
     }
      break;
    default:
        alert("Unexpected type ["+layerType+"] in changeToolbar. Notify programmer.");
  } // end of switch
  map.removeControl(drawControl);
  map.addControl(drawControl);
}

function drawnItemsList() {
  var layersMsg = "drawnItems has "+drawnItems.getLayers().length+" layers.\n";
  for (i = 0; i < drawnItems.getLayers().length; ++i) {
    if (drawnItems.getLayers()[i] instanceof L.Circle){
      layersMsg += " - layer "+i+" is a circle\n";
    }
    if (drawnItems.getLayers()[i] instanceof L.Polygon) {
      layersMsg += " - layer "+i+" is a polygon\n";
    }
    if (drawnItems.getLayers()[i] instanceof L.Rectangle) {
      layersMsg += " - layer "+i+" is a rectangle\n";
    }
    if (drawnItems.getLayers()[i] instanceof L.Polyline) {
      layersMsg += " - layer "+i+" is a polyline\n";
    }
  }
  return layersMsg;
}
