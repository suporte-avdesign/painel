<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminAccess extends Model
{
    protected $fillable = [
        'admin_id',
        'last_ip',
        'last_url',
        'last_logout',
        'qty_visits'
    ];
}
