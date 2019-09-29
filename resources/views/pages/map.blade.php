@extends('layouts.simple_layout')

@section('content')
<div>
    <div>
        <div class="row" style="width:100%;height:800px;">
            <div class="col-lg-3">
                <div id="firstPoint" style="padding:3%">
                    <font id="firstPointHeader" size="6"></font>
                    <br>
                    <small id="firstXPointCoordinator"></small>, <small id="firstYPointCoordinator"></small>
                    <p id="firstPointDescription"></p>
                </div>
                <hr>
                <div id="secondPoint" style="padding:3%">
                    <font id="secondPointHeader" size="6"></font>
                    <br>
                    <small id="secondXPointCoordinator"></small>, <small id="secondYPointCoordinator"></small>
                    <p id="secondPointDescription" ></p>
                </div>
                <hr>
                <div class="row">
                    <div class="button col-lg-6">
                        <div class="button_img" onclick="onePoint()" ><img src="{{asset('img/binoculars.png')}}"></div>
                        <div class="button_name"><small>distance between user & points</small></div>
                    </div>
                    <div class="button col-lg-6">
                        <div class="button_img" onclick="twoPoint()" ><img src="{{asset('img/distance_blue.png')}}"></div>
                        <div class="button_name"><small>distance between points</small></div>
                    </div>
                    <div id="validation_alert" style="width:100%; display:none;" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        please choose two points.
                    </div>
                </div>
                <div class="result_table">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>POINT A</th>
                            <th>POINT B</th>
                            <th>DISTANCE</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>pointa</td>
                                <td>pointb</td>
                                <td id="Two">0 km</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>pointa</td>
                                <td id="OneA">0 km</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>pointb</td>
                                <td id="OneB">0 km</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="col-lg-9" id="map" style="width:100%;height:100%"></div>
    </div>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBubXXpQIxBhV8TBgWlxD-4lqR3BjUxnxs&callback=initMap">
    </script>

    <script src="{{ url('/js/map.js')}}"></script>
    <script src="{{ url('/js/map_page.js')}}"></script>
@endsection