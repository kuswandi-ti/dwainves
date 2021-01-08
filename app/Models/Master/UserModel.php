<?php

namespace App\Models\Master;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';

    use Notifiable;

    protected $fillable = [
        'id', 'username', 'password', 'email', 'email_verified', 'vendor_id', 'vendor_code',
        'vendor_name', 'jabatan', 'RR', 'COI', 'remember_token', 'created_at', 'updated_at'
    ];
}
