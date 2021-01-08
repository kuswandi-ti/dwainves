<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCertificateOfInvoiceHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_trx_certificate_of_invoice_hdr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('certificate_no', 50)->nullable();
            $table->date('certificate_date')->nullable();
            $table->time('certificate_time', 0)->nullable();
            $table->bigInteger('vendor_id')->nullable();
            $table->string('vendor_code', 50)->nullable();
            $table->string('vendor_name', 255)->nullable();
            $table->string('vendor_npwp', 255)->nullable();
            $table->tinyInteger('vendor_top')->default(0);
            $table->tinyInteger('vendor_is_ppn')->default(1)->comment('1=WITH PPN, 2=WITHOUTPPN');
            $table->string('vendor_phone', 255)->nullable();
            $table->string('vendor_fax', 255)->nullable();
            $table->string('vendor_email', 255)->nullable();
            $table->bigInteger('vendor_address_type_id')->nullable();
            $table->string('vendor_address_type_name', 255)->nullable();
            $table->string('vendor_address_title', 255)->nullable();
            $table->bigInteger('vendor_address_id')->nullable();
            $table->string('vendor_address', 255)->nullable();
            $table->string('vendor_address_city', 255)->nullable();     
            $table->bigInteger('vendor_person_id')->nullable();
            $table->string('vendor_person_name', 255)->nullable();
            $table->string('vendor_person_position', 255)->nullable();
            $table->string('plo_no', 50)->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('tbl_trx_certificate_of_invoice_hdr');
    }
}
