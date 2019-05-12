<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ImageBanner extends Model
{
    protected $fillable = [
        'type',
        'title',
        'text',
        'description',
        'link',
        'image',
        'status',
        'order'
    ];



    /**
     * @return array
     **/
    public function rules()
    {
        return [
            "type" => "required",
            "status" => "required",
            "order" => "required|numeric",
            "image" => "required|image|mimes:jpeg,gif,png"
        ];
    }
    //
}
