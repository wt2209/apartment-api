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
            $table->string('short_name')->nullable()->comment('简写，如，张三：zs');
            $table->enum('gender', ['男', '女'])->nullable();
            $table->string('education')->nullable();
            $table->string('department')->nullable();
            $table->date('checkin_at')->nullable()->comment('入住时间');
            $table->string('phone_number')->nullable()->index();
            $table->date('rent_start_date')->nullable()->comment('租赁合同开始日期');
            $table->date('rent_end_date')->nullable()->comment('租赁合同开始日期');

            //附加信息
            $table->string('identify')->nullable()->comment('身份证号码');
            $table->string('standby_phone_number')->nullable()->index()->comment('备用联系电话');
            $table->date('contract_start_date')->nullable()->comment('劳动合同开始日期');
            $table->date('contract_end_date')->nullable()->comment('劳动合同开始日期');
            $table->string('spouse')->nullable()->comment('配偶姓名');
            $table->string('spouse_identify')->nullable()->comment('配偶身份证号');
            $table->string('spouse_phone_number')->nullable()->comment('配偶电话');
            $table->string('bed_number')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->index(['room_id', 'name', 'short_name', 'phone_number', 'standby_phone_number']);
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
