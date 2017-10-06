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
        /**
         *TODO 还需建立一个表，记录缴费项目明细。
         *     此表的作用是在用户需要查询某项特定费用时，给予用户选择此项特定费用项目
         *     根据用户选择的项目查询json，格式化后输出项目明细或者费用总和
         *     租赁电费、水费、单身超费、单身床位费等都属于此表的内置内容。
         *     只需在手动添加缴费项目时，检查要添加的费用项目是否在，不存在则存入
         *     自动生成的费用不需检测此表
         *     此表只负责记录费用项目，不需要与 bills 表关联
         */
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');

            // 此三项至少有一个不为空
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('room_id');
            $table->string('title')->comment('费用项目');
            // 此三项至少有一个不为空

            $table->tinyInteger('symbol')->default(1)->comment('是否是退费，取值1和-1');
            $table->decimal('fees', 8, 2)->comment('费用金额');
            $table->tinyInteger('late_fees_on')->default(0)->comment('是否收取滞纳金');
            $table->decimal('late_rate', 5, 3)->default(0.003)->comment('滞纳金费率');
            $table->decimal('late_fees', 8, 2)->comment('滞纳金');
            $table->string('late_fees_base')->comment('以哪个费用为计算滞纳金的基数，取值为：总费用|租金|其他。。。');
            $table->timestamp('late_at')->comment('计算滞纳金的时间');
            $table->decimal('total_fees', 8, 2)->comment('实际缴费，费用与滞纳金之和');
            $table->decimal('turn_in_fees')->comment('应上缴北船财务的钱，包含滞纳金');
            $table->json('items')->comment('费用明细，字段：item,money,description,turn_in(是否上缴北船)');
            $table->string('payer')->comment('付款人');
            $table->tinyInteger('payed')->default(0)->comment('是否缴费');
            $table->timestamp('payed_at')->nullable()->comment('缴费时间');
            $table->tinyInteger('printed')->default(0)->comment('是否打印缴费单');
            $table->timestamp('printed_at')->nullable();

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
