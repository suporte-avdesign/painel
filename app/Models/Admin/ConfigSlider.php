<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigSlider extends Model
{
    protected $fillable = [
        'status',
        'delay',
        'path',
        'width',
        'height',
        'width_thumb',
        'height_thumb',
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
            "delay"        => "numeric",
            "path"         => "required",
            "width"  	   => "required|numeric",
            "height" 	   => "required|numeric",
            "width_thumb"  => "required|numeric",
            "height_thumb" => "required|numeric",
            "width_modal"  => "required|numeric",
            "height_modal" => "required|numeric"
        ];
    }

}
