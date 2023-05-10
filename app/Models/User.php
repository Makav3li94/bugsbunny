<?php

namespace App\Models;

use App\Notifications\UserProductNotification;
use App\Notifications\UserTicketNotification;
use App\Notifications\UserVerifyNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function familiarity(): HasOne
    {
        return $this->hasOne(Familiarity::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }


    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }




    public function primary(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function smses(): HasMany
    {
        return $this->hasMany(Sms::class);
    }



    public function sendUserVerifyNotification($user, $details)
    {
        $this->notify(new UserVerifyNotification($user, $details));

    }


    public function sendUserTicketNotification($user)
    {
        $this->notify(new UserTicketNotification($user));
    }
}
