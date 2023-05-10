<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function fromAdmin()
    {
        return $this->belongsTo(Admin::class,'from_id','id');
    }

    public function toAdmin()
    {
        return $this->belongsTo(Admin::class,'to_id','id');
    }
}
