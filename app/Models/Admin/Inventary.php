<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Inventary extends Model
{
    protected $fillable = [
        'grid_product_id',
        'brand_id',
        'section_id',
        'category_id',
        'product_id',
        'type_movement',
        'amount',
        'kit',
        'cost_unit',
        'cost_total',
        'stok'
    ];

}
