<?php

namespace App\Models\Transaction;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Helper\InvesHelper;

class ReceivingReportHdrModel extends Model
{
    protected $table = InvesHelper::TABLE_TRX_RR_HDR;

    use Notifiable;

    protected $fillable = [
        'id','rr_no','rr_date','rr_time','rdi_no','rdi_date','delivery_date','do_retur_no','sj_no',
        'sj_date','vendor_id','vendor_code','vendor_name','vendor_npwp','vendor_top','vendor_is_ppn',
        'vendor_pic','vendor_phone','vendor_fax','vendor_email','vendor_address_type_id','vendor_address_type_name',
        'vendor_address_title','vendor_address_id','vendor_address','vendor_address_city','vendor_postal_code',
        'vendor_person_id','vendor_person_name','vendor_person_position','currency','rate','remark',
        'flag_print','count_print','flag_rr','rec_user_create','rec_datetime_create','rec_user_upate',
        'rec_datetime_update'
    ];
}
