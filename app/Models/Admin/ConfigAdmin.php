<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigAdmin extends Model
{
    protected $fillable = [
        'path',
        'width_photo',
        'height_photo'
    ];

    /**
     * Validação
     * @return array
     **/
    public function rules()
    {
        return [
            "path" => "required",
            "width_photo" => "required|numeric",
            "height_photo" => "required|numeric"
        ];
    }
}
