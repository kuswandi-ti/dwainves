<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReceivingReportDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_trx_receiving_report_dtl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('header_id')->nullable();
            $table->bigInteger('vpn_id')->nullable();
            $table->bigInteger('pn_id')->nullable();
            $table->string('pn_number', 50)->nullable();
            $table->string('pn_name', 255)->nullable();
            $table->string('unit_name', 255)->nullable();
            $table->double('qty_rr')->default(0);
            $table->bigInteger('price_id')->nullable();
            $table->double('price')->default(0);
            $table->string('rec_user_create', 255)->nullable();
            $table->dateTime('rec_datetime_create', 0)->nullable();
            $table->string('rec_user_update', 255)->nullable();
            $table->dateTime('rec_datetime_update', 0)->nullable();
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
        Schema::dropIfExists('tbl_trx_receiving_report_dtl');
    }
}
