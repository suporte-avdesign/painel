<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigFormPayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order',
        'label',
        'description',
        'active'
    ];

    /**
     *  Data de exclusão do registro
     */
    protected $dates = ['deleted_at'];


    /**
     * Validação
     * @return array
     **/
    public function rules($id = '')
    {
        return [
            "label"       => "required|unique:config_status_orders,label,{$id},id",
            "description" => "required",
            "order"       => "required",
            "active"      => "required"
        ];
    }
}
