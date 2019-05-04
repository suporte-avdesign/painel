<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigUnitMeasure extends Model
{
	protected $fillable = [
	    'unit',
	    'name',
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
    		"unit"  => "required",
    		"name"    => "required",
    		"order"    => "required"
    	];
    }
}