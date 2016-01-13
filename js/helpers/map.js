var map = '';
var marker = [];

function ver_mapa_todos(mapa) {

    //centrar
    var latlng = new google.maps.LatLng(-2.147, -79.963);

    //opciones mapa
    var myOptions = {
        zoom: 15,
        center: latlng,
        zoomControl: false,
        mapTypeControl: false,
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
            content: '<div>' +
                        '<h4 style="padding-left: 15px" class="panel-title text-right tip"><i class="fa fa-home"></i> <label>' + e.dataset.nombre + '</h4>' +
                        '<div><i class="fa fa-product-hunt"></i> <label>' + e.dataset.parqueos_disponibles + '</label> <label class="inactivo"> / ' + e.dataset.parqueos_total + '</label></div>' +
                        '<div><i class="fa fa-bicycle"></i> <label>' + e.dataset.bicicletas_disponibles + '</label> <label class="inactivo"> / ' + e.dataset.bicicletas_total + '</label></div>' +
                     '</div>'
        });
        infowindow.open(map, marker);

        //al dar click amplia
        google.maps.event.addListener(marker, 'click', function () {
            map.setZoom(18);
            map.setCenter(marker.getPosition());
        });

        //mostrar ventana flotante
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.open(map, marker);
        });

    });

    var centrar = new google.maps.LatLng(-2.147, -79.963);
    map.setCenter(centrar);
}


function ver_mapa(mapa, x, y) {

    var latlng = new google.maps.LatLng(x, y);

    var myOptions = {
        zoom: 18,
        center: latlng,
        zoomControl: false,
        mapTypeControl: false,
        streetViewControl: false,
        draggable: false,
        scrollwheel: false,
        disableDoubleClickZoom: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById(mapa), myOptions);

    var latitud = $('#estacion_actual_latitud').val();
    var longitud = $('#estacion_actual_longitud').val();
    var codigo = $('#estacion_actual_codigo').val();
    var ubicacion_estacion = new google.maps.LatLng(latitud, longitud);

    var marker = new google.maps.Marker({
        position: ubicacion_estacion,
        label: codigo
     });
    marker.setMap(map);

    $('#mapTab').on('shown.bs.tab', function () {
        if (typeof map == "undefined") return;
        setTimeout(function () {
            if (typeof map == "undefined") return;
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        }, 400);
    })
}


function guardar_mapa(mapa) {

    var latlng = new google.maps.LatLng(-2.147, -79.963);

    var myOptions = {
        zoom: 15,
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
           // guardar_mapa("googleMap", event.latLng.lat(), event.latLng.lng(), 15);
        } else {
            placeMarker(event.latLng);
           // console.log(event);
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

    function CenterControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Pulse para reiniciar mapa';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = '#2E6DA4';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '13px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Marcar de nuevo';
        controlUI.appendChild(controlText);

        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener('click', function () {
            guardar_mapa("googleMap");
            map.setCenter(latlng);
            $('#latitud').val(0);
            $('#longitud').val(0);
        });
    }

    // Create the DIV to hold the control and call the CenterControl() constructor
    // passing in this DIV.
    var centerControlDiv = document.createElement('div');
    var centerControl = new CenterControl(centerControlDiv, map);

    centerControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);

    // ver en modal, necesitas hacer resize
    $('#crearEstacion').on('show.bs.modal', function () {
        //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
        if (typeof map == "undefined") return;

        setTimeout(function () {
            if (typeof map == "undefined") return;
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        }, 400);
    })
}

function editar_mapa(mapa, x, y) {

    var latlng = new google.maps.LatLng(x, y);

    var myOptions = {
        zoom: 18,
        center: latlng,
        zoomControl: true,
        mapTypeControl: false,
        streetViewControl: false,
        draggable: true,
        scrollwheel: true,
        disableDoubleClickZoom: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById(mapa), myOptions);

    var latitud = $('#estacion_actual_latitud').val();
    var longitud = $('#estacion_actual_longitud').val();
    var codigo = $('#estacion_actual_codigo').val();
    var ubicacion_estacion = new google.maps.LatLng(latitud, longitud);

    var iconBase = 'http://maps.google.com/mapfiles/marker_white.png';
    var marker = new google.maps.Marker({
        position: ubicacion_estacion,
        //label: codigo,
        icon: iconBase
    });
    marker.setMap(map);

    var infowindow = new google.maps.InfoWindow({
        content: '<div>' +
        '<h4 style="margin-bottom: -5px; color: #000; font-size: 12px" class="panel-title text-right tip">' +
        '<i class="fa fa-home"></i> <label> Ubicaci\u00F3n Actual </label></h4>' +
        '</div>'
    });
    infowindow.open(map, marker);

    //mostrar ventana flotante
    google.maps.event.addListener(marker, 'click', function () {
        infowindow.open(map, marker);
    });

    var bandera = true;

    google.maps.event.addListener(map, 'click', function (event) {

        if (bandera == false) {
            // guardar_mapa("googleMap", event.latLng.lat(), event.latLng.lng(), 15);
        } else {
            placeMarker(event.latLng);
            // console.log(event);
            bandera = false;
        }
    });

    function placeMarker(location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });

        $('#editar_latitud').val(location.lat());
        $('#editar_longitud').val(location.lng());
    }

    function CenterControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Pulse para reiniciar mapa';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = '#2E6DA4';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '13px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Marcar de nuevo';
        controlUI.appendChild(controlText);

        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener('click', function () {
            editar_mapa("editar_mapa_estacion",latlng.lat(),latlng.lng());
            map.setCenter(latlng);
            $('#editar_latitud').val(x);
            $('#editar_longitud').val(y);
        });
    }

    var centerControlDiv = document.createElement('div');
    var centerControl = new CenterControl(centerControlDiv, map);

    centerControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);




    $('#mapTab').on('shown.bs.tab', function () {
        if (typeof map == "undefined") return;
        setTimeout(function () {
            if (typeof map == "undefined") return;
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        }, 400);
    })


}