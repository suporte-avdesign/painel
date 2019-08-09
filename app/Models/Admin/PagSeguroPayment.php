<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PagSeguroPayment extends Model
{
    protected $table = 'payments_pagseguro';

    protected $fillable = [
        'order_id',
        'user_id',
        'brand',
        'card_number',
        'date_month',
        'date_year',
        'card_cvv',
        'parcels',
        'parcels_value',
        'reference',
        'code',
        'status',
        'status_label',
        'method_payment',
        'value',
        'date',
        'date_refersh_status'
    ];
}




