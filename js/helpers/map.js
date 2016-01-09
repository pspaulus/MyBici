var map = '';
var marker = [];

function ver_mapa_todos(mapa) {

    //centrar
    var latlng = new google.maps.LatLng(-2.147, -79.963);

    //opciones mapa
    var myOptions = {
        zoom: 15,
        center: latlng,
        zoomControl: true,
        mapTypeControl: true,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    //creo mapa
    var map = new google.maps.Map(document.getElementById(mapa), myOptions);

    //muestro estaciones
    var estacion = $('.estacion');
    estacion.each(function (i, e) {
        var latitud = e.dataset.latitud;
        var longitud = e.dataset.longitud;
        var codigo = e.dataset.codigo;
        var ubicacion_estacion = new google.maps.LatLng(latitud, longitud);

        //coloco marcador
        //var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        //var otro = 'http://maps.google.com/mapfiles/marker_black.png';
        var marker = new google.maps.Marker({
            position: ubicacion_estacion,
            label: codigo
            //icon: otro
            //icon: iconBase + 'marker_black.png'

        });
        marker.setMap(map);

        //ventana flotante del marcador
        var infowindow = new google.maps.InfoWindow({
            content: '<div class="text-right" style="padding-left: 15px">' +
                            '<h4 class="panel-title tip">' + e.dataset.nombre + '</h3>'+
                     '</div>',
        });
        infowindow.open(map, marker);

        //al dar click amplia
        google.maps.event.addListener(marker,'click',function() {
            map.setZoom(18);
            map.setCenter(marker.getPosition());
        });

        //mostrar ventana flotante
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });

    });
}


function ver_mapa(mapa, x, y, z) {

    console.log(x + ', ' + y);

    var latlng = new google.maps.LatLng(y, x);

    var myOptions = {
        zoom: z,
        center: latlng,
        zoomControl: true,
        mapTypeControl: false,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById(mapa), myOptions);

    var marker = new google.maps.Marker({
        position: latlng
    });

    marker.setMap(map);
}


function guardar_mapa(mapa, latitud, longitud, zoom) {
    var latlng = new google.maps.LatLng(latitud, longitud);

    var myOptions = {
        zoom: zoom,
        center: latlng,
        zoomControl: true,
        mapTypeControl: false,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById(mapa), myOptions);

    var bandera = true;

    google.maps.event.addListener(map, 'click', function (event) {

        if (bandera == false) {
            guardar_mapa("googleMap", event.latLng.lat(), event.latLng.lng(), 15);
        } else {
            placeMarker(event.latLng);
            console.log(event);
            bandera = false;
        }
    });

    function placeMarker(location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });

        $('#latitud').val(location.lat());
        $('#longitud').val(location.lng());
    }
}