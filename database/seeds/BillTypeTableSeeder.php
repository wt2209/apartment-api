<?php

use Illuminate\Database\Seeder;
use App\Model\BillType;

class BillTypeTableSeeder extends Seeder
{
    public $types = [
            ['name'=>'超市电费','late_fees_on'=>1,'late_fees_name'=>'超市滞纳金'],
            ['name'=>'超市物业费','late_fees_on'=>1,'late_fees_name'=>'超市滞纳金'],
            ['name'=>'大学生超费','late_fees_on'=>0],
            ['name'=>'单身床位费','late_fees_on'=>0],
            ['name'=>'单身电费','late_fees_on'=>0],
            ['name'=>'单身剩余燃气','late_fees_on'=>0],
            ['name'=>'单身水费','late_fees_on'=>0],
            ['name'=>'单身押金','late_fees_on'=>0],
            ['name'=>'派遣工超费','late_fees_on'=>0],
            ['name'=>'派遣工押金','late_fees_on'=>0],
            ['name'=>'赔偿','late_fees_on'=>0],
            ['name'=>'天网电费','late_fees_on'=>0],
            ['name'=>'武船中层押金','late_fees_on'=>0],
            ['name'=>'饮水机电费','late_fees_on'=>0],
            ['name'=>'饮水机水费','late_fees_on'=>0],
            ['name'=>'租赁采暖费','late_fees_on'=>0],
            ['name'=>'租赁电费','late_fees_on'=>0],
            ['name'=>'租赁电梯费','late_fees_on'=>0],
            ['name'=>'租赁房租','late_fees_on'=>1,'late_fees_name'=>'租赁滞纳金'],
            ['name'=>'租赁剩余燃气','late_fees_on'=>0],
            ['name'=>'租赁剩余有线','late_fees_on'=>0],
            ['name'=>'租赁水费','late_fees_on'=>0],
            ['name'=>'租赁物业费','late_fees_on'=>0],
            ['name'=>'租赁押金','late_fees_on'=>0],
        ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $type) {
            if (!$type['late_fees_on']) {
                $type['late_fees_name'] = '';
            }
            $rent = BillType::create([
                'title' => $type['name'],
                'late_fees_on' => $type['late_fees_on'],
                'late_fees_name'=>$type['late_fees_name']
            ]);
        }
    }

}
