<?php

use Illuminate\Database\Seeder;
use App\Model\BillType;

class BillTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->rentType();
        $this->workerType();
        $this->chaofei();
    }

    private function rentType()
    {
        $rent = BillType::create([
            'title'=>'租赁费用',
            'parent_id'=>0
        ]);
        BillType::create([
            'title'=>'押金',
            'parent_id'=>$rent->id,
        ]);
        BillType::create([
            'title'=>'租金',
            'parent_id'=>$rent->id,
        ]);
        BillType::create([
            'title'=>'物业费',
            'parent_id'=>$rent->id,
        ]);
        BillType::create([
            'title'=>'电梯费',
            'parent_id'=>$rent->id,
        ]);
        BillType::create([
            'title'=>'电费',
            'parent_id'=>$rent->id,
        ]);
        BillType::create([
            'title'=>'水费',
            'parent_id'=>$rent->id,
        ]);
        BillType::create([
            'title'=>'有线电视费',
            'parent_id'=>$rent->id,
        ]);
        BillType::create([
            'title'=>'燃气费',
            'parent_id'=>$rent->id,
        ]);
    }

    private function workerType()
    {
        $worker = BillType::create([
            'title'=>'单身床位费用',
            'parent_id'=>0
        ]);
        BillType::create([
            'title'=>'押金',
            'parent_id'=>$worker->id,
        ]);
        BillType::create([
            'title'=>'床位费',
            'parent_id'=>$worker->id,
        ]);

        $waterAndElectric = BillType::create([
            'title'=>'单身水电费用',
            'parent_id'=>0
        ]);
        BillType::create([
            'title'=>'水费',
            'parent_id'=>$waterAndElectric->id,
        ]);
        BillType::create([
            'title'=>'电费',
            'parent_id'=>$waterAndElectric->id,
        ]);
    }

    private function chaofei()
    {
        $chaofei = BillType::create([
            'title'=>'超费费用',
            'parent_id'=>0
        ]);
        BillType::create([
            'title'=>'超费',
            'parent_id'=>$chaofei->id,
        ]);
    }
}
