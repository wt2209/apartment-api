<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Person;
use App\Model\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function people(Request $request)
    {
        // TODO  validate

        if ($request->has('search')) {
            $peopleInRooms = $this->searchPeople($request);
        } else {
            $peopleInRooms = $this->getPeopleByOption($request);
        }

        return $peopleInRooms;
    }

    protected function searchPeople(Request $request)
    {
        $search = $request->input('search');
        if (str_contains($search, '-')) { //查找房间号
            $peopleInRooms = $this->searchPeopleByRoom($search);
        } else if (is_numeric($search)) { //查找电话号码
            $peopleInRooms = $this->searchPeopleByPhone($search);
        } else { //查找姓名
            $peopleInRooms = $this->searchPeopleByName($search);
        }
        return $peopleInRooms;
    }

    protected function getPeopleByOption($request)
    {
        $peopleInRooms = Room::with('people')
            ->where('room_type_id', $request->input('type'))
            ->where('building', $request->input('building'))
            ->where('unit', $request->input('unit'))
            ->get();

        return $this->formatPeopleData($peopleInRooms);
    }

    protected function formatPeopleData($peopleInRooms)
    {
        $peopleInRooms->map(function($room) {
            $count = count($room['people']);
            $room['person_number'] = $count > $room['person_number'] ? $count : $room['person_number'];
            return $room;
        });
        return $peopleInRooms;
    }

    protected function searchPeopleByRoom($search)
    {
        $peopleInRooms = Room::where('display_name', 'like', $search .'%')->with('people')->get();
        return $peopleInRooms;
    }

    protected function searchPeopleByPhone($search)
    {
        $roomIds = Person::where('phone_number','like', '%'.$search.'%')
            ->orWhere('standby_phone_number','like', '%'.$search.'%')
            ->distinct()
            ->pluck('room_id');

        $peopleInRooms = Room::with(['people' => function ($query) use($search) {
            $query->where('phone_number','like', '%'.$search.'%')
                ->orWhere('standby_phone_number','like', '%'.$search.'%');
        }])->whereIn('id', $roomIds)->get();

        return $peopleInRooms;
    }

    protected function searchPeopleByName($search)
    {
        if ($this->isLetters($search)) {
            $peopleInRooms = $this->searchPeopleByShortName($search);
        } else {
            $peopleInRooms = $this->searchPeopleByChineseName($search);
        }

        return $peopleInRooms;
    }

    protected function isLetters($search)
    {
        return preg_match("/^[a-zA-Z]+$/", $search);
    }

    protected function searchPeopleByShortName($search)
    {
        $roomIds = Person::where('short_name', strtolower($search))->distinct()->pluck('room_id');
        $peopleInRooms = Room::with(['people' => function ($query) use($search) {
            $query->where('short_name', strtolower($search));
        }])->whereIn('id', $roomIds)->get();
        return $peopleInRooms;
    }

    protected function searchPeopleByChineseName($search)
    {
        $roomIds = Person::where('name', 'like', '%' . $search . '%')->distinct()->pluck('room_id');
        $peopleInRooms = Room::with(['people' => function ($query) use($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }])->whereIn('id', $roomIds)->get();
        return $peopleInRooms;
    }
}
