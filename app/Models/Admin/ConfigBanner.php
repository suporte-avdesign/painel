<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigBanner extends Model
{
    protected $fillable = [
        'type',
        'status',
        'path',
        'width',
        'height',
    ];

    /**
     * Validação
     * @return array
     **/
    public function rules()
    {
        return [
            "type"         => "required",
            "path"         => "required",
            "width"  	   => "required|numeric",
            "height" 	   => "required|numeric",
        ];
    }
}
