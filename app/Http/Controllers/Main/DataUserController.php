<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\InvesHelper;
use Illuminate\Support\Str;
use App\Models\Master\UserModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

use DB;
use DateTime;
use DataTables;
use Redirect, Response;

class DataUserController extends Controller
{
    public function __construct()
    {
        $this->table_mst_vendor                         = InvesHelper::TABLE_MST_VENDOR;
        $this->table_mst_vendor_address                 = InvesHelper::TABLE_MST_VENDOR_ADDRESS;
        $this->table_mst_address_type                   = InvesHelper::TABLE_MST_ADDRESS_TYPE;
        $this->table_mst_vendor_person                  = InvesHelper::TABLE_MST_VENDOR_PERSON;
        $this->table_mst_price_vpn                      = InvesHelper::TABLE_MST_PRICE_VPN;
        $this->table_trx_rdi_hdr                        = InvesHelper::TABLE_TRX_RDI_HDR;
        $this->table_trx_rdi_dtl                        = InvesHelper::TABLE_TRX_RDI_DTL;
        $this->table_trx_rr_hdr                         = InvesHelper::TABLE_TRX_RR_HDR;
        $this->table_trx_rr_dtl                         = InvesHelper::TABLE_TRX_RR_DTL;
        $this->view_trx_rdi_vs_gr_outstanding_hdr       = InvesHelper::QUERY_TRX_OS_RDI_GR_HDR;
        $this->view_trx_rdi_vs_gr_outstanding_dtl       = InvesHelper::QUERY_TRX_OS_RDI_GR_DTL;
        $this->trx_name_receiving_report                = InvesHelper::TRX_NAME_RECEIVING_REPORT;
        $this->format_date_to_display_1                 = InvesHelper::FORMAT_DATE_TO_DISPLAY_1;
        $this->format_date_to_insert_1                  = InvesHelper::FORMAT_DATE_TO_INSERT_1;
    }
    protected $table = "users";

    public function index()
    {
        return view('menu.data-user');
    }

    public function data_user(Request $request)
    {
        // Menu Edit Table User
        // <a style="width:85px;font-size:14px;font-weight:bold" href="javascript:void(0)" id="edit_user" data-toggle="tooltip" title="Edit" data-id="{{ $id }}" data-original-title="Edit" class="Edit btn btn-warning btn-sm">Edit &nbsp;<i class="fa fa-cog" aria-hidden="true"></i></a>
        $query = UserModel::all();
        return datatables()->of($query)
            ->addColumn('action', '<a style="width:85px;font-size:14px;font-weight:bold" href="javascript:void(0)" id="hapus_user" data-toggle="tooltip" title="Hapus" data-id="{{ $id }}" data-original-title="Hapus" class="revisi btn btn-danger btn-sm">Hapus &nbsp;<i class="fas fa-window-close"></i></a>')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function add_data()
    {
        $data_vendor = DB::connection('sqlsrv_dwasys_dwa3')
            ->select(DB::raw("SELECT * FROM " . $this->table_mst_vendor));
        return view('menu.tambah-data-user', compact('data_vendor'));
    }

    public function setting_profile()
    {
        $query = UserModel::where('username', Session::get('sess_username'))->first();
        $vendor_name    = $query->vendor_name;
        $username       = $query->username;
        $password       = $query->passnoen;
        $email          = $query->email;
        return view('menu.setting-user', ['vendor_name' => $vendor_name, 'username' => $username, 'password' => $password, 'email' => $email]);
    }

    public function change_password()
    {
        $query = UserModel::where('username', Session::get('sess_username'))->first();
        $username       = $query->username;
        $password       = $query->passnoen;
        return view('menu.change-password-user', ['username' => $username, 'password' => $password]);
    }

    public function update_password(Request $request)
    {
        $query = UserModel::where('username', Session::get('sess_username'))->first();
        if ($request->password <> $query->passnoen) {
            return redirect("/setting-profile/change-password")->with('alert-null', 'Password Lama Anda salah');
        } elseif (strlen($request->newpassword) < 6) {
            return redirect('/setting-profile/change-password')->with('alert-length', 'Password Minimal 6 Karakter');
        } elseif ($request->newpassword <> $request->repeatpassword) {
            return redirect('/setting-profile/change-password')->with('alert-nosame', 'Password Password Baru dan Ulangi Password Tidak Sama');
        } else {
            $date_time = new DateTime;
            UserModel::where('username', Session::get('sess_username'))->update([
                'passnoen'      => $request->newpassword,
                'updated_at'    => $date_time
            ]);
            // alihkan halaman ke halaman pegawai
            return redirect('/setting-profile')->with('alert-update', 'Password Berhasil Diubah');
        }
    }

    public function store_data(Request $request)
    {
        $datauser = UserModel::where('username', $request->username)->count();
        if ($datauser > 0) {
            return redirect("/menu-user/add_data_user")->with('alert-user', 'Username Sudah Terdaftar');
        } elseif (strlen($request->password) < 6) {
            return redirect("/menu-user/add_data_user")->with('alert-length', 'Password Minimal 6 Karakter');
        } else {
            $data                   = new UserModel();
            $data->vendor_id        = $request->vendor_id;          // Insert ID Supplier
            $data->vendor_code      = $request->vendor_code;        // Insert Code Supplier
            $data->vendor_name      = $request->vendor_name;        // Insert Nama Supplier
            $data->email            = $request->email;              // Insert email
            $data->username         = $request->username;           // Insert Username
            $data->password         = bcrypt($request->password);   // Insert Password
            $data->passnoen         = $request->password;           // Insert Password
            $data->jabatan          = "Supplier";                   // Insert Jabatan
            $data->RR               = $request->rr;
            $data->COI              = $request->coi;
            $data->remember_token   = Str::random(200);

            $data->save();
            return redirect("/menu-user")->with('alert-register', 'Data Supplier Berhasil Ditambahkan, Silahkan balas email kembali kepada supplier untuk memberi informasi penambahan akun');
        }
    }
    public function hapus_data_user($id)
    {
        $query = UserModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Error proses Reject Ecuti'
        ]);
    }

    public function edit_data_user($id)
    {
        $query = UserModel::where('id', $id)->first();
        $vendor_id      = $query->vendor_id;
        $vendor_code    = $query->vendor_code;
        $vendor_name    = $query->vendor_name;
        $jabatan        = $query->jabatan;
        $username       = $query->username;
        $email          = $query->email;
        $password       = $query->passnoen;
        $rr             = $query->RR;
        $coi            = $query->COI;

        $data_vendor = DB::connection('sqlsrv_dwasys_dwa3')->select(DB::raw("SELECT * FROM " . $this->table_mst_vendor));
        return view('menu.edit-data-user', ['data_vendor' => $data_vendor, 'vendor_id' => $vendor_id, 'vendor_code' => $vendor_code, 'vendor_name' => $vendor_name, 'jabatan' => $jabatan, 'username' => $username, 'password' => $password, 'email' => $email, 'id' => $id, 'rr' => $rr, 'coi' => $coi]);
    }
    public function update_data_user(Request $request)
    {
        $date_time = new DateTime;
        UserModel::where('id', $request->id)->update([
            'vendor_id'     => $request->company,
            'vendor_code'   => $request->vendor_code,
            'vendor_name'   => $request->vendor_name,
            'jabatan'       => $request->jabatan,
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => $request->password,
            'rr'            => $request->RR,
            'coi'           => $request->COI,
            'updated_at'    => $date_time
        ]);
        // alihkan halaman ke halaman pegawai
        return redirect('/menu-user')->with('alert-update', 'Data Berhasil Diubah');
    }
}
