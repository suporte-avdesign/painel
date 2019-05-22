<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigCategory extends Model
{
    protected $fillable = [
        'grids',
        'description',
        'img_default',
        'path',
        'img_featured',
        'width_featured',
        'height_featured',
        'img_banner',
        'width_banner',
        'height_banner',
        'width_modal',
        'height_modal'
    ];

    /**
     * Validação
     * @return array
     **/
    public function rules()
    {
        return [
            "path"            => "required",
            "width_featured"  => "required|numeric",
            "height_featured" => "required|numeric",
            "width_banner"    => "required|numeric",
            "height_banner"   => "required|numeric"
        ];
    }
}
