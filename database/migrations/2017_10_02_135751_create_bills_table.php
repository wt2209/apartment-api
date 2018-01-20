<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number'); // 每一次缴费（房租/物业/电梯/水电等）是一个serial_number

            // 此三项至少有一个不为空
            $table->string('room')->default('')->comment('房间号');
            $table->string('name')->default('')->comment('姓名');
            $table->integer('bill_type_id')->default(0)->comment('费用类型');
            $table->string('description')->default('')->comment('费用说明');
            $table->decimal('amount', 8, 2)->default(0)->comment('费用金额');
            $table->tinyInteger('symbol')->default(1)->comment('是否是退费，取值1和-1');
            $table->string('payer')->comment('付款人');
            $table->tinyInteger('payed')->default(0)->comment('是否缴费');
            $table->dateTime('payed_at')->nullable()->comment('缴费时间');
            $table->tinyInteger('printed')->default(0)->comment('是否打印缴费单');
            $table->dateTime('printed_at')->nullable();
            $table->string('remark')->default('')->comment('备注');
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
        Schema::dropIfExists('bills');
    }
}
