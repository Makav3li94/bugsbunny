<?php

namespace App\Models;

use App\Notifications\UserTicketNotification;
use App\Notifications\UserVerifyNotification;
use App\Traits\HasLikeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory, HasLikeable;

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

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function quizHeader()
    {
        return $this->hasMany(QuizHeader::class);
    }

    public function primary(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function smses(): HasMany
    {
        return $this->hasMany(Sms::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class)->where('type', 0);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function sendUserVerifyNotification($user, $details)
    {
        $this->notify(new UserVerifyNotification($user, $details));

    }

    public function totalScore()
    {
        return $this->hasMany(TotalScore::class);
    }

    public function score()
    {
        $negative = 0;
        $positive = 0;

        foreach ($this->totalScore as $value) {
            if ($value->type) {
                $positive += $value->score;
            } else {
                $negative += $value->score;
            }
        }

        $total = $positive - $negative;
        return [
            'positive' => $positive,
            'negative' => $negative,
            'total' => $total,
        ];
    }

    public function posScore()
    {
        return $this->hasMany(TotalScore::class)->where('type', 1);
    }

    public function negScore()
    {
        return $this->hasMany(TotalScore::class)->where('type', 0);
    }

    public function sendUserTicketNotification($user, $ticket)
    {
        $this->notify(new UserTicketNotification($user, $ticket));
    }
}
