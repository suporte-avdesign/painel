<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Inventary extends Model
{
    protected $fillable = [
        'admin_id',
        'user_id',
        'profile_name',
        'type_movement',
        'note',
        'brand',
        'section',
        'category',
        'product',
        'image',
        'code',
        'color',
        'grid',
        'amount',
        'kit',
        'kit_name',
        'units',
        'offer',
        'cost_unit',
        'cost_total',
        'price_profile',
        'price_unit',
        'price_total',
        'form_payment',
        'stock'
    ];






}
