<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsSender extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function smses()
    {
        return $this->hasMany(Sms::class);
    }

    public function smsSetting(){
        $this->hasMany(SmsSetting::class);
    }
}
