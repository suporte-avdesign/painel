<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigProfileClient extends Model
{
	protected $fillable = [
        'order',
        'name',
	    'percent_cash',
        'percent_card',
        'sum',
	    'status'
	];

    /**
    * Validação
    * @return array
    **/
    public function rules($id = '')
    {
    	return [
            "order"    => "required",
            "name"  => "required|unique:config_profile_clients,name,{$id},id",
    		"percent_cash"  => "required",
            "percent_card"  => "required"
    	];
    }
}