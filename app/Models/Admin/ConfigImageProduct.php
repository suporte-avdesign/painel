<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigImageProduct extends Model
{
    protected $fillable = [
        'default',
        'type',
        'width',
        'height',
        'path'
    ];


    /**
     * Validação
     * @return array
     **/
    public function rules($id = '')
    {

        return [
            "width"   => "required|numeric",
            "height"  => "required|numeric",
            "path"    => "required"
        ];
    }

}
