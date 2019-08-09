<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'status',
        'status_label',
        'method_payment',
        'brand',
        'card_number',
        'parcels',
        'parcels_value',
        'reference',
        'code',
        'value',
        'link',
        'date',
        'date_refersh_status',
    ];
}
