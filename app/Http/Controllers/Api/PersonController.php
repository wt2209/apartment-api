<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function people(Request $request)
    {
        $peopleInRooms = Room::with('people')
            ->where('room_type_id', $request->typeId)
            ->where('building', $request->building)
            ->where('unit', $request->unit)
            ->get();

        $peopleInRooms->map(function($room) {
            $count = count($room['people']);
            $room['person_number'] = $count > $room['person_number'] ? $count : $room['person_number'];
            $room['people']->map(function($person) {
                $person['checkin_at'] = Carbon::createFromFormat('Y-m-d H:i:s',$person['checkin_at'])->toDateString();
                return $person;
            });
            return $room;
        });

        return $peopleInRooms;
//        $rooms = Room::where('room_type_id', $request->typeId)
//            ->where('building', $request->building)
//            ->where('unit', $request->unit)
//            ->get();
//        $data = [];
//        foreach ($rooms as $room) {
//            $people = $room->people()->get();
//            $count = count($people);
//            $room['person_number'] = $count > $room['person_number'] ? $count : $room['person_number'];
//            $room['people'] = $people->map(function ($item, $key){
//                $item['checkin_at'] = Carbon::createFromFormat('Y-m-d H:i:s',$item['checkin_at'])->toDateString();
//                return $item;
//            });
//
//            $data[] = $room;
//        }
//        return $data;



    }
}
