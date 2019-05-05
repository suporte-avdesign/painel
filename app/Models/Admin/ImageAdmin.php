<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ImageAdmin extends Model
{

    protected $fillable = [
        'admin_id',
        'image',
        'status'
    ];

    /**
     * @return array
     **/
    public function rules($id = '')
    {
        return [
            "image" => "required|image|mimes:jpeg,gif,png|unique:image_admins,image,{$id},id",
            "status" => "required"
        ];
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
