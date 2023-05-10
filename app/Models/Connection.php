<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Connection extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function connectionScope()
    {
        return $this->belongsTo(ConnectionScope::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
