<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminPermissions extends Model
{
	protected $table = 'admin_permissions';
	
    protected $fillable = [
        'module_id',
        'admin_id',
        'profile_id',
        'permission_id',
        'name',
        'label'
    ];

    
}
