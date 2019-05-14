<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ContentPrivacyPolicy extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'order',
        'status'
    ];

    /**
     * @param int $id
     * @return array
     */
    public function rules()
    {
        return [
            "type" => "required",
            "title" => "required",
            "description" => "required",
            "order" => "required|numeric",
            "status" => "required"
        ];
    }

}


