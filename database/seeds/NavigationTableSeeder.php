<?php

use Illuminate\Database\Seeder;

class NavigationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navigations')->insert([
            'name' => 'people',
            'display_name'=>'人员',
            'url' => '',
            'icon'=>'',
            'parent_id'=>0,
        ]);
        DB::table('navigations')->insert([
            'name' => 'college',
            'display_name'=>'大学生',
            'url' => 'college',
            'icon'=>'',
            'parent_id'=>1,
        ]);
        DB::table('navigations')->insert([
            'name' => 'worker',
            'display_name'=>'职工',
            'url' => 'worker',
            'icon'=>'',
            'parent_id'=>1,
        ]);
        DB::table('navigations')->insert([
            'name' => 'dispatch_worker',
            'display_name'=>'派遣工',
            'url' => 'dispatcher',
            'icon'=>'',
            'parent_id'=>1,
        ]);
        DB::table('navigations')->insert([
            'name' => 'rent',
            'display_name'=>'租赁',
            'url' => 'rent',
            'icon'=>'',
            'parent_id'=>1,
        ]);

        DB::table('navigations')->insert([
            'name' => 'charge-lists',
            'display_name'=>'费用',
            'url' => '',
            'icon'=>'',
            'parent_id'=>0,
        ]);
        DB::table('navigations')->insert([
            'name' => 'rent-charge-lists',
            'display_name'=>'租赁费用',
            'url' => 'rent-charge-lists',
            'icon'=>'',
            'parent_id'=>1,
        ]);
        /**
         * $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->string('url');
            $table->string('icon'); // 图标
            $table->unsignedInteger('parent_id')->default(0);
            $table->timestamps();
         */
    }
}
