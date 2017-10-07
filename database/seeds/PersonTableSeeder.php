<?php

use Illuminate\Database\Seeder;
use App\Model\Person;
use App\Model\Room;

class PersonTableSeeder extends Seeder
{
    private $names = ['张三', '李四', '王五', '赵六', '张强东', '二麻子', '李顺溜', '宋保强'];
    private $gender = ['男', '女'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->college();
    }

    private function college()
    {
        $roomCollections = Room::where('building', '7')->get();
        foreach ($roomCollections as $room) {
            for ($i=0; $i < 3; $i++) {
                $this->generateCollege($room->id);
            }
        }
    }

    private function generateCollege($roomId)
    {
        $name = $this->names[random_int(0, 7)];
        Person::create([
            'room_id'=>$roomId,
            'name' => $name,
            'short_name'=>pinyin_abbr($name),
            'gender' => $this->gender[random_int(0, 1)],
            'department'=>'涂装工程部',
            'checkin_at'=>\Carbon\Carbon::now(),
            'phone_number'=>'13542156321',
            'identify'=>'370215197812145214',
        ]);
    }
}
