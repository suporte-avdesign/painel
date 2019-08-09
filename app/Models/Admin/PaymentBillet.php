<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PaymentBillet extends Model
{
    protected $fillable = [
        'payment_company_id',
        'order_id',
        'user_id',
        'method_payment',
        'status',
        'status_label',
        'reference',
        'code',
        'value',
        'link',
        'date',
        'date_refersh_status',
    ];
}