<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigTemplate extends Model
{
    protected $fillable = [
        'config_page_id',
        'name',
        'module',
        'tmp',
        'status'
    ];

    public function rules()
    {
        return [
            "config_page_id" => "required",
            "name" => "required",
            "module" => "required",
            "tmp" => "required|numeric",
            "status" => "required"
        ];
    }

    public function page()
    {
        return $this->belongsTo(ConfigPage::class, config_page_id);
    }

}
