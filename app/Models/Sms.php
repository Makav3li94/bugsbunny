<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sms extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function smsSender()
    {
        return $this->belongsTo(SmsSender::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
