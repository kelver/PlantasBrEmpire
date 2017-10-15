var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];

function initialize() {
    var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);

    var options = {
        zoom: 3,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
}

initialize();

function abrirInfoBox(id, marker) {
    if (idInfoBoxAberto > 0) {
        infoBox[idInfoBoxAberto].close();
    }

    infoBox[id].open(map, marker);
    idInfoBoxAberto = id;
}

function carregarPontos(pontos) {
    var latlngbounds = new google.maps.LatLngBounds();
	$.each(pontos, function(index, ponto) {
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
			title: "Meu ponto personalizado! :-D",
			map: map,
            icon: '/cortex/admin/assets/images/marker.png'
		});

		var myOptions = {
            content: "<p><b>ID:</b> " + ponto.Id+ "<br><b>Latitude:</b> " + ponto.Latitude + "<br><b>Longitude:</b> " + ponto.Longitude + "<br><b>Fonte:</b> " + ponto.Fonte + "</p>",
            pixelOffset: new google.maps.Size(-150, 0)
        };

        infoBox[ponto.Id] = new InfoBox(myOptions);
        infoBox[ponto.Id].marker = marker;

        infoBox[ponto.Id].listener = google.maps.event.addListener(marker, 'click', function (e) {
            abrirInfoBox(ponto.Id, marker);
        });

        markers.push(marker);
        latlngbounds.extend(marker.position);


        var markerCluster = new MarkerClusterer(map, markers, {imagePath: 'assets/js/maps/google/markers/images/m'});

        map.fitBounds(latlngbounds);
	});
}
