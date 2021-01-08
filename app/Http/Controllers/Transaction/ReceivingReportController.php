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

class ReceivingReportController extends Controller
{	
    private $table_mst_vendor;
    private $table_mst_vendor_address;
    private $table_mst_address_type;
    private $table_mst_vendor_person;
    private $table_mst_price_vpn;

    private $table_trx_rdi_hdr;
    private $table_trx_rdi_dtl;
	private $table_trx_rr_hdr;
    private $table_trx_rr_dtl;

	private $view_trx_rdi_vs_gr_outstanding_hdr;
	private $view_trx_rdi_vs_gr_outstanding_dtl;

    private $trx_name_receiving_report;
	private $format_date_to_display_1;
    private $format_date_to_insert_1;

	public function __construct()
	{	
        $this->table_mst_vendor                     = InvesHelper::TABLE_MST_VENDOR;
        $this->table_mst_vendor_address             = InvesHelper::TABLE_MST_VENDOR_ADDRESS;
        $this->table_mst_address_type               = InvesHelper::TABLE_MST_ADDRESS_TYPE;
        $this->table_mst_vendor_person              = InvesHelper::TABLE_MST_VENDOR_PERSON;
        $this->table_mst_price_vpn                  = InvesHelper::TABLE_MST_PRICE_VPN;
        $this->table_trx_rdi_hdr                    = InvesHelper::TABLE_TRX_RDI_HDR;
        $this->table_trx_rdi_dtl                    = InvesHelper::TABLE_TRX_RDI_DTL;
        $this->table_trx_rr_hdr 					= InvesHelper::TABLE_TRX_RR_HDR;
        $this->table_trx_rr_dtl                     = InvesHelper::TABLE_TRX_RR_DTL;
        $this->view_trx_rdi_vs_gr_outstanding_hdr	= InvesHelper::QUERY_TRX_OS_RDI_GR_HDR;
        $this->view_trx_rdi_vs_gr_outstanding_dtl	= InvesHelper::QUERY_TRX_OS_RDI_GR_DTL;
        $this->trx_name_receiving_report            = InvesHelper::TRX_NAME_RECEIVING_REPORT;
        $this->format_date_to_display_1 			= InvesHelper::FORMAT_DATE_TO_DISPLAY_1;
        $this->format_date_to_insert_1              = InvesHelper::FORMAT_DATE_TO_INSERT_1;
    }

    /* Show Page - Begin */
    public function index()
    {    	
        return view('transaction.receiving-report-list');
    }

    public function input_receiving_report()
    {
    	$os_gr = DB::connection('sqlsrv_dwasys_dwa3')
    					->select(DB::raw("SELECT * 
    						              FROM " . $this->view_trx_rdi_vs_gr_outstanding_hdr . " 
    						              WHERE Vendor_Id = :var_vendor_id 
    						              ORDER BY DI_Date DESC, DI_No DESC"), array('var_vendor_id' => Session::get('sess_vendor_id')));
        return view('transaction.receiving-report-input', compact('os_gr'));
    }
    /* Show Page - End */

    /* List Data - Begin */
    public function list_receiving_report_hdr(Request $request)
    {
        $columns        = array( 
                                0   => 'id', 
                                1   => 'DT_RowIndex',
                                2   => 'rr_no',
                                3   => 'rr_date',
                                4   => 'rdi_no',
                                5   => 'rdi_date',
                                6   => 'delivery_date',
                                7   => 'action',
                          );
        $totalData      = DB::table($this->table_trx_rr_hdr)
                                ->whereRaw("vendor_id = ?", [Session::get('sess_vendor_id')])
                                ->count();
        $totalFiltered  = $totalData;
        $limit          = $request->input('length');
        $start          = $request->input('start');
        $order          = $columns[$request->input('order.0.column')];
        $dir            = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
            $posts = DB::table($this->table_trx_rr_hdr)
                            ->offset($start)
                            ->limit($limit)
                            ->whereRaw("vendor_id = ?", [Session::get('sess_vendor_id')])
                            ->orderByDesc('rr_date')
                            ->orderByDesc('rr_no')
                            ->get();
        }
        else
        {
            $search         = $request->input('search.value');
            $posts          =  DB::table($this->table_trx_rr_hdr)
                                    ->offset($start)
                                    ->limit($limit)
                                    ->whereRaw("rr_no LIKE '%{$search}%' AND vendor_id = ?", [Session::get('sess_vendor_id')])
                                    ->orWhereRaw("rdi_no LIKE '%{$search}%' AND vendor_id = ?", [Session::get('sess_vendor_id')])
                                    ->orderByDesc('rr_date')
                                    ->orderByDesc('rr_no')
                                    ->get();
            $totalFiltered  = DB::table($this->table_trx_rr_hdr)
                                    ->whereRaw("rr_no LIKE '%{$search}%' AND vendor_id = ?", [Session::get('sess_vendor_id')])
                                    ->orWhereRaw("rdi_no LIKE '%{$search}%' AND vendor_id = ?", [Session::get('sess_vendor_id')])
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
                $nestedData['rr_no']               		= $post->rr_no;
                $nestedData['rr_date']             		= date($this->format_date_to_display_1,strtotime($post->rr_date));
                $nestedData['rdi_no']   				= $post->rdi_no;
                $nestedData['rdi_date']             	= date($this->format_date_to_display_1,strtotime($post->rdi_date));
                $nestedData['delivery_date']            = date($this->format_date_to_display_1,strtotime($post->delivery_date));
                $nestedData['action']                   = "<a href='javascript:void(0)' id='print_rr' data-toggle='tooltip' title='Print' data-id='$post->id' data-original-title='Print' class='print btn btn-success btn-sm'><i class='fas fa-print'></i>Print</a>";
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
    /* List Data - End */

    /* CRUD - Begin */
    public function store_receiving_report(Request $request)
    {  
        $username               = Session::get('sess_username'); 
        $date_time              = new DateTime;
        
        // Header variable
        $rr_id                  = $request->id_rr;
        $rr_date                = date($this->format_date_to_insert_1, strtotime($request->tgl_rr));
        $rdi_no                 = $request->cbo_nomor_rdi;
        $rdi_date               = date($this->format_date_to_insert_1, strtotime($request->tgl_rdi));
        $sj_no                  = $request->no_sj_vendor;
        $sj_date                = date($this->format_date_to_insert_1, strtotime($request->tgl_sj_vendor));
        $delivery_date          = date($this->format_date_to_insert_1, strtotime($request->tgl_pengiriman));
        $remarks_hdr            = $request->keterangan;
        $rec_user_create        = $username;
        $rec_datetime_create    = $date_time;
        $rec_user_upate         = $username;
        $rec_datetime_update    = $date_time;

        $year                   = date("yy", strtotime($rr_date));
        $month                  = date("m", strtotime($rr_date));

        /* Dapatkan informasi vendor */
        $vendor_id      = 0;
        $vendor_code    = '';
        $vendor_name    = '';
        $vendor_npwp    = '';
        $vendor_top     = 0;
        $vendor_is_ppn  = 0;
        $vendor_pic     = '';
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->table($this->table_mst_vendor)
                        ->where('SysId', Session::get('sess_vendor_id'))
                        ->get();
        $count_record = count($query);
        if ($count_record > 0)
        {
            foreach($query as $item => $values)
            {
                $vendor_id      = is_null($values->SysId) ? 0 : $values->SysId;
                $vendor_code    = is_null($values->Vendor_Code) ? '' : $values->Vendor_Code;
                $vendor_name    = is_null($values->Vendor_Name) ? '' : $values->Vendor_Name;
                $vendor_npwp    = is_null($values->NPWP) ? '' : $values->NPWP;
                $vendor_top     = is_null($values->TOP) ? 0 : $values->TOP;
                $vendor_is_ppn  = is_null($values->IsPPN) ? 0 : $values->IsPPN;
                $vendor_pic     = is_null($values->PIC) ? '' : $values->PIC;
            }
        }

        /* Dapatkan informasi alamat */
        $vendor_phone               = '';
        $vendor_fax                 = '';
        $vendor_email               = '';
        $vendor_address_type_id     = 0;
        $vendor_address_type_name   = '';
        $vendor_address_title       = '';
        $vendor_address_id          = 0;
        $vendor_address             = '';
        $vendor_address_city        = '';
        $vendor_postal_code         = '';
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->table($this->table_mst_vendor_address)
                        ->join($this->table_mst_address_type, $this->table_mst_vendor_address.'.AddressType_Id', '=', $this->table_mst_address_type.'.SysId')
                        ->select(
                            $this->table_mst_vendor_address.'.Phone AS Phone',
                            $this->table_mst_vendor_address.'.Fax AS Fax',
                            $this->table_mst_vendor_address.'.Email AS Email',
                            $this->table_mst_vendor_address.'.AddressType_Id AS AddressType_Id',
                            $this->table_mst_address_type.'.AddressType_Name AS AddressType_Name',
                            $this->table_mst_vendor_address.'.Address_Title AS Address_Title',
                            $this->table_mst_vendor_address.'.SysId AS Address_Id',
                            $this->table_mst_vendor_address.'.Address AS Address',
                            $this->table_mst_vendor_address.'.City AS City',
                            $this->table_mst_vendor_address.'.Postal_Code AS Postal_Code'
                        )
                        ->where([
                            [$this->table_mst_vendor_address.'.Vendor_Id', '=', Session::get('sess_vendor_id')],
                            [$this->table_mst_vendor_address.'.AddressType_Id', '=', 3]
                        ])
                        ->get();
        $count_record = count($query);
        if ($count_record > 0)
        {
            foreach($query as $item => $values)
            {
                $vendor_phone               = is_null($values->Phone) ? '' : $values->Phone;
                $vendor_fax                 = is_null($values->Fax) ? '' : $values->Fax;
                $vendor_email               = is_null($values->Email) ? '' : $values->Email;
                $vendor_address_type_id     = is_null($values->AddressType_Id) ? 0 : $values->AddressType_Id;
                $vendor_address_type_name   = is_null($values->AddressType_Name) ? '' : $values->AddressType_Name;
                $vendor_address_title       = is_null($values->Address_Title) ? '' : $values->Address_Title;
                $vendor_address_id          = is_null($values->Address_Id) ? 0 : $values->Address_Id;
                $vendor_address             = is_null($values->Address) ? '' : $values->Address;
                $vendor_address_city        = is_null($values->City) ? '' : $values->City;
                $vendor_postal_code         = is_null($values->Postal_Code) ? '' : $values->Postal_Code;
            }
        }

        /* Dapatkan informasi contact person vendor */
        $vendor_person_id       = 0;
        $vendor_person_name     = '';
        $vendor_person_position = '';
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->table($this->table_mst_vendor_person)
                        ->where('Address_Id', $vendor_address_id)
                        ->orderBy('SysId', 'DESC')
                        ->take(1)
                        ->get();
        $count_record = count($query);
        if ($count_record > 0)
        {
            foreach($query as $item => $values)
            {
                $vendor_person_id       = is_null($values->SysId) ? 0 : $values->SysId;
                $vendor_person_name     = is_null($values->Name) ? '' : $values->Name;
                $vendor_person_position = is_null($values->Position) ? '' : $values->Position;
            }
        }

        /* Dapatkan informasi Release DI */
        $currency   = '';
        $rate       = 0;
        $query = DB::connection('sqlsrv_dwasys_dwa3')
                        ->table($this->table_trx_rdi_hdr)
                        ->where('DI_No', $rdi_no)
                        ->get();
        $count_record = count($query);
        if ($count_record > 0)
        {
            foreach($query as $item => $values)
            {
                $currency   = is_null($values->Type_Currency) ? '' : $values->Type_Currency;
                $rate       = is_null($values->Rate_Currency) ? 0 : $values->Rate_Currency;
            }
        }

        //DB::beginTransaction();

        try
        {
            $rr_hdr                             = new ReceivingReportHdrModel();

            $last_doc_no                        = InvesHelper::create_doc_no($this->trx_name_receiving_report, $month, $year);
            $rr_no                              = "RRX-" .
                                                  InvesHelper::right($year, 2) . $month . "-" .
                                                  InvesHelper::right("0000" . $last_doc_no, 4);

            $rr_hdr->rr_no                      = $rr_no;
            $rr_hdr->rr_date                    = $rr_date;
            $rr_hdr->rr_time                    = date("H:i:s");
            $rr_hdr->rdi_no                     = $rdi_no;
            $rr_hdr->rdi_date                   = $rdi_date;
            $rr_hdr->delivery_date              = $delivery_date;
            $rr_hdr->sj_no                      = $sj_no;
            $rr_hdr->sj_date                    = $sj_date;
            $rr_hdr->vendor_id                  = $vendor_id;
            $rr_hdr->vendor_code                = $vendor_code;
            $rr_hdr->vendor_name                = $vendor_name;
            $rr_hdr->vendor_npwp                = $vendor_npwp;
            $rr_hdr->vendor_top                 = $vendor_top;
            $rr_hdr->vendor_is_ppn              = $vendor_is_ppn;
            $rr_hdr->vendor_pic                 = $vendor_pic;
            $rr_hdr->vendor_phone               = $vendor_phone;
            $rr_hdr->vendor_fax                 = $vendor_fax;
            $rr_hdr->vendor_email               = $vendor_email;
            $rr_hdr->vendor_address_type_id     = $vendor_address_type_id;
            $rr_hdr->vendor_address_type_name   = $vendor_address_type_name;
            $rr_hdr->vendor_address_title       = $vendor_address_title;
            $rr_hdr->vendor_address_id          = $vendor_address_id;
            $rr_hdr->vendor_address             = $vendor_address;
            $rr_hdr->vendor_address_city        = $vendor_address_city;
            $rr_hdr->vendor_postal_code         = $vendor_postal_code;
            $rr_hdr->vendor_person_id           = $vendor_person_id;
            $rr_hdr->vendor_person_name         = $vendor_person_name;
            $rr_hdr->vendor_person_position     = $vendor_person_position;
            $rr_hdr->currency                   = $currency;
            $rr_hdr->rate                       = $rate;
            $rr_hdr->remark                     = $remarks_hdr;
            $rr_hdr->flag_rr                    = 1;
            $rr_hdr->rec_user_create            = $username;
            $rr_hdr->rec_datetime_create        = $date_time;
            $rr_hdr->rec_user_upate             = $username;
            $rr_hdr->rec_datetime_update        = $date_time;

            $saved_rr_hdr = $rr_hdr->save();

            if ($saved_rr_hdr == true)
            {
                $header_id  = $rr_hdr->id;                

                // Cari SysId RDI
                $rdi_id   = 0;
                $query = DB::connection('sqlsrv_dwasys_dwa3')
                                ->table($this->table_trx_rdi_hdr)
                                ->where('DI_No', $rdi_no)
                                ->get();
                $count_record = count($query);
                if ($count_record > 0)
                {
                    foreach($query as $item => $values)
                    {
                        $rdi_id = is_null($values->SysId) ? 0 : $values->SysId;
                    }
                }

                // Save detail
                $chk_select     = $request->input('chk_select', []);
                $part_number    = $request->input('part_number', []);
                $vpn_id         = $request->input('vpn_id', []);
                $pn_id          = $request->input('pn_id', []);
                $part_name      = $request->input('part_name', []);
                $satuan         = $request->input('satuan', []);
                $qty_rr_input   = $request->input('qty_rr_input', []);
                $qty_rr_max     = $request->input('qty_rr_max', []);

                for ($a = 0; $a < count($chk_select); $a++)
                {
                    $x = $chk_select[$a];

                    if (InvesHelper::to_float_value($qty_rr_input[$x]) > InvesHelper::to_float_value($qty_rr_max[$x]))
                    {
                        return response()->json([
                            'success'       => false, 
                            'message'       => 'Qty input part number '.$part_number[$x].' melebihi qty max !!!', 
                            'rr_id'         => '',
                            'rr_no'         => '',
                        ]);
                        exit();
                    }
                }

                for ($a = 0; $a < count($chk_select); $a++)
                {
                    $x = $chk_select[$a];

                    $rr_dtl = new ReceivingReportDtlModel();

                    // Cari SysId Price
                    $price_id   = 0;
                    $query = DB::connection('sqlsrv_dwasys_dwa3')
                                    ->table($this->table_trx_rdi_dtl)
                                    ->where([
                                        ['SysId_Hdr', '=', (int)$rdi_id],
                                        ['SysId_VPN', '=', (int)$vpn_id[$x]],
                                    ])
                                    ->get();
                    $count_record = count($query);
                    if ($count_record > 0)
                    {
                        foreach($query as $item => $values)
                        {
                            $price_id = is_null($values->SysId_Price) ? 0 : $values->SysId_Price;
                        }
                    }

                    // Cari Price
                    $price   = 0;
                    $query = DB::connection('sqlsrv_dwasys_dwa3')
                                    ->table($this->table_mst_price_vpn)
                                    ->where([
                                        ['SysId', '=', $price_id],
                                    ])
                                    ->get();
                    $count_record = count($query);
                    if ($count_record > 0)
                    {
                        foreach($query as $item => $values)
                        {
                            $price = is_null($values->Price) ? 0 : $values->Price;
                        }
                    }

                    $rr_dtl->header_id              = $header_id;
                    $rr_dtl->vpn_id                 = $vpn_id[$x];
                    $rr_dtl->pn_id                  = $pn_id[$x];
                    $rr_dtl->pn_number              = $part_number[$x];
                    $rr_dtl->pn_name                = $part_name[$x];
                    $rr_dtl->unit_name              = $satuan[$x];
                    $rr_dtl->qty_rr                 = InvesHelper::to_float_value($qty_rr_input[$x]);
                    $rr_dtl->price_id               = $price_id;
                    $rr_dtl->price                  = $price;
                    $rr_dtl->rec_user_create        = $username;
                    $rr_dtl->rec_datetime_create    = $date_time;
                    $rr_dtl->rec_user_upate         = $username;
                    $rr_dtl->rec_datetime_update    = $date_time;

                    $rr_dtl->save();
                }
                
                //DB::commit();
                
                return response()->json([
                    'success'       => true, 
                    'message'       => 'Sukses memproses pembuatan RR baru', 
                    'rr_id'         => $header_id,
                    'rr_no'         => $rr_no,
                ]);
            }
            else
            {
                return response()->json([
                    'success' => false, 
                    'message' => 'Error proses pembuatan RR baru'
                ]);
            }
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
    public function get_rdi_gr_os_detail($rdi_id)
    {
        $query = DB::connection('sqlsrv_dwasys_dwa3')
        				->table($this->view_trx_rdi_vs_gr_outstanding_dtl)
                        ->where([['SysId', '=', (int)$rdi_id]])
                        ->get();
        return $query;
    }

    public function print_receiving_report($rr_id)
    {
        /* Data Header */
        $query_hdr          = DB::table($this->table_trx_rr_hdr)
                                    ->where('id', $rr_id)
                                    ->first();                                                
        $data_hdr = array(
            'rr_no'                 => is_null($query_hdr->rr_no) || $query_hdr->rr_no == '' ? '-' : $query_hdr->rr_no,
            'rr_date'               => is_null($query_hdr->rr_date) || $query_hdr->rr_date == '' ? '-' : date_format(date_create($query_hdr->rr_date), 'd-M-Y'),
            'rdi_no'                => is_null($query_hdr->rdi_no) || $query_hdr->rdi_no == '' ? '-' : $query_hdr->rdi_no,
            'rdi_date'              => is_null($query_hdr->rdi_date) || $query_hdr->rdi_date == '' ? '-' : date_format(date_create($query_hdr->rdi_date), 'd-M-Y'),
            'delivery_date'         => is_null($query_hdr->delivery_date) || $query_hdr->delivery_date == '' ? '-' : date_format(date_create($query_hdr->delivery_date), 'd-M-Y'),
            'vendor_name'           => is_null($query_hdr->vendor_name) || $query_hdr->vendor_name == '' ? '-' : $query_hdr->vendor_name,
            'vendor_address'        => is_null($query_hdr->vendor_address) || $query_hdr->vendor_address == '' ? '-' : $query_hdr->vendor_address,
            'vendor_address_city'   => is_null($query_hdr->vendor_address_city) || $query_hdr->vendor_address_city == '' ? '-' : $query_hdr->vendor_address_city,
            'vendor_person_name'    => is_null($query_hdr->vendor_person_name) || $query_hdr->vendor_person_name == '' ? '-' : $query_hdr->vendor_person_name,
            'vendor_phone'          => is_null($query_hdr->vendor_phone) || $query_hdr->vendor_phone == '' ? '-' : $query_hdr->vendor_phone,
            'vendor_fax'            => is_null($query_hdr->vendor_fax) || $query_hdr->vendor_fax == '' ? '-' : $query_hdr->vendor_fax,
        );

        /* Data Detail */
        $data_dtl           = DB::table($this->table_trx_rr_dtl)
                                    ->where('header_id', $rr_id)
                                    ->get();

        $file               = public_path('qr-code/' . $query_hdr->rr_no . '.png');
        $generate_qrcode    = \QRCode::text($query_hdr->rr_no)->setOutfile($file)->png();
        $source             = $file;

        $pdf = \PDF::loadView('report.reveiving-report', [
            'data_hdr'      => $data_hdr,
            'data_dtl'      => $data_dtl,
            'qrcode'        => $source,
        ])->setPaper('A4', 'potrait');

        return $pdf->stream('print_out_receiving_report.pdf');
    }
    /* Get Data - End */

}
