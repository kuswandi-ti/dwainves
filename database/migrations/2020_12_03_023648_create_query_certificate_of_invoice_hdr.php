<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueryCertificateOfInvoiceHdr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW qview_trx_certificate_of_invoice_hdr 
            AS
            SELECT
                a.*,
                (
                    SELECT
                        SUM(x.total) AS total 
                    FROM 
                        tbl_trx_certificate_of_invoice_dtl x
                        LEFT OUTER JOIN tbl_trx_certificate_of_invoice_hdr y ON x.header_id = y.id
                    GROUP BY 
                        x.header_id
                 ) AS grand_total
            FROM
                tbl_trx_certificate_of_invoice_hdr a
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW qview_trx_certificate_of_invoice_hdr");
    }
}
