<?php

use Illuminate\Database\Seeder;
use App\Model\RoomType;
class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomType::create([
            'name' => 'college_rooms',
            'description'=>'大学生房间',
            'built_in' => 1,
        ]);
        RoomType::create([
            'name' => 'worker_rooms',
            'description'=>'职工房间',
            'built_in' => 1,
        ]);
        RoomType::create([
            'name' => 'dispatch_rooms',
            'description'=>'派遣工房间',
            'built_in' => 1,
        ]);
        RoomType::create([
            'name' => 'rent_rooms',
            'description'=>'租赁房间',
            'built_in' => 1,
        ]);
    }
}
