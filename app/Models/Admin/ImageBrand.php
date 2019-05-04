<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ImageBrand extends Model
{
	protected $fillable = [
		'brand_id',
		'image',
		'type',
		'status'
	];

    /**
    * @return array
    **/
    public function rules($id = '')
    {
        return [
            "brand_id" => "required",
            "image"    => "required|image|mimes:jpeg,gif,png|unique:image_brands,image,{$id},id",
            "type"     => "required",
            "status"   => "required"
        ];
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}
