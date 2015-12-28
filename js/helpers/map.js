var map = '';
var marker = [];

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