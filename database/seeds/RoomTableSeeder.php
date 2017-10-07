<?php

use Illuminate\Database\Seeder;
use App\Model\Room;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->collegeRooms();
        $this->workerRooms();
        $this->dispatchRooms();
        $this->rentRooms();
    }

    private function collegeRooms(){
        $college = [
            '红2'=>[1,2,3],
            '红3'=>[1,2,3,4],
            '7'=>[1,2,3,4,5],
            '9'=>[1,2,3,4],
            '11'=>[1,2,3,4],
        ];

        foreach ($college as $building => $units) {
            foreach ($units as $unit) {
                for ($i=1;$i<=6;$i++){
                    $person_number = 4;
                    $u = $unit.'';
                    if ($i == 6) $person_number = 6;
                    Room::create([
                        'display_name'=>$building . '-' . $unit . '-' . $i.'01',
                        'status'=> 0,
                        'building'=> $building,
                        'unit'=> $u,
                        'room'=> $i . '01',
                        'person_number'=>$person_number,
                        'room_type_id'=>1
                    ]);
                    Room::create([
                        'display_name'=>$building . '-' . $unit . '-' . $i.'02',
                        'status'=> 0,
                        'building'=> $building,
                        'unit'=> $u,
                        'room'=> $i . '02',
                        'person_number'=>$person_number,
                        'room_type_id'=>1
                    ]);
                }
            }
        }
    }
    private function workerRooms(){
        for($i=1;$i<=20;$i++){
            if($i == 13) continue;
            if($i == 18) continue;
            if ($i < 7 ) {
                $u = '1-6';
            } elseif ($i < 14) {
                $u = '7-12';
            } else {
                $u = '14-20';
            }
            Room::create([
                'display_name'=>'高2-'.$i.'01',
                'status'=>random_int(0, 1),
                'building'=> '高2',
                'room'=> $i . '01',
                'unit'=>$u,
                'person_number'=>4,
                'room_type_id'=>2
            ]);
            Room::create([
                'display_name'=>'高2-'.$i.'02',
                'status'=>random_int(0, 1),
                'building'=> '高2',
                'unit'=>$u,
                'room'=> $i . '02',
                'person_number'=>4,
                'room_type_id'=>2
            ]);
            Room::create([
                'display_name'=>'高2-'.$i.'03',
                'status'=>random_int(0, 1),
                'building'=> '高2',
                'unit'=>$u,
                'room'=> $i . '03',
                'person_number'=>4,
                'room_type_id'=>2
            ]);
            Room::create([
                'display_name'=>'高2-'.$i.'04',
                'status'=>random_int(0, 1),
                'building'=> '高2',
                'unit'=>$u,
                'room'=> $i . '04',
                'person_number'=>4,
                'room_type_id'=>2
            ]);
        }
    }
    private function dispatchRooms(){
        $dispatch = [1,2,3,4];
        foreach ($dispatch as $unit) {
            for ($i=1;$i<=6;$i++){
                $person_number = 8;
                if ($i == 6) $person_number = 10;
                $u = $unit.'';
                Room::create([
                    'display_name'=>'13-' . $unit . '-' . $i.'01',
                    'status'=> 0,
                    'building'=> '13',
                    'unit'=> $u,
                    'room'=> $i . '01',
                    'person_number'=>$person_number,
                    'room_type_id'=>3
                ]);


                Room::create([
                    'display_name'=>'13-' . $unit . '-' . $i.'02',
                    'status'=> 0,
                    'building'=> '13',
                    'unit'=> $u,
                    'room'=> $i . '02',
                    'person_number'=>$person_number,
                    'room_type_id'=>3
                ]);
            }
        }


    }
    private function rentRooms(){
        $rent = [
            '红1'=>[1,2],
            '1'=>[1,2],
            '2'=>[1,2,3,4],
            '3'=>[1,2,3],
            '4'=>[1,2,3],
            '5'=>[1,2,3,4],
            '6'=>[1,2,3,4],
            '8'=>[1,2,3,4],
            '10'=>[1,2,3,4],
            '12'=>[1,2,3,4],
            '14'=>[1,2,3],
        ];
        foreach ($rent as $building => $units) {
            foreach ($units as $unit) {
                for ($i=1;$i<=6;$i++){
                    $person_number = 1;
                    $u = $unit.'';
                    Room::create([
                        'display_name'=>$building . '-' . $unit . '-' . $i.'01',
                        'status'=> 0,
                        'building'=> $building,
                        'unit'=> $u,
                        'room'=> $i . '01',
                        'person_number'=>$person_number,
                        'room_type_id'=>4
                    ]);


                    Room::create([
                        'display_name'=>$building . '-' . $unit . '-' . $i.'02',
                        'status'=> 0,
                        'building'=> $building,
                        'unit'=> $u,
                        'room'=> $i . '02',
                        'person_number'=>$person_number,
                        'room_type_id'=>4
                    ]);
                }
            }
        }

        $gao = ['高1', '高3', '高4', ];
        foreach ($gao as $building) {

            if ($building == '高1') {
                $start = 3;
                $end = 17;
            } else {
                $start = 1;
                $end = 20;
            }
            for($i=$start;$i<=$end;$i++){
                if($i == 13) continue;
                if($i == 18) continue;
                if ($building == '高1') {
                    if ($i < 8 ) {
                        $u = '3-7';
                    } elseif ($i < 14) {
                        $u = '8-12';
                    } else {
                        $u = '14-17';
                    }
                } else {
                    if ($i < 7 ) {
                        $u = '1-6';
                    } elseif ($i < 14) {
                        $u = '7-12';
                    } else {
                        $u = '14-20';
                    }
                }

                Room::create([
                    'display_name'=>$building.'-'.$i.'01',
                    'status'=>random_int(0, 1),
                    'building'=> $building,
                    'unit'=>$u,
                    'room'=> $i . '01',
                    'person_number'=>$person_number,
                    'room_type_id'=>4
                ]);
                Room::create([
                    'display_name'=>$building.'-'.$i.'02',
                    'status'=>random_int(0, 1),
                    'building'=> $building,
                    'unit'=>$u,
                    'room'=> $i . '02',
                    'person_number'=>$person_number,
                    'room_type_id'=>4
                ]);
                Room::create([
                    'display_name'=>$building.'-'.$i.'03',
                    'status'=>random_int(0, 1),
                    'building'=> $building,
                    'unit'=>$u,
                    'room'=> $i . '03',
                    'person_number'=>$person_number,
                    'room_type_id'=>4
                ]);
                Room::create([
                    'display_name'=>$building.'-'.$i.'04',
                    'status'=>random_int(0, 1),
                    'building'=> $building,
                    'unit'=>$u,
                    'room'=> $i . '04',
                    'person_number'=>$person_number,
                    'room_type_id'=>4
                ]);
            }
        }

    }
}
