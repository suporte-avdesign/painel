<?php

namespace AVDPainel\Models\Admin;

use AVDPainel\Models\Admin\ConfigProfile;
use AVDPainel\Notifications\AdminResetPasswordNotification;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    /**
     * Permite apenas estes campos.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'login', 
        'profile', 
        'phone',
        'email',
        'status',
        'commission',
        'percent',
        'last_url',
        'password',
        'image'
    ];

    /**
     * Os atributos que devem ser escondidos para os array.
     *
     * @var array
     */
    protected $hidden = [
        'login', 'password', 'remember_token',
    ];

    /**
     *  Data de exclusão do registro
     */
    protected $dates = ['deleted_at'];

    /**
     * Email em minúsculo
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Permissões vinculadas
     * @return array
     **/

    public function permissions()
    {
        return $this->hasMany(AdminPermissions::class);
    }

    /**
    * User vinculado
    * @return array
    **/

    public function accesses()
    {
        return $this->hasMany(AdminAccess::class);
    }


    /**
    * Usuários vinculados ao perfil
    * @return array
    **/
    public function profiles()
    {
        return $this->belongsToMany(ConfigProfile::class);
    }

}
