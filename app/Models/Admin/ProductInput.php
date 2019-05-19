<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductInput extends Model
{
    protected $fillable = [
        'image_color_id',
        'product_attribute_id',
        'amount'
    ];

    public function color()
    {
        return $this->belongsTo(ImageColor::class);
    }


    public function product()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

}
