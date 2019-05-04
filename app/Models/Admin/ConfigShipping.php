<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigShipping extends Model
{
	protected $fillable = [
	    'name',
	    'description',
	    'order',
	    'status'
	];

    /**
    * Validação
    * @return array
    **/
    public function rules($id = '')
    {
        return [
            "name"         => "required|unique:config_shippings,name,{$id},id",
            "description"  => "required",
            "order"        => "required|unique:config_shippings,order,{$id},id"
        ];
    }

}
