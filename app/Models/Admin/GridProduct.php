<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GridProduct extends Model
{
    protected $fillable = [
        'product_id',
        'image_color_id',
        'kit',
        'color',
        'qty_min',
        'qty_max',
        'grid',
        'input',
        'output',
        'stock'
    ];

    public $timestamps = false;
}
