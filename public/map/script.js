var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib }),
            map = new L.Map('map', { center: new L.LatLng(-6.574792, 34.969652), zoom: 6}),
                drawnItems = L.featureGroup().addTo(map);

L.control.layers({
    'osm': osm.addTo(map),
        "google": L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',
            {attribution: 'google',  subdomains:['mt0','mt1','mt2','mt3'], maxZoom: 18, })},
                { 'drawlayer': drawnItems }, { position: 'topleft', collapsed: false }).addTo(map);

map.addControl(new L.Control.Draw({
    edit: {
        featureGroup: drawnItems,
    poly: {
        allowIntersection: false
    },
},

draw: {
    polygon: {
            allowIntersection: false,
            showArea: true
        }
}
}));

map.on(L.Draw.Event.CREATED, function (event) {
    var layer = event.layer;

    var type = event.layerType;

    if (type === 'marker') {
        var mCor = layer.getLatLng();

        console.log(mCor);

        // var lat = mCor.lat;
        // var long = mCor.lng;
        // var _token =  '{{csrf_token()}}';
        // alert(_token);

        // $.ajax({
        //     url:"{{route('maps_ajax')}}",
        //     method:"POST",
        //     data:{
        //         lat:lat,
        //             long:long,
        //         _token:_token
        //     },
        //     success: function (msg){
        //         alert(msg);
        //     }
        // });


    }else if (type === 'marker2') {
        var mCor2 = layer.getLatLng();
        
        console.log(mCor2);


    }  else if ( type === 'circle') {

        var cCenter = layer.getLatLng();
        var cRad = layer.getLatLng();

        console.log(cCenter);

    } else {

        // // console.log(layer.getLatLngs());
        // var shape = layer.toGeoJSON()
        // var shape_for_db = JSON.stringify(shape);

        // console.log(shape_for_db);
    }


    drawnItems.addLayer(layer);


});

// // restore
// let shape_for_db = {"type":"Feature","properties":{},"geometry":{"type":"Polygon","coordinates":[[[38.240756,-4.665595],[37.889147,-7.972199],[39.571848,-10.512504],[38.240756,-4.665595]]]}};

// L.geoJSON(shape_for_db).addTo(map);
