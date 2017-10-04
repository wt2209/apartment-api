<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_type_id');
            $table->tinyInteger('status')->default(0)->comment('房间状态（是否空置）');
            $table->string('display_name');
            $table->string('building');
            $table->tinyInteger('unit')->nullable();
            $table->string('room');
            $table->tinyInteger('person_number')->comment('房间最大人数');

            //格式： 2017-10-2：事件1|2017-9-15：事件2
            $table->text('history_record')->nullable()->comment('房间历史事件记录');
            $table->string('remark')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
