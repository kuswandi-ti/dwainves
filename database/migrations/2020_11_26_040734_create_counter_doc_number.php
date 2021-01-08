<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounterDocNumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sys_counter_docnumber', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trx_name', 50)->nullable();
            $table->integer('trx_month')->nullable();
            $table->integer('trx_year')->nullable();
            $table->integer('curr_doc_number')->default(0);
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
        Schema::dropIfExists('tbl_sys_counter_docnumber');
    }
}
