<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stevebauman\Location\Position;
use function Geodistance\kilometers;
use Geodistance\Location;

class DistanceController extends Controller
{
    public function distance() {
        $distance = $this->calcDistanceBetweenTwoPoint(1,1 ,4,4);
        return response()->json(array('msg'=> $distance), 200);
    }

    /*public function distanceBetweenTwoChosenPoint(Request $request) {
        $distance = $this->calcDistanceBetweenTwoPoint($request->input('firstPointX'),
                                                       $request->input('firstPointY'),
                                                       $request->input('secondPointX'),
                                                       $request->input('secondPointY'));
        return response()->json(array('msg'=> $distance), 200);
    }*/

    public function distanceBetweenTwoChosenPoint($x1, $x2, $y1, $y2) {
        $distance = $this->calcDistanceBetweenTwoPoint($x1, $x2, $y1, $y2);
        return response()->json(array('msg'=> $distance), 200);
    }

    /*public function distanceBetweenUserAndChosenPoint(Request $request) {
        $distance = $this->calcDistanceBetweenTwoPoint($request->input('firstPointX'),1 ,4,4);
        return response()->json(array('msg'=> $distance), 200);
    }*/

    public function distanceBetweenUserAndChosenPoint( $x1, $x2, $y1, $y2, Request $request) {
        $userPosition = geoip()->getLocation($request->ip());
        $distance2 = $this->calcDistanceBetweenTwoPoint($userPosition->lat, $x2, $userPosition->lon, $y2);
        $distance1 = $this->calcDistanceBetweenTwoPoint($userPosition->lat, $x1, $userPosition->lon, $y1);
        return response()->json(array('msg1'=> $distance1, 'msg2' => $distance2), 200);
        //dd($userPosition);
        //return array("ms" => $distance1, "ms2" => $distance2);
    }

    //private
    private function calcDistanceBetweenTwoPoint($firstPointX, $firstPointY, $secondPointX, $secondPointY) {
        $firstPoint = new Location($firstPointX, $firstPointY);
        $SecondPoint = new Location($secondPointX, $secondPointY);
        return kilometers($firstPoint, $SecondPoint);
    }
}
