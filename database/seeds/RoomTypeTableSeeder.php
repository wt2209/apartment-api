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
            'name' => '大学生房间',
            'description'=>'大学生房间',
            'built_in' => 1,
        ]);
        RoomType::create([
            'name' => '职工房间',
            'description'=>'职工房间',
            'built_in' => 1,
        ]);
        RoomType::create([
            'name' => '派遣工房间',
            'description'=>'派遣工房间',
            'built_in' => 1,
        ]);
        RoomType::create([
            'name' => '租赁房间',
            'description'=>'租赁房间',
            'built_in' => 1,
        ]);
    }
}
