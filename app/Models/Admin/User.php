<?php

namespace AVDPainel\Models\Admin;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'profile_id',
        'first_name',
        'last_name',
        'email',
        'document1',
        'document2',
        'phone',
        'cell',
        'admin',
        'token',
        'password',
        'client',
        'date',
        'active',
        'newsletter',
        'ip'

    ];

    /**
     *  Data de exclusão do registro
     */
    protected $dates = ['deleted_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Email em minúsculo
     *
     * @param  string $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(ConfigProfileClient::class, 'profile_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(UserNote::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class)->orderBy('id', 'desc');
    }

}
