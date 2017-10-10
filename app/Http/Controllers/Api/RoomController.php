<?php

namespace App\Http\Controllers\Api;

use App\Model\Room;
use App\Model\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;

/**
 * Class RoomController
 * @package App\Http\Controllers\Api
 */
class RoomController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function roomStructure()
    {
        // TODO 使用了缓存，当房间有变化时（修改。调整房间用途等），需要手动释放缓存：Cache::forget(key)
        if (Cache::has('roomStructure')) {
            $ret = Cache::get('roomStructure');
        } else {
            $ret = [];
            $roomTypes = RoomType::get();
            foreach ($roomTypes as $roomType) {
                $ret[] = $this->getBuildingsByType($roomType);
            }
            Cache::forever('roomStructure', $ret);
        }

        return response()->json($ret);
    }

    public function roomTypes()
    {
        return RoomType::get();
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function rooms(Request $request, $id = null)
    {
        if ($id) {
            return Room::find($id);
        }
        // TODO paginate
        $rooms = Room::with('type')->get();
        return response()->json($rooms);
    }

    /**
     * @param $roomType
     * @return array
     */
    private function getBuildingsByType($roomType)
    {
        $tmp = [];
        $tmp['label'] = $roomType->name;
        $tmp['value'] = $roomType->id;
        $buildings = $roomType->rooms()->select('building')->distinct()->get();
        foreach ($buildings as $building) {
            $tmp['children'][] = $this->getUnitsByBuilding($building);
        }
        return $tmp;
    }

    /**
     * @param $building
     * @return array
     */
    private function getUnitsByBuilding($building)
    {
        $b = [];
        $b['label'] = $building->building . '#';
        $b['value'] = $building->building;
        $units = Room::where('building', $building->building)
            ->select('unit')->distinct()->get();

        if (mb_substr($building->building, 0, 1) == '高') {
            $postfix = ' 楼';
        } else {
            $postfix = '单元';
        }
        foreach ($units as $unit) {
            $u['label'] = $unit->unit . $postfix;
            $u['value'] = $unit->unit;
            $b['children'][] = $u;
        }
        return $b;
    }
}
