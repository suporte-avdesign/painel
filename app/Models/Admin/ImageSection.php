<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ImageSection extends Model
{
	protected $fillable = [
		'section_id',
		'image',
		'type',
		'status'
	];

    /**
    * @return array
    **/
    public function rules($id = '')
    {
        return [
            "section_id" => "required",
            "image"      => "required|image|mimes:jpeg,gif,png|unique:image_sections,image,{$id},id",
            "type"       => "required",
            "status"     => "required"
        ];
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
