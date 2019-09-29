
var j =0;

function initMap() {
    var center = {lat: 33.519834, lng:36.275005};
    var bounds = new google.maps.LatLngBounds();

    map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: center
            });
    map.setTilt(45);

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    $.ajax({
        type:'GET',
        url:'provider',
        success:function(data) {
            var addresses=data.addresses ;
            console.log(data);
            for( i = 0; i < addresses.length; i++ ) {
                var position = new google.maps.LatLng(addresses[i].pointX, addresses[i].pointy);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: addresses[i].provider.name
                });

                // Each marker to have an info window
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infoWindow.setContent(addresses[i].address_description);
                        infoWindow.open(map, marker);
                        if(j%2 == 0)
                        {
                            $("#firstXPointCoordinator").html(addresses[i].pointX);
                            $("#firstYPointCoordinator").html(addresses[i].pointy);
                            $("#firstPointHeader").html(addresses[i].provider.name);
                            $("#firstPointDescription").html(addresses[i].address_description);
                            console.log(document.getElementsByClassName('test'));
                        }
                        else
                        {
                            $("#secondXPointCoordinator").html(addresses[i].pointX);
                            $("#secondYPointCoordinator").html(addresses[i].pointy);
                            $("#secondPointHeader").html(addresses[i].provider.name);
                            $("#secondPointDescription").html(addresses[i].address_description);
                        }
                        j=j+1;
                    }
                })(marker, i));

                // Automatically center the map fitting all markers on the screen
                map.fitBounds(bounds);
            }
        }
});
}