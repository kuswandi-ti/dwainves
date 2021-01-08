<?php

namespace App\Models\Transaction;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Helper\InvesHelper;

class ReceivingReportDtlModel extends Model
{
    protected $table = InvesHelper::TABLE_TRX_RR_DTL;

    use Notifiable;

    protected $fillable = [
        'id','header_id','vpn_id','pn_id','pn_number','pn_name','unit_name','qty_rr','price_id',
        'price','rec_user_create','rec_datetime_create','rec_user_upate','rec_datetime_update'
    ];
}
