<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ImageColor extends Model
{
    const BASE_PATH     = 'app/public';
    const DIR_PRODUCTS  = 'products';
    const PRODUCTS_PATH = self::BASE_PATH .'/'. self::DIR_PRODUCTS;

    protected $fillable = [
        'product_id',
        'brand',
        'section',
        'category',
        'code',
        'color',
        'image',
        'slug',
        'html',
        'kit',
        'stock',
        'kit_name',
        'description',
        'cover',
        'order',
        'active',
        'visits'
    ];

    /**
     * Product
     * @return array
     **/
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Grids
     * @return array
     **/
    public function grids()
    {
        return $this->hasMany(GridProduct::class);
    }

    /**
     * Grids
     * @return array
     **/
    public function sizes()
    {
        return $this->hasMany(GridProduct::class, 'image_color_id');
    }

    /**
     * Images Positions
     * @return array'
     **/
    public function positions()
    {
        return $this->hasMany(ImagePosition::class);
    }
}
