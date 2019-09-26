@extends('layouts.simple_layout')

@section('content')
<div>
    <div>
    <div class="row" style="width:100%;height:800px;">
            <div class="col-lg-3">
                <div id="firstPoint" style="padding:3%">
                    <font id="firstPointHeader" size="6"></font>
                    <small id="firstXPointCoordinator"></small>, <small id="firstYPointCoordinator"></small>
                    <p id="firstPointDescription"></p>
                </div>
                <hr>
                <div id="secondPoint" style="padding:3%">
                    <font id="secondPointHeader" size="6"></font>
                    <small id="secondXPointCoordinator"></small>, <small id="secondYPointCoordinator"></small>
                    <p id="secondPointDescription" ></p>
                </div>
                <hr>
                <?php
                    echo Form::button('clac1',['onClick'=>'twoPoint()']);
                ?>
                <?php
                    echo Form::button('clac2',['onClick'=>'onePoint()']);
                ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><img src="{{asset('img/distance_blue.png')}}"></td>
                            <td id="Two"></td>
                        </tr>
                        <tr>
                            <td>Point A</td>
                            <td id="OneA"></td>
                        </tr>
                        <tr>
                            <td>Point B</td>
                            <td id="OneB"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <div class="col-lg-9" id="map" style="width:100%;height:100%"></div>
    </div>
    
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBubXXpQIxBhV8TBgWlxD-4lqR3BjUxnxs&callback=initMap">
    </script>

<script>
        var j =0;
    
      function initMap() {
        //var addresses = {!! json_encode($addresses->toArray()) !!}
        //console.log(addresses);
        
        var center = {lat: 33.519834, lng:36.275005};
        var markers = [
          ['Daraya', 33.457359,36.220859,'bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla'],
          ['Al-harah Al-Sharqeiah', 33.468821,36.205415, 'bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla'],
          ['Almoadameieh ', 33.459946,36.184469, 'bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla'],
        ];
        // Info Window Content
        var infoWindowContent = [
            ['<div class="info_content">' +
            '<h3>Daraya</h3>' +
            '<p>bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</p>' +'</div>'],
            ['<div class="info_content">' +
            '<h3>Al-harah Al-Sharqeiah</h3>' +
            '<p>bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</p>' +'</div>'],
            ['<div class="info_content">' +
            '<h3>Almoadameieh</h3>' +
            '<p>bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</p>' +'</div>'],
            ['<div class="info_content">' +
            '<h3>Sbeineh</h3>' +
            '<p>bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</p>' +'</div>'],
        ];
           var bounds = new google.maps.LatLngBounds();
          // var mapOptions = {
            //    mapTypeId: 'roadmap'
           //};
           // Display a map on the page
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
              //console.log(addresses);

               
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
    </script>
    <script>  
      function twoPoint() {
          var point1X= document.getElementById('firstXPointCoordinator').innerHTML;
          var point1Y= document.getElementById('firstYPointCoordinator').innerHTML;
          var point2X= document.getElementById('secondXPointCoordinator').innerHTML;
          var point2Y= document.getElementById('secondYPointCoordinator').innerHTML;
          var URL = '/Two/' + point1X + '/' + point2X + '/' + point1Y + '/' + point2Y;
        $.ajax({
            type:'GET',
            url:URL,
            success:function(data) {
              $("#Two").html(data.msg);
            }
        });
      }
      function onePoint() {
          var point1X= document.getElementById('firstXPointCoordinator').innerHTML;
          var point1Y= document.getElementById('firstYPointCoordinator').innerHTML;
          var point2X= document.getElementById('secondXPointCoordinator').innerHTML;
          var point2Y= document.getElementById('secondYPointCoordinator').innerHTML;
          var URL = '/one/' + point1X + '/' + point2X + '/' + point1Y + '/' + point2Y;
        $.ajax({
            type:'GET',
            url:URL,
            success:function(data) {
              $("#OneA").html(data.msg1);
              $("#OneB").html(data.msg2);
            }
        });
      }
  </script>
@endsection