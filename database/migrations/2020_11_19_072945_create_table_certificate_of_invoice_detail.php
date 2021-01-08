<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCertificateOfInvoiceDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_trx_certificate_of_invoice_dtl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('header_id')->nullable();
            $table->string('invoice_no', 50)->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('faktur_name', 255)->nullable();
            $table->date('faktur_date')->nullable();
            $table->double('dpp')->default(0);
            $table->double('ppn')->default(0);
            $table->double('total')->default(0);
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
        Schema::dropIfExists('tbl_trx_certificate_of_invoice_dtl');
    }
}
