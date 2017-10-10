<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Person;
use App\Model\Room;
use Illuminate\Http\Request;

/**
 * Class PersonController
 * @package App\Http\Controllers\Api
 */
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
        } else if($request->has('dateType')){
            if (!in_array($request->input('dateType'), ['start', 'end'])) {
                return response()->json(['error'=>'invalid request'], 400);
            }
            $peopleInRooms = $this->searchPeopleByRentDate($request);
        } else {
            $peopleInRooms = $this->getPeopleByOption($request);
        }

        $data = $this->formatData($peopleInRooms);
        return $data;
    }

    /**
     * @param $peopleInRooms
     * @return array
     */
    protected function formatData($peopleInRooms)
    {
        $count = 0;
        $peopleInRooms->map(function($room) use (&$count) {
            $c = count($room['people']);
            $count += $c;
            $room['person_number'] = $c > $room['person_number'] ? $c : $room['person_number'];
            return $room;
        });
        return ['people'=>$peopleInRooms, 'peopleCount'=>$count, 'roomCount'=>count($peopleInRooms)];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function getPeopleByOption(Request $request)
    {
        $peopleInRooms = Room::with('people')
            ->where('room_type_id', $request->input('type'))
            ->where('building', $request->input('building'))
            ->where('unit', $request->input('unit'))
            ->get();
        return $peopleInRooms;
    }


    /**
     * @param $search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function searchPeopleByRoom($search)
    {
        $peopleInRooms = Room::where('display_name', 'like', $search .'%')->with('people')->get();
        return $peopleInRooms;
    }

    /**
     * @param $search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
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

    /**
     * @param $search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function searchPeopleByName($search)
    {
        if ($this->isLetters($search)) {
            $peopleInRooms = $this->searchPeopleByShortName($search);
        } else {
            $peopleInRooms = $this->searchPeopleByChineseName($search);
        }

        return $peopleInRooms;
    }

    /**
     * @param $search
     * @return int
     */
    protected function isLetters($search)
    {
        return preg_match("/^[a-zA-Z]+$/", $search);
    }

    /**
     * @param $search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function searchPeopleByShortName($search)
    {
        $roomIds = Person::where('short_name', strtolower($search))->distinct()->pluck('room_id');
        $peopleInRooms = Room::with(['people' => function ($query) use($search) {
            $query->where('short_name', strtolower($search));
        }])->whereIn('id', $roomIds)->get();
        return $peopleInRooms;
    }

    /**
     * @param $search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function searchPeopleByChineseName($search)
    {
        $roomIds = Person::where('name', 'like', '%' . $search . '%')->distinct()->pluck('room_id');
        $peopleInRooms = Room::with(['people' => function ($query) use($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }])->whereIn('id', $roomIds)->get();
        return $peopleInRooms;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function searchPeopleByRentDate(Request $request)
    {
        $filed = 'rent_' . $request->input('dateType') . '_date';
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $roomIds = Person::whereBetween($filed, [$startDate, $endDate])->distinct()->pluck('room_id');
        $peopleInRooms = Room::with(['people' => function ($query) use($filed, $startDate, $endDate) {
            $query->whereBetween($filed, [$startDate, $endDate]);
        }])->whereIn('id', $roomIds)->get();
        return $peopleInRooms;
    }
}
