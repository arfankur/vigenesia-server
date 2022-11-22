<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'job',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    // public $incrementing = false;

    // /**
    //  * The "type" of the auto-incrementing ID.
    //  *
    //  * @var string
    //  */
    // protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        self::creating(function($q){
            // $q->id = \Illuminate\Support\Str::uuid();
            $q->role_id = 2;
            $q->is_active = 1;
        });
    }



    public function motivations()
    {
        return $this->hasMany(Motivation::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
