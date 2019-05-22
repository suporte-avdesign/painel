<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = [
        'product_id',
        'image_color_id',
        'attribute_color',
        'attribute_size',
        'stock'
    ];

}
