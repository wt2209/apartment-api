<?php
namespace App\Repositories;

use App\Model\Person;
use App\Model\Room;
use Illuminate\Http\Request;

class PersonRepository
{
    public function getPeople(array $inputs)
    {
        switch ($inputs['search']) {
            case 'keyword':
                $peopleInRooms = $this->getPeopleByKeyword($inputs['keyword']);
                break;
            case 'date':
                $peopleInRooms = $this->getPeopleByRentDate($inputs);
                break;
            case 'select':
                $peopleInRooms = $this->getPeopleBySelection($inputs);
                break;
            default:
                $peopleInRooms = collect([]);
        }
        return $this->formatData($peopleInRooms);
    }

    public function getPerson($id)
    {
        return Person::with('room')->where('id', $id)->first();
    }

    public function storePerson($person)
    {
        return Person::create($person);
    }

    /**
     * @param $peopleInRooms
     * @return array
     */
    private function formatData($peopleInRooms)
    {
        $count = 0;
        $peopleInRooms->map(function($room) use (&$count) {
            $c = count($room['people']);
            $count += $c;
            $room['person_number'] = $c > $room['person_number'] ? $c : $room['person_number'];
            return $room;
        });
        return ['data'=>$peopleInRooms, 'meta'=>['peopleCount'=>$count, 'roomCount'=>count($peopleInRooms)]];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getPeopleByKeyword($keyword)
    {
        if (str_contains($keyword, '-')) { //查找房间号
            $peopleInRooms = $this->searchPeopleByRoom($keyword);
        } else if (is_numeric($keyword)) { //查找电话号码
            $peopleInRooms = $this->searchPeopleByPhone($keyword);
        } else { //查找姓名
            $peopleInRooms = $this->searchPeopleByName($keyword);
        }
        return $peopleInRooms;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getPeopleByRentDate($inputs)
    {
        $field = 'rent_' . $inputs['date_type'] . '_date';
        $startDate = $inputs['start_date'];
        $endDate = $inputs['end_date'];

        $roomIds = Person::whereBetween($field, [$startDate, $endDate])->distinct()->pluck('room_id');
        $peopleInRooms = Room::with(['people' => function ($query) use($field, $startDate, $endDate) {
            $query->whereBetween($field, [$startDate, $endDate]);
        }])->whereIn('id', $roomIds)->get();
        return $peopleInRooms;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getPeopleBySelection($inputs)
    {
        $peopleInRooms = Room::with('people')
            ->where('room_type_id', $inputs['type'])
            ->where('building', $inputs['building'])
            ->where('unit', $inputs['unit'])
            ->get();
        return $peopleInRooms;
    }


    /**
     * @param $keyword
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function searchPeopleByRoom($keyword)
    {
        $peopleInRooms = Room::where('display_name', 'like', $keyword .'%')->with('people')->get();
        return $peopleInRooms;
    }

    /**
     * @param $keyword
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function searchPeopleByPhone($keyword)
    {
        $roomIds = Person::where('phone_number','like', '%'.$keyword.'%')
            ->orWhere('standby_phone_number','like', '%'.$keyword.'%')
            ->distinct()
            ->pluck('room_id');

        $peopleInRooms = Room::with(['people' => function ($query) use($keyword) {
            $query->where('phone_number','like', '%'.$keyword.'%')
                ->orWhere('standby_phone_number','like', '%'.$keyword.'%');
        }])->whereIn('id', $roomIds)->get();

        return $peopleInRooms;
    }

    /**
     * @param $keyword
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function searchPeopleByName($keyword)
    {
        if ($this->isLetters($keyword)) {
            $peopleInRooms = $this->searchPeopleByShortName($keyword);
        } else {
            $peopleInRooms = $this->searchPeopleByChineseName($keyword);
        }

        return $peopleInRooms;
    }

    /**
     * @param $keyword
     * @return int
     */
    private function isLetters($keyword)
    {
        return preg_match("/^[a-zA-Z]+$/", $keyword);
    }

    /**
     * @param $keyword
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function searchPeopleByShortName($keyword)
    {
        $roomIds = Person::where('short_name', strtolower($keyword))->distinct()->pluck('room_id');
        $peopleInRooms = Room::with(['people' => function ($query) use($keyword) {
            $query->where('short_name', strtolower($keyword));
        }])->whereIn('id', $roomIds)->get();
        return $peopleInRooms;
    }

    /**
     * @param $keyword
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function searchPeopleByChineseName($keyword)
    {
        $roomIds = Person::where('name', 'like', '%' . $keyword . '%')->distinct()->pluck('room_id');
        $peopleInRooms = Room::with(['people' => function ($query) use($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }])->whereIn('id', $roomIds)->get();
        return $peopleInRooms;
    }
}
