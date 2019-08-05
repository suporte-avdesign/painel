<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CompanyPayment extends Model
{
    protected $fillable = [
        'billet',
        'cash',
        'credit_card',
        'debit_card'
    ];
}
