<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SmsSetting extends Model
{

    protected $guarded=[];

    public function smsSender(){
        return $this->belongsTo(SmsSender::class);
    }
}
