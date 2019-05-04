<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GridProduct extends Model
{
	protected $fillable = [
		'product_id',
		'image_color_id',
		'kit',
		'grid',
		'entry',
		'low',
		'stock'
	];

	public $timestamps = false;
}
