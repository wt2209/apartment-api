<?php

use Illuminate\Database\Seeder;
use App\Model\Navigation;

/**
 * Class NavigationTableSeeder
 */
class NavigationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setPerson();
        $this->setRoom();
        $this->setBill();
    }

    private function setPerson()
    {
        $person = Navigation::create([
            'name' => 'person-list',
            'display_name'=>'人员',
            'url' => '',
            'icon'=>'',
            'parent_id'=>0,
        ]);
        Navigation::create([
            'name' => 'people',
            'display_name'=>'明细',
            'url' => 'people',
            'icon'=>'',
            'parent_id'=>$person->id,
        ]);
    }

    private function setRoom()
    {
        $room = Navigation::create([
            'name' => 'room-list',
            'display_name'=>'房间',
            'url' => '',
            'icon'=>'',
            'parent_id'=>0,
        ]);
        Navigation::create([
            'name' => 'room',
            'display_name'=>'明细',
            'url' => 'rooms',
            'icon'=>'',
            'parent_id'=>$room->id,
        ]);
        Navigation::create([
            'name' => 'room_type',
            'display_name'=>'类型',
            'url' => 'room-types',
            'icon'=>'',
            'parent_id'=>$room->id,
        ]);
    }

    private function setBill()
    {
        $bill = Navigation::create([
            'name' => 'bill-list',
            'display_name'=>'费用',
            'url' => '',
            'icon'=>'',
            'parent_id'=>0,
        ]);
        Navigation::create([
            'name' => 'bill',
            'display_name'=>'明细',
            'url' => 'bills',
            'icon'=>'',
            'parent_id'=>$bill->id,
        ]);
        Navigation::create([
            'name' => 'add-bill',
            'display_name'=>'添加费用',
            'url' => 'add-bill',
            'icon'=>'',
            'parent_id'=>$bill->id,
        ]);
    }
}
