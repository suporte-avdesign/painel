<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfigFreight extends Model
{
    protected $fillable = [
        'declare',
        'default',
        'weight',
        'width',
        'height',
        'length'
    ];
}
