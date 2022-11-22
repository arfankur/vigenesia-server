<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Motivation extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    // protected $keyType = 'string';
    // /**
    //  * Indicates if the IDs are auto-incrementing.
    //  *
    //  * @var bool
    //  */
    // public $incrementing = false;


    protected static function boot()
    {
        parent::boot();

        static::creating(function($q){
            $q->user_id = Auth::user()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    // protected function createdAt(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y'),
    //     );
    // }

// public function getUpdatedAtAttribute($date)
// {
//     return
// }
}
