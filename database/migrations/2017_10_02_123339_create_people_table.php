<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_id');
            // 基本信息
            $table->string('name');
            $table->enum('gender', ['男', '女'])->nullable();
            $table->string('education');
            $table->string('department');
            $table->timestamp('checkin_at')->comment('入住时间');
            $table->string('phone_number');
            $table->timestamp('rent_start_date')->comment('租赁合同开始日期');
            $table->timestamp('rent_end_date')->comment('租赁合同开始日期');

            //附加信息
            $table->string('identify')->comment('身份证号码');
            $table->string('standby_phone_number')->comment('备用联系电话');
            $table->timestamp('contract_start_date')->comment('劳动合同开始日期');
            $table->timestamp('contract_end_date')->comment('劳动合同开始日期');
            $table->string('spouse')->comment('配偶姓名');
            $table->string('spouse_identify')->comment('配偶身份证号');
            $table->string('spouse_phone_number')->comment('配偶身份证号');
            $table->string('bed_number');
            $table->string('remark');
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
        Schema::dropIfExists('people');
    }
}
