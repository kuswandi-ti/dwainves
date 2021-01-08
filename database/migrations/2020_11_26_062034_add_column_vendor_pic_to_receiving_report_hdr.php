<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnVendorPicToReceivingReportHdr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_trx_receiving_report_hdr', function (Blueprint $table) {
            $table->string('vendor_pic', 255)->nullable()->after('vendor_is_ppn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_trx_receiving_report_hdr', function (Blueprint $table) {
            $table->dropColumn(['vendor_pic']);
        });
    }
}
