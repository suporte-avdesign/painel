<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    protected $table = 'payment_card';

    protected $fillable = [
        'payment_company_id',
        'order_id',
        'user_id',
        'method_payment',
        'status',
        'status_label',
        'brand',
        'card_number',
        'date_month',
        'date_year',
        'card_cvv',
        'parcels',
        'parcels_value',
        'reference',
        'code',
        'value',
        'date',
        'date_refersh_status'
    ];
}



