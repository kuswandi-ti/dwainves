<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCertificateOfInvoiceTmp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_trx_certificate_of_invoice_tmp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendor_id')->nullable();
            $table->string('vendor_code', 50)->nullable();
            $table->string('plo_no', 50)->nullable();
            $table->string('invoice_no', 50)->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('faktur_name', 255)->nullable();
            $table->date('faktur_date')->nullable();
            $table->double('dpp')->default(0);
            $table->double('ppn')->default(0);
            $table->double('total')->default(0);
            $table->string('rdi_no', 50)->nullable();
            $table->date('rdi_date')->nullable();
            $table->string('user_login', 255)->nullable();
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
        Schema::dropIfExists('tbl_trx_certificate_of_invoice_tmp');
    }
}
