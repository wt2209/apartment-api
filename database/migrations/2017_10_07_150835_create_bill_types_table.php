<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill-types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->tinyInteger('late_fees_on')->default(0)->comment('是否收取滞纳金');
            $table->string('late_fees_name')->default('')->comment('滞纳金名称，如“租赁滞纳金”');
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
        Schema::dropIfExists('bill-types');
    }
}
