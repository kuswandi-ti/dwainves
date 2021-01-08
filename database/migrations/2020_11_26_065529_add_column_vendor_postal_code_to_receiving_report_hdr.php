<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnVendorPostalCodeToReceivingReportHdr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_trx_receiving_report_hdr', function (Blueprint $table) {
            $table->string('vendor_postal_code', 50)->nullable()->after('vendor_address_city');
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
            $table->dropColumn(['vendor_postal_code']);
        });
    }
}
