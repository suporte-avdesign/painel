<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigPage extends Model
{
    protected $fillable = ['name','module','status'];




    public function rules($id = '')
    {
        return [
            "name" => "required|unique:config_pages,name,{$id},id",
            "module" => "required",
            "status" => "required"
        ];
    }


    public function modules()
    {
        return $this->hasMany(ConfigTemplate::class);
    }






}
