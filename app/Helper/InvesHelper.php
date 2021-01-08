<?php

    namespace App\Helper;

    use DB;

    class InvesHelper {
    	const TABLE_SYS_COUNTER_DOC_NUMBER		= 'tbl_sys_counter_docnumber';

    	const TABLE_MST_VENDOR					= 'TMst_Pur_Vendor';
    	const TABLE_MST_VENDOR_ADDRESS			= 'TMst_Pur_VendorAddress';
    	const TABLE_MST_ADDRESS_TYPE			= 'TMst_Utl_AddressType';
    	const TABLE_MST_VENDOR_PERSON			= 'TMst_Pur_VendorContactPerson';
    	const TABLE_MST_PRICE_VPN				= 'TMst_Pur_PriceVPN';

    	const TABLE_TRX_PLO_HDR					= 'TTrxhdr_Pur_PlaneOrder';
    	const TABLE_TRX_RDI_HDR             	= 'TTrxhdr_Pur_ReleaseDeliveryInstruction';
    	const TABLE_TRX_RDI_DTL             	= 'TTrxdtl_Pur_ReleaseDeliveryInstruction';
        const TABLE_TRX_RR_HDR              	= 'tbl_trx_receiving_report_hdr';
        const TABLE_TRX_RR_DTL              	= 'tbl_trx_receiving_report_dtl';
        const TABLE_TRX_COI_HDR             	= 'tbl_trx_certificate_of_invoice_hdr';
        const TABLE_TRX_COI_DTL             	= 'tbl_trx_certificate_of_invoice_dtl';
        const TABLE_TRX_COI_SUB_DTL         	= 'tbl_trx_certificate_of_invoice_sub_dtl';
        const TABLE_TRX_COI_TMP					= 'tbl_trx_certificate_of_invoice_tmp';

        const QUERY_TRX_OS_RDI_GR_HDR       	= 'QView_Whs_OutstandingRDIvsGR_Inves';
        const QUERY_TRX_OS_RDI_GR_DTL       	= 'QView_Whs_OutstandingDIGR';
        const QUERY_TRX_COI_HDR					= 'qview_trx_certificate_of_invoice_hdr';
        const QUERY_TRX_RDI_DTL					= 'QView_Pur_RDI_Dtl_Inves';

        const TRX_NAME_RECEIVING_REPORT     	= 'RECEIVING_REPORT';
        const TRX_NAME_CERTIFICATE_OF_INVOICE	= 'CERTIFICATE_OF_INVOICE';

        const FORMAT_DATE_TO_DISPLAY_1      	= 'd-m-Y';
        const FORMAT_DATE_TO_INSERT_1      		= 'Y-m-d';

        /**
	     * Create document number
	     *
	     * @param  string $trx_name = Name of Transaction
	     * @param  int $trx_month = Month of Transaction
	     * @param  int $trx_year = Year of Transaction
	     * @param  int $curr_doc_number = Current increment of document number transaction
	     * @return string
	     */
	    public static function create_doc_no($trx_name, $trx_month, $trx_year)
	    {
	        $count = DB::table(self::TABLE_SYS_COUNTER_DOC_NUMBER)
	                     ->where([['trx_name', $trx_name], ['trx_month', intval($trx_month)], ['trx_year', $trx_year]])
	                     ->max('curr_doc_number');                     
	        if ($count == 0) {
	            $current_no = 1;
	            DB::table(self::TABLE_SYS_COUNTER_DOC_NUMBER)->insert([
	                [
	                    'trx_month' => intval($trx_month), 
	                    'trx_year' => $trx_year, 
	                    'curr_doc_number' => $current_no, 
	                    'trx_name' => $trx_name
	                ]
	            ]);
	        } else {
	            $current_no = $count + 1;
	            DB::table(self::TABLE_SYS_COUNTER_DOC_NUMBER)
	                    ->where([['trx_name', $trx_name], ['trx_month', intval($trx_month)], ['trx_year', $trx_year]])
	                    ->update(['curr_doc_number' => $current_no]
	            );
	        }
	        return $current_no;
	    }

	    public static function left($text, $length)
	    {
	        return substr($text, 0, $length);
	    }

	    public static function right($text, $length)
	    {
	        return substr($text, -$length);
	    }

	    public static function to_float_value($val)
	    {
	        // $val = str_replace(",",".",$val);
	        $val = str_replace(",","",$val);
	        $val = preg_replace('/\.(?=.*\.)/', '', $val);
	        return floatval($val);
	    }
    }