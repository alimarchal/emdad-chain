//the maps api is setup above
window.onload = function () {

    var latlng = new google.maps.LatLng(24.7136, 46.6753); //Set the default location of map

    var map = new google.maps.Map(document.getElementById('map'), {

        center: latlng,

        zoom: 13, //The zoom value for map

        mapTypeId: google.maps.MapTypeId.ROADMAP

    });

    var marker = new google.maps.Marker({

        position: latlng,

        map: map,

        title: 'Place the marker for your warehouse location!', //The title on hover to display

        draggable: true //this makes it drag and drop

    });

    google.maps.event.addListener(marker, 'dragend', function (a) {

        console.log(a);
        document.getElementById('longitude').value = a.latLng.lat().toFixed(4);
        document.getElementById('latitude').value = a.latLng.lng().toFixed(4); //Place the value in input box

    });

};
