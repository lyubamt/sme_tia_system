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
  circleVerified = true;
  // Next, fix the precision of text values for lat,lng and radius.
  // Each degree of latitude is approximately 111 kilometers.
  // Provide two extra decimal places beyond scale requirement.
  circleCenterLat = ""+circleCenterLatLng[0]; // coerce to string
  circleCenterLng = ""+circleCenterLatLng[1]; // coerce to string
  circleRadiusKilometers = ""+circleCenterAndRadius[1]; // coerce to string
  var scaleByRadius = parseFloat(circleCenterAndRadius[1]);
  switch (true) {
    case (scaleByRadius < .001):
      return(fixPrecision(circleCenterLat,9)+","+
             fixPrecision(circleCenterLng,9)+" "+
             fixPrecision(circleRadiusKilometers,5));
    case (scaleByRadius < .01):
      return(fixPrecision(circleCenterLat,8)+","+
             fixPrecision(circleCenterLng,8)+" "+
             fixPrecision(circleRadiusKilometers,4));
    case (scaleByRadius < .1):
      return(fixPrecision(circleCenterLat,7)+","+
             fixPrecision(circleCenterLng,7)+" "+
             fixPrecision(circleRadiusKilometers,3));
    case (scaleByRadius < 1):
      return(fixPrecision(circleCenterLat,6)+","+
             fixPrecision(circleCenterLng,6)+" "+
             fixPrecision(circleRadiusKilometers,2));
    case (scaleByRadius < 11):
      return(fixPrecision(circleCenterLat,5)+","+
             fixPrecision(circleCenterLng,5)+" "+
             fixPrecision(circleRadiusKilometers,1));
    case (scaleByRadius < 111):
      return(fixPrecision(circleCenterLat,4)+","+
             fixPrecision(circleCenterLng,4)+" "+
             fixPrecision(circleRadiusKilometers,0));
    case (scaleByRadius < 1111):
      return(fixPrecision(circleCenterLat,3)+","+
             fixPrecision(circleCenterLng,3)+" "+
             fixPrecision(circleRadiusKilometers,0));
    default:
      return(fixPrecision(circleCenterLat,2)+","+
             fixPrecision(circleCenterLng,2)+" "+
             fixPrecision(circleRadiusKilometers,0));
  }
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
  for (var i = 0; i < polygonArray.length; i++) {
    verifiedCapPolygon += " " + preciseCoordinates(polygonArray[i],leastSpan);
  }
  // Finally, return capPolygon with correct precision
  polygonVerified = true;
  return(verifiedCapPolygon.trim());
}
function capPolygonLeastSpan (polygonArray) {
  // Precision of decimal degrees should be related to the least span in 
  // degrees, comparing the span of latitude to the span of longitude. 
  // So, to find lattide span we need to look for the largest and the 
  // smallest latitude values.
  var bboxNorth = -90; // begin at least possible (south pole)
  var bboxSouth = 90;  // begin at most possible (north pole))
  var thisLatitude = 0;
  for (var i = 0; i < polygonArray.length; i++) {
    thisLatitude = parseFloat(polygonArray[i][0]);
    if (thisLatitude > bboxNorth) { bboxNorth = thisLatitude; }
    if (thisLatitude < bboxSouth) { bboxSouth = thisLatitude; }
  }
  var spanLatitude = bboxNorth - bboxSouth; // guaranteed positive
  // Now we know the full extent of latitude that this polygons spans.
  // To determine the easternmost and westernmost longitudes, we must 
  // check whether the path between each vertex crosses the antimeridian.
  // Antimeridian crossing is assumed if path length exceeds 180 degrees.
  var bboxEast = -180; // begin at least possible
  var bboxWest = 180;  // begin at most possible
  var thisPathSpan;
  var spanLongitude = 0; // initially, there is no longitude span
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
  // At this point, we know the full extent of longititude this polygons spans, 
  // as well as the full extent of latitude that this polygons spans. So, just 
  // return the smaller because that determines the level of precision needed.
  if (spanLatitude < spanLongitude) {
    return spanLatitude;
  } else {
    return spanLongitude;
  }
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
function preciseCoordinates(thisVertexArray, leastSpan) { 
  // LeastSpan is in degrees of latitude or longitude.
  // One degree of latitude is about 111 kilometers.
  // Provide two extra decimal places beyond scale requirement.
  // To prevent Javascript from removing trailing zeroes, use  
  // the "" +  method to coerce fixPrecision value to string.
  var thisLatitude = thisVertexArray[0];
  var thisLongitude = thisVertexArray[1];
  switch (true) {
    case (leastSpan < .00001): // scale is one meter
      return(fixPrecision(thisLatitude,10)+","+fixPrecision(thisLongitude,10));
    case (leastSpan < .0001):  // scale is ten meters
      return(fixPrecision(thisLatitude,9)+","+fixPrecision(thisLongitude,9));
    case (leastSpan < .001):   // scale is 100 meters
      return(fixPrecision(thisLatitude,8)+","+fixPrecision(thisLongitude,8));
    case (leastSpan < .01):   // scale is 1 kilometer
      return(fixPrecision(thisLatitude,7)+","+fixPrecision(thisLongitude,7));
    case (leastSpan < .1):    // scale is 10 kilometers
      return(fixPrecision(thisLatitude,6)+","+fixPrecision(thisLongitude,6));
    case (leastSpan < 1):     // scale is 100 kilometers
      return(fixPrecision(thisLatitude,5)+","+fixPrecision(thisLongitude,5));
    case (leastSpan < 10):     // scale is 1000 kilometers
      return(fixPrecision(thisLatitude,4)+","+fixPrecision(thisLongitude,4));
    case (leastSpan < 100):    // scale is 10000 kilometers
      return(fixPrecision(thisLatitude,3)+","+fixPrecision(thisLongitude,3));
    default:
      return(fixPrecision(thisLatitude,2)+","+fixPrecision(thisLongitude,2));
  }
}
function fixPrecision(numberValueAsString,precision) {
  // Function accepts a string and an integer; returns a string.
  var countDecimalDigits = 0;
  if (numberValueAsString.indexOf(".") > -1) { 
      var decimalSplit = numberValueAsString.split(".");
      countDecimalDigits = decimalSplit[1].split("").length;
  }
  if (countDecimalDigits > precision) {
    var numberFloat = parseFloat(numberValueAsString.trim());
    return numberFloat.toFixed(precision);
  }
  return(numberValueAsString);
}

