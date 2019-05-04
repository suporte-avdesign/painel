<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigBrand extends Model
{
    protected $fillable = [
        'info',
        'grids', 
        'description', 
        'img_default',
        'path',
        'img_logo', 
        'width_logo', 
        'height_logo', 
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
            "path"          => "required",
    		"width_logo"  	=> "required|numeric",
    		"height_logo" 	=> "required|numeric",
    		"width_banner"  => "required|numeric",
    		"height_banner" => "required|numeric"
    	];
    }


}
