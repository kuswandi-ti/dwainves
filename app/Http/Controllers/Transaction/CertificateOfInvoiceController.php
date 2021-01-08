<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\Helper\InvesHelper;
use App\Models\Transaction\ReceivingReportHdrModel;
use App\Models\Transaction\ReceivingReportDtlModel;

use DB;
use DateTime;
use PDF;

class CertificateOfInvoiceController extends Controller
{
    private $trx_name_certificate_of_invoice;

	private $table_trx_coi_hdr;
	private $table_trx_coi_dtl;
	private $table_trx_coi_sub_dtl;
    private $table_trx_coi_tmp;

    private $table_trx_plo_hdr;
    private $table_trx_rdi_hdr;

    private $table_mst_vendor;
    private $table_mst_vendor_address;
    private $table_mst_vendor_address_type;
    private $table_mst_vendor_person;

	private $view_trx_coi_hdr;
    private $view_trx_rdi_dtl;

    private $format_date_to_display_1;
    private $format_date_to_insert_1;

	public function __construct()
	{	
        $this->trx_name_certificate_of_invoice      = InvesHelper::TRX_NAME_CERTIFICATE_OF_INVOICE;
        $this->table_trx_coi_hdr                    = InvesHelper::TABLE_TRX_COI_HDR;
        $this->table_trx_coi_dtl             		= InvesHelper::TABLE_TRX_COI_DTL;
        $this->table_trx_coi_sub_dtl               	= InvesHelper::TABLE_TRX_COI_SUB_DTL;
        $this->table_trx_coi_tmp                    = InvesHelper::TABLE_TRX_COI_TMP;
        $this->table_trx_plo_hdr                    = InvesHelper::TABLE_TRX_PLO_HDR;
        $this->table_trx_rdi_hdr                    = InvesHelper::TABLE_TRX_RDI_HDR;
        $this->table_mst_vendor                     = InvesHelper::TABLE_MST_VENDOR;
        $this->table_mst_vendor_address             = InvesHelper::TABLE_MST_VENDOR_ADDRESS;
        $this->table_mst_vendor_address_type        = InvesHelper::TABLE_MST_ADDRESS_TYPE;
        $this->table_mst_vendor_person              = InvesHelper::TABLE_MST_VENDOR_PERSON;
        $this->view_trx_coi_hdr                    	= InvesHelper::QUERY_TRX_COI_HDR;
        $this->view_trx_rdi_dtl                     = InvesHelper::QUERY_TRX_RDI_DTL;
        $this->format_date_to_display_1             = InvesHelper::FORMAT_DATE_TO_DISPLAY_1;
        $this->format_date_to_insert_1              = InvesHelper::FORMAT_DATE_TO_INSERT_1;
    }

    /* Show Page - Begin */
    public function index()
    {        
        return view('transaction.certificate-of-invoice-list');
    }

    public function input_certificate_of_invoice()
    {
        return view('transaction.certificate-of-invoice-input');
    }
    /* Show Page - End */

    /* List Data - Begin */
    public function list_certificate_of_invoice_hdr(Request $request)
    {
        $columns        = array( 
                                0   => 'id', 
                                1   => 'DT_RowIndex',
                                2   => 'certificate_no',
                                3   => 'certificate_date',
                                4   => 'plo_no',
                                5   => 'grand_total',
                                6   => 'action',
                          );
        $totalData      = DB::table($this->view_trx_coi_hdr)
                                ->whereRaw("vendor_id = ?", [Session::get('sess_vendor_id')])
                                ->count();
        $totalFiltered  = $totalData;
        $limit          = $request->input('length');
        $start          = $request->input('start');
        $order          = $columns[$request->input('order.0.column')];
        $dir            = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
            $posts = DB::table($this->view_trx_coi_hdr)
                            ->offset($start)
                            ->limit($limit)
                            ->whereRaw("vendor_id = ?", [Session::get('sess_vendor_id')])
                            ->orderByDesc('certificate_date')
                            ->orderByDesc('certificate_no')
                            ->get();
        }
        else
        {
            $search         = $request->input('search.value');
            $posts          =  DB::table($this->view_trx_coi_hdr)
                                    ->offset($start)
                                    ->limit($limit)
                                    ->whereRaw("certificate_no LIKE '%{$search}%' AND vendor_id = ?", [Session::get('sess_vendor_id')])
                                    ->orWhereRaw("plo_no LIKE '%{$search}%' AND vendor_id = ?", [Session::get('sess_vendor_id')])
                                    ->orderByDesc('rr_date')
                                    ->orderByDesc('rr_no')
                                    ->get();
            $totalFiltered  = DB::table($this->view_trx_coi_hdr)
                                    ->whereRaw("certificate_no LIKE '%{$search}%' AND vendor_id = ?", [Session::get('sess_vendor_id')])
                                    ->orWhereRaw("plo_no LIKE '%{$search}%' AND vendor_id = ?", [Session::get('sess_vendor_id')])
                                    ->count();
        }

        $data   = array();
        $i      = $start + 1;

        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['id']                  		= $post->id;
                $nestedData['DT_RowIndex']              = $i;
                $nestedData['certificate_no']           = $post->certificate_no;
                $nestedData['certificate_date']         = date($this->format_date_to_display_1,strtotime($post->certificate_date));
                $nestedData['plo_no']   				= $post->plo_no;
                $nestedData['grand_total']   			= $post->grand_total;
                $nestedData['action']                   = "<a href='javascript:void(0)' id='print_coi' data-toggle='tooltip' title='Print' data-id='$post->id' data-original-title='Print' class='print btn btn-success btn-sm'><i class='fas fa-print'></i>Print</a>";
                $data[]                                 = $nestedData;
                $i++;
            }
        }
          
        $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                    );
            
        echo json_encode($json_data);
    }

    public function list_certificate_of_invoice_tmp()
    {
        $query = DB::table($this->table_trx_coi_tmp)
                        ->select('plo_no', 'invoice_no', 'invoice_date', 'faktur_name', 'faktur_date', 'dpp', 'ppn', 'total')
                        ->where('vendor_id', '=', Session::get('sess_vendor_id'))
                        ->groupBy('plo_no', 'invoice_no', 'invoice_date', 'faktur_name', 'faktur_date', 'dpp', 'ppn', 'total')
                        ->orderByDesc('invoice_date')
                        ->orderByDesc('invoice_no')
                        ->get();
        return $query;
    }
    /* List Data - End */

    /* CRUD - Begin */
    public function store_certificate_of_invoice_tmp(Request $request)
    {  
        $username               = Session::get('sess_username');
        $date_time              = new DateTime;

        $vendor_id              = Session::get('sess_vendor_id');
        $vendor_code            = Session::get('sess_vendor_code');
        $plo_no                 = $request->cbo_nomor_plo;
        $invoice_no             = $request->no_invoice_supplier;
        $invoice_date           = date($this->format_date_to_insert_1, strtotime($request->tanggal_invoice_supplier));
        $faktur_name            = $request->nomor_faktur;
        $faktur_date            = date($this->format_date_to_insert_1, strtotime($request->tanggal_faktur));
        $dpp_rdi                = InvesHelper::to_float_value($request->total_dpp_rdi);
        $ppn_rdi                = InvesHelper::to_float_value($request->total_ppn_rdi);
        $total_rdi              = InvesHelper::to_float_value($request->grand_total_rdi);

        $chk_select             = $request->input('chk_select', []);
        $rdi_no                 = $request->input('no_rdi', []);
        $rdi_date               = $request->input('tgl_rdi', []);

        // No PLO tidak boleh berbeda dalam 1 COI (dari tabel tmp)
        $field_plo_no = '';
        $query = DB::table($this->table_trx_coi_tmp)
                        ->select('plo_no')
                        ->where([
                            ['vendor_id', '=', $vendor_id],
                        ])
                        ->groupBy('plo_no')
                        ->get();
        $count_record = count($query);
        if ($count_record > 0)
        {
            foreach($query as $item => $values)
            {
                $field_plo_no = is_null($values->plo_no) ? '' : $values->plo_no;                
            }
            if (trim($field_plo_no) != trim($plo_no))
            {
                return response()->json([
                    'success' => false, 
                    'message' => "No. PLO tidak sama !!! Dalam 1 Certificate of Invoice harus dengan No. PLO yang sama.",
                ]);
                exit();
            }
        }        

        // No. Invoice tidak boleh sama untuk 1 vendor (dari tabel tmp)
        $query = DB::table($this->table_trx_coi_tmp)
                        ->select('invoice_no')
                        ->where([
                            ['vendor_id', '=', $vendor_id],
                            ['invoice_no', '=', $invoice_no],
                        ])
                        ->get();
        $count_record = count($query);
        if ($count_record > 0)
        {
            return response()->json([
                'success' => false, 
                'message' => "No. Invoice " . $invoice_no . " sudah pernah dibuatkan Certificate of Invoice !!! [" . trim($field_plo_no) . "] - [" . trim($plo_no) ."]",
            ]);
        }

        // No. Invoice tidak boleh sama untuk 1 vendor (dari tabel trx)
        $query = DB::select(DB::raw("SELECT
                                        A.invoice_no
                                    FROM
                                        ".$this->table_trx_coi_dtl." A
                                        LEFT OUTER JOIN ".$this->table_trx_coi_hdr." B ON A.header_id = B.id
                                    WHERE
                                        B.vendor_id = '".$vendor_id."'
                                        AND A.invoice_no = '".$invoice_no."'"));
        $count_record = count($query);
        if ($count_record > 0)
        {
            return response()->json([
                'success' => false, 
                'message' => "No. Invoice " . $invoice_no . " sudah pernah dibuatkan Certificate of Invoice !!!",
            ]);
        }

        DB::beginTransaction();

        try
        {
            for ($a = 0; $a < count($chk_select); $a++)
            {
                $x = $chk_select[$a];

                DB::table($this->table_trx_coi_tmp)->insert([
                    'vendor_id'     => $vendor_id, 
                    'vendor_code'   => $vendor_code,
                    'plo_no'        => $plo_no, 
                    'invoice_no'    => $invoice_no,
                    'invoice_date'  => $invoice_date, 
                    'faktur_name'   => $faktur_name,
                    'faktur_date'   => $faktur_date, 
                    'dpp'           => $dpp_rdi,
                    'ppn'           => $ppn_rdi, 
                    'total'         => $total_rdi,
                    'rdi_no'        => $rdi_no[$x], 
                    'rdi_date'      => date($this->format_date_to_insert_1, strtotime($rdi_date[$x])),
                    'user_login'    => $username,
                    'created_at'    => $date_time,
                ]);
            }
            DB::commit();                
            return response()->json([
                'success'       => true, 
                'message'       => 'success',
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => $e.'<br>Rollback Transaction !!!'
            ]);
        }
    }

    public function delete_invoice_no_tmp($invoice_no)
    {
        DB::beginTransaction();

        try
        {
            DB::table($this->table_trx_coi_tmp)->where('invoice_no', '=', $invoice_no)->delete();
            DB::commit();                
            return response()->json([
                'success'       => true, 
                'message'       => 'Data invoice berhasil dihapus.',
            ]);
        }
        catch (\Exception $e)
        {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => $e.'<br>Rollback Transaction !!!'
            ]);
        }
    }

    public function store_certificate_of_invoice()
    {
        $vendor_id              = Session::get('sess_vendor_id');
        $username               = Session::get('sess_username');
        $date_time              = new DateTime;
        $date_now               = date("Y-m-d");
        $time_now               = date("H:i:s");
        $rec_user_create        = $username;
        $rec_datetime_create    = $date_time;
        $rec_user_upate         = $username;
        $rec_datetime_update    = $date_time;
        $year                   = date("yy", strtotime($date_now));
        $month                  = date("m", strtotime($date_now));

        // 1. Header
        // 1.a. PLO
        $plo_no   = '';
        $query = DB::table($this->table_trx_coi_tmp)
                        ->select('plo_no')
                        ->where([
                            ['vendor_id', '=', $vendor_id],
                        ])
                        ->groupBy('plo_no')
                        ->get();
        $count_record = count($query);
        if ($count_record > 0)
        {
            foreach($query as $item => $values)
            {
                $plo_no = is_null($values->plo_no) ? '' : $values->plo_no;
            }
        }
        else
        {
            return response()->json([
                'success'       => false, 
                'message'       => 'Tidak ada data !!!', 
                'coi_id'        => '',
                'coi_no'        => '',
            ]);
        }

        // 1.b. TMst_Pur_Vendor
        $vendor_code    = '';
        $vendor_name    = '';
        $vendor_npwp    = '';
        $vendor_top     = 0;
        $vendor_is_ppn  = 0;
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->table($this->table_mst_vendor)
                        ->select('Vendor_Code', 'Vendor_Name', 'NPWP', 'TOP', 'IsPPN')
                        ->where([
                            ['SysId', '=', $vendor_id],
                        ])
                        ->get();
        $count_record = count($query);
        if ($count_record > 0)
        {
            foreach($query as $item => $values)
            {
                $vendor_code    = is_null($values->Vendor_Code) ? '' : $values->Vendor_Code;
                $vendor_name    = is_null($values->Vendor_Name) ? '' : $values->Vendor_Name;
                $vendor_npwp    = is_null($values->NPWP) ? '' : $values->NPWP;
                $vendor_top     = is_null($values->TOP) ? 0 : $values->TOP;
                $vendor_is_ppn  = is_null($values->IsPPN) ? 0 : $values->IsPPN;
            }
        }

        // 1.c. TMst_Pur_VendorAddress (jika address lebih dari 1, yg dipakai max sysid. Address difilter hanya yg tipe head office, sysid = 3)
        $vendor_address_id          = '';
        $vendor_address             = '';
        $vendor_address_city        = '';
        $vendor_phone               = '';
        $vendor_fax                 = '';
        $vendor_email               = '';
        $vendor_address_type_id     = '';
        $vendor_address_type_name   = '';
        $vendor_address_title       = '';
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->select(DB::raw("SELECT 
                                                ADD_1.SysId AS Address_Id, 
                                                ADD_1.Address, 
                                                ADD_1.City, 
                                                ADD_1.Phone, 
                                                ADD_1.Fax, 
                                                ADD_1.Email, 
                                                ADD_1.AddressType_Id, 
                                                ADD_1.Address_Title,
                                                ADD_3.AddressType_Name
                                          FROM ".$this->table_mst_vendor_address." ADD_1
                                          INNER JOIN (
                                                    SELECT MAX(SysId) AS MaxSysId, Vendor_Id
                                                    FROM ".$this->table_mst_vendor_address."
                                                    WHERE AddressType_Id = 3
                                                    GROUP BY Vendor_Id
                                                    ) ADD_2
                                                ON ADD_1.Vendor_Id = ADD_2.Vendor_Id
                                                AND ADD_1.SysId = ADD_2.MaxSysId 
                                          INNER JOIN ".$this->table_mst_vendor_address_type." ADD_3 ON ADD_1.AddressType_Id = ADD_3.SysId   
                                          WHERE ADD_1.Vendor_Id = :var_vendor_id"), array('var_vendor_id' => Session::get('sess_vendor_id')));
        $count_record = count($query);
        if ($count_record > 0)
        {
            foreach($query as $item => $values)
            {
                $vendor_address_id          = is_null($values->Address_Id) ? '' : $values->Address_Id;
                $vendor_address             = is_null($values->Address) ? '' : $values->Address;
                $vendor_address_city        = is_null($values->City) ? '' : $values->City;
                $vendor_phone               = is_null($values->Phone) ? '' : $values->Phone;
                $vendor_fax                 = is_null($values->Fax) ? '' : $values->Fax;
                $vendor_email               = is_null($values->Email) ? '' : $values->Email;
                $vendor_address_type_id     = is_null($values->AddressType_Id) ? '' : $values->AddressType_Id;
                $vendor_address_type_name   = is_null($values->AddressType_Name) ? '' : $values->AddressType_Name;
                $vendor_address_title       = is_null($values->Address_Title) ? '' : $values->Address_Title;
            }
        }

        // 1.d. TMst_Pur_VendorContactPerson
        $vendor_person_id       = '';
        $vendor_person_name     = '';
        $vendor_person_position = '';
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->table($this->table_mst_vendor_person)
                        ->select('SysId', 'Name', 'Position')
                        ->where([
                            ['Address_Id', '=', $vendor_address_id],
                        ])
                        ->get();
        $count_record = count($query);
        if ($count_record > 0)
        {
            foreach($query as $item => $values)
            {
                $vendor_person_id       = is_null($values->SysId) ? '' : $values->SysId;
                $vendor_person_name     = is_null($values->Name) ? '' : $values->Name;
                $vendor_person_position = is_null($values->Position) ? '' : $values->Position;
            }
        }

        //DB::beginTransaction();

        try
        {
            // 1. Insert ke header
            $last_doc_no    = InvesHelper::create_doc_no($this->trx_name_certificate_of_invoice, $month, $year);
            $coi_no         = "COI-" .
                              InvesHelper::right($year, 2) . $month . "-" .
                              InvesHelper::right("0000" . $last_doc_no, 4);
            $data = array(
                'certificate_no'            => $coi_no, 
                'certificate_date'          => $date_now,
                'certificate_time'          => $time_now, 
                'vendor_id'                 => $vendor_id,
                'vendor_code'               => $vendor_code, 
                'vendor_name'               => $vendor_name,
                'vendor_npwp'               => $vendor_npwp, 
                'vendor_top'                => $vendor_top,
                'vendor_is_ppn'             => $vendor_is_ppn, 
                'vendor_phone'              => $vendor_phone,
                'vendor_fax'                => $vendor_fax, 
                'vendor_email'              => $vendor_email,
                'vendor_address_type_id'    => $vendor_address_type_id, 
                'vendor_address_type_name'  => $vendor_address_type_name,
                'vendor_address_title'      => $vendor_address_title, 
                'vendor_address_id'         => $vendor_address_id,
                'vendor_address'            => $vendor_address, 
                'vendor_address_city'       => $vendor_address_city,
                'vendor_person_id'          => $vendor_person_id, 
                'vendor_person_name'        => $vendor_person_name,
                'vendor_person_position'    => $vendor_person_position, 
                'plo_no'                    => $plo_no,
                'rec_user_create'           => $username,
                'rec_datetime_create'       => $date_time,
                'rec_user_update'           => $username,
                'rec_datetime_update'       => $date_time,
                'created_at'                => $date_time,
                'updated_at'                => $date_time,
            );
            $header_id = DB::table($this->table_trx_coi_hdr)->insertGetId($data);

            if (!empty($header_id))
            {

            }
            else
            {

            }

            // 2. Insert ke detail
            $string = "SELECT
                            invoice_no,
                            invoice_date,
                            faktur_name,
                            faktur_date,
                            dpp,
                            ppn,
                            total
                       FROM
                            ".$this->table_trx_coi_tmp."
                       WHERE
                            vendor_id = '".Session::get('sess_vendor_id')."' 
                       GROUP BY
                            invoice_no,
                            invoice_date,
                            faktur_name,
                            faktur_date,
                            dpp,
                            ppn,
                            total";
            $query = DB::select(preg_replace("/\r\n|\r|\n/", '', $string));
            $count_record = count($query);
            if ($count_record > 0)
            {
                foreach($query as $item => $values)
                {
                    $data = array(
                        'header_id'                 => $header_id, 
                        'invoice_no'                => is_null($values->invoice_no) ? '' : $values->invoice_no,
                        'invoice_date'              => is_null($values->invoice_date) ? '0000-00-00' : $values->invoice_date, 
                        'faktur_name'               => is_null($values->faktur_name) ? '' : $values->faktur_name,
                        'faktur_date'               => is_null($values->faktur_date) ? '0000-00-00' : $values->faktur_date, 
                        'dpp'                       => is_null($values->dpp) ? 0 : $values->dpp,
                        'ppn'                       => is_null($values->ppn) ? 0 : $values->ppn, 
                        'total'                     => is_null($values->total) ? 0 : $values->total,
                        'rec_user_create'           => $username,
                        'rec_datetime_create'       => $date_time,
                        'rec_user_update'           => $username,
                        'rec_datetime_update'       => $date_time,
                        'created_at'                => $date_time,
                        'updated_at'                => $date_time,
                    );
                    DB::table($this->table_trx_coi_dtl)->insert($data);
                }
            }

            // 3. Insert ke sub detail
            $string = "SELECT
                            invoice_no,
                            invoice_date,
                            rdi_no,
                            rdi_date
                       FROM
                            ".$this->table_trx_coi_tmp."
                       WHERE
                            vendor_id = '".Session::get('sess_vendor_id')."' 
                       GROUP BY
                            invoice_no,
                            invoice_date,
                            rdi_no,
                            rdi_date";
            $query = DB::select(preg_replace("/\r\n|\r|\n/", '', $string));
            $count_record = count($query);
            if ($count_record > 0)
            {
                foreach($query as $item => $values)
                {
                    $data = array(
                        'header_id'                 => $header_id, 
                        'invoice_no'                => is_null($values->invoice_no) ? '' : $values->invoice_no,
                        'rdi_no'                    => is_null($values->rdi_no) ? '' : $values->rdi_no,
                        'rdi_date'                  => is_null($values->rdi_date) ? '0000-00-00' : $values->rdi_date,
                        'rec_user_create'           => $username,
                        'rec_datetime_create'       => $date_time,
                        'rec_user_update'           => $username,
                        'rec_datetime_update'       => $date_time,
                        'created_at'                => $date_time,
                        'updated_at'                => $date_time,
                    );
                    DB::table($this->table_trx_coi_sub_dtl)->insert($data);

                    $data = array(
                        'Vendor_Id'                 => $vendor_id,
                        'Vendor_Code'               => Session::get('sess_vendor_code'),
                        'Invoice_No'                => is_null($values->invoice_no) ? 0 : $values->invoice_no,
                        'No_RDI'                    => is_null($values->rdi_no) ? '' : $values->rdi_no,
                    );
                    DB::connection('sqlsrv_dwasys_dwa3')->table('TTrxDtl_Pur_COI_Inves')->insert($data);
                }
            }            
            
            DB::table($this->table_trx_coi_tmp)->where('vendor_id', '=', $vendor_id)->delete();

            //DB::commit();

            return response()->json([
                'success'       => true, 
                'message'       => 'Sukses memproses pembuatan Certificate of Invoice baru', 
                'coi_id'        => $header_id,
                'coi_no'        => $coi_no,
            ]);
        }
        catch (\Exception $e)
        {
            //DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => $e.'<br>Rollback Transaction !!!'
            ]);
        }
    }
    /* CRUD - End */

    /* Get Data - Begin */
    public function get_data_plo()
    {
        $string = "SELECT 
                      A.SysId_PLO AS SysId,
                      C.PO_No AS PO_No,
                      C.PO_Date AS PO_Date
                  FROM
                      TTrxhdr_Pur_ReleaseDeliveryInstruction A
                      LEFT OUTER JOIN QView_Pur_OutstandingRDIInQty B ON A.DI_No = B.DOCNUM
                      INNER JOIN TTrxhdr_Pur_PlaneOrder C ON A.SysId_PLO = C.SysId
                  WHERE
                      A.Vendor_Id = '".Session::get('sess_vendor_id')."'
                      AND B.DOCNUM IS NULL
                      AND A.DI_No NOT IN (SELECT No_RDI FROM TTrxDtl_Pur_COI_Inves WHERE Vendor_Id = '".Session::get('sess_vendor_id')."')
                  GROUP BY
                      A.SysId_PLO,
                      C.PO_No,
                      C.PO_Date
                  ORDER BY
                      C.PO_Date DESC";
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->select(preg_replace("/\r\n|\r|\n/", '', $string));
        return $query;
    }

    public function get_data_rdi($plo_id)
    {
        $string = "SELECT
                        A.SysId_PLO,
                        A.SysId AS SysId_RDI,
                        A.DI_No AS No_RDI,
                        A.DI_Date AS Tanggal_RDI,
                        SUM(C.Total) AS DPP, SUM(C.Total) * 0.1 AS PPN
                   FROM
                        TTrxhdr_Pur_ReleaseDeliveryInstruction A
                        LEFT OUTER JOIN QView_Pur_OutstandingRDIInQty B ON A.DI_No = B.DOCNUM
                        LEFT OUTER JOIN QView_Pur_RDI_Dtl_Inves C ON A.DI_No = C.No_RDI
                   WHERE
                        A.Vendor_Id = '".Session::get('sess_vendor_id')."'
                        AND B.DOCNUM IS NULL
                        AND A.DI_No NOT IN (SELECT No_RDI FROM TTrxDtl_Pur_COI_Inves WHERE Vendor_Id = '".Session::get('sess_vendor_id')."')  
                        AND A.SysId_PLO = '".$plo_id."'
                   GROUP BY 
                        A.SysId_PLO,
                        A.SysId, 
                        A.DI_No, 
                        A.DI_Date
                   ORDER BY
                        A.DI_Date,
                        A.DI_No";
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->select(preg_replace("/\r\n|\r|\n/", '', $string));        
        return $query;
    }

    public function scan_faktur_pajak(Request $request)
    {
        // $xml = simplexml_load_file('http://svc.efaktur.pajak.go.id/validasi/faktur/925594681085000/0082083525236/3031300D0609608648016503040201050004209418837600788E0019770BFC4B000E6478BFF0B4790FB1B156FA3D071EF697E2'); // fix, 2 item
        // http://svc.efaktur.pajak.go.id/validasi/faktur/925594681085000/0082083525236/3031300D0609608648016503040201050004209418837600788E0019770BFC4B000E6478BFF0B4790FB1B156FA3D071EF697E2
        // http://svc.efaktur.pajak.go.id/validasi/faktur/020535019043000/0072003713041/3031300D0609608648016503040201050004209FC0419612641A006D8909AC4EC3AFE4DDD46B2B80082295AEBA4D0817CF58DE // salah, 1 item
        // http://svc.efaktur.pajak.go.id/validasi/faktur/925594681085000/0082083525235/3031300D0609608648016503040201050004207C0D3BC83721FBB2D02FA40C03F56382FFC79D1B8F05011D076D8A6D5597B14F // salah, 1 item

        $link       = $request->link;
        $xml        = simplexml_load_file($request->link);

        $json_data  = array(
                        "success"       => true,  
                        "message"       => 'success', 
                        "data"          => $xml,
                    );

        echo json_encode($json_data);
    }

    public function get_detail_invoice_tmp($invoice_no)
    {
        $query = DB::table($this->table_trx_coi_tmp)
                        ->select('rdi_no', 'rdi_date')
                        ->where('vendor_id', '=', Session::get('sess_vendor_id'))
                        ->where('invoice_no', '=', $invoice_no)
                        ->groupBy('rdi_no', 'rdi_date')
                        ->orderByDesc('rdi_date')
                        ->orderByDesc('rdi_no')
                        ->get();
        return $query;
    }

    public function get_detail_rdi($sysid_rdi)
    {
        // Asumsi, item RDI tidak lebih dari 100
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->table($this->view_trx_rdi_dtl)
                        ->where('SysId_RDI', '=', $sysid_rdi)
                        ->limit(100)
                        ->get();
        return $query;
    }

    public function print_certificate_of_invoice($coi_id)
    {
        /* Data Header */
        $query_hdr          = DB::table($this->table_trx_coi_hdr)
                                    ->where('id', $coi_id)
                                    ->first();                                                
        $data_hdr = array(
            'coi_no'                => is_null($query_hdr->certificate_no) || $query_hdr->certificate_no == '' ? '-' : $query_hdr->certificate_no,
            'coi_date'              => is_null($query_hdr->certificate_date) || $query_hdr->certificate_date == '' ? '-' : date_format(date_create($query_hdr->certificate_date), 'd-M-Y'),
            'vendor_code'           => is_null($query_hdr->vendor_code) || $query_hdr->vendor_code == '' ? '-' : $query_hdr->vendor_code,
            'vendor_name'           => is_null($query_hdr->vendor_name) || $query_hdr->vendor_name == '' ? '-' : $query_hdr->vendor_name,
            'vendor_npwp'           => is_null($query_hdr->vendor_npwp) || $query_hdr->vendor_npwp == '' ? '-' : $query_hdr->vendor_npwp,
            'plo_no'                => is_null($query_hdr->plo_no) || $query_hdr->plo_no == '' ? '-' : $query_hdr->plo_no,
        );

        /* Data Detail */
        $data_dtl           = DB::table($this->table_trx_coi_dtl)
                                    ->where('header_id', $coi_id)
                                    ->get();

        /* Data Sub Detail */
        $data_sub_dtl       = DB::table($this->table_trx_coi_sub_dtl)
                                    ->where('header_id', $coi_id)
                                    ->get();

        $file               = public_path('qr-code/' . $query_hdr->certificate_no . '.png');
        $generate_qrcode    = \QRCode::text($query_hdr->certificate_no)->setOutfile($file)->png();
        $source             = $file;

        $pdf = \PDF::loadView('report.certificate-of-invoice', [
            'data_hdr'      => $data_hdr,
            'data_dtl'      => $data_dtl,
            'data_sub_dtl'  => $data_sub_dtl,
            'qrcode'        => $source,
        ])->setPaper('A4', 'potrait');

        return $pdf->stream('print_out_certificate_of_invoice.pdf');
    }
    /* Get Data - End */
}
